<?php

namespace Helpers;

use App\Model\User;

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
}
