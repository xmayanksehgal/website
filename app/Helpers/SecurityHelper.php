<?php

namespace App\Helpers;

use App\Model\SkillManager;
use App\Model\User;
use App\Model\UserManager;
use Illuminate\Support\Facades\Auth;

class SecurityHelper
{

    private static $rolesHierarchy = array(
        "user" => array("user"),
        "admin" => array("admin", "user"),
        "superadmin" => array("superadmin", "admin", "user")
    );

    public function hashPassword($plainPassword){
        $hashedPassword = hash("sha512", $plainPassword);
        return $hashedPassword;
    }

    public static function checkUsage($maxUsage = 10, $inHowManySeconds = 60){

        //retrieve the api method being called
        $callers=debug_backtrace();
        if (!empty($callers[1]['function'])){
            $call = $callers[1]['function'];
        }

        if (!$call){
            self::forbid("irregular usage");
        }

        $now = time();

        //add the time of this call to session
        $_SESSION['usage'][$call][] = $now;

        //count the number of calls in the last x seconds
        $count = 0;
        foreach($_SESSION['usage'][$call] as $t){
            $since = $now-$inHowManySeconds;
            if ($t > $since){
                $count++;
            }
        }

        //remove old ones
        while ($_SESSION['usage'][$call][0] < $since){
            array_shift($_SESSION['usage'][$call]);
        }

        //above limits for this call ?
        if ($count > $maxUsage){
            self::forbid("irregular usage");
        }
    }


    public static function forbid($reason = ""){
        header('HTTP/1.0 403 Forbidden');
        $message = ($reason) ? "Forbidden : $reason" : "Forbidden";
        die($message);
    }


    public static function getRights($user, $skillUuid){
        $rights = array();

        $allRights = array("create_as_child", "create_as_parent", "move",
            "copy", "translate", "discuss", "share", "rename", "delete", "settings", "history");
        $defaultRights = array("create_as_child", "discuss", "share", "history");

        if (!$user){
            return $defaultRights;
        }

        $role = $user->role;

        $skillManager = new SkillManager();
        $skillCreationInfo = $skillManager->findCreationInfo( $skillUuid );

        //if admin or superadmin, gives all right
        if ($role == "admin" || $role == "superadmin"){
            $rights = $allRights;
        }

        //if user is the skill's creator, and the skill has been recently created
        //gives all rights also
        else if ($skillCreationInfo['creatorUuid'] == $user->id &&
            $skillCreationInfo['timestamp'] > (time() - 86400)){
            $rights = $allRights;
        }

        //default, gives create_as_child, discuss and share rights
        else {
            $rights = $defaultRights;
        }
        return $rights;
    }

    public static function getRole() {
        if (!empty($_SESSION['user']['uuid'])){
            $userManager = new UserManager();
            $user = $userManager->findByUuid($_SESSION['user']['uuid']);
            if ($user) return $user->role;
            else return false;
        }else return false;
    }


    public static function getUser(){
        if (Auth::user()){
            $user = Auth::user();
            if ($user){
                $sessionUser = array(
                    "uuid" => $user->id,
                    "role" => $user->role,
                    "username" => $user->username,
                    "email" => $user->email
                );
                $_SESSION['user'] = $sessionUser;
                return $user;
            }
            else {
                redirect()->route('logout');
            }
        }
        return false;
    }

    public static function lock($minimumRole = "", $skillUuid = null, $askedRight = ""){
        //if no user is connected, forbid
        if (!Auth::user()){
            return self::forbid(_("You must be signed in to do that!"));
        }
        //if no minimum role, return true
        else if ($minimumRole == ""){
            return true;
        }
        //role creator is special
        //user must have created the skill
        else if ($minimumRole == "creator"){
            $userRights = self::getRights(self::getUser(), $skillUuid);
            if (in_array($askedRight, $userRights)){
                return true;
            }
        }

        //else, with a mimimum role
        else {

            $userRole = self::getUser()->role;

            $authorizedLevels = self::$rolesHierarchy[$userRole];
            //check if user has this capability
            if (!in_array($minimumRole, $authorizedLevels)){
                return self::forbid(_("You can't do that!"));
            }
        }
        return true;
    }


    public static function safe($string){
        return strip_tags($string);
    }

    public static function encode($string){
        return htmlspecialchars($string);
    }
}
