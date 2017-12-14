<?php

namespace App\Http\Controllers;

use App\Model\StatManager;
use Controller\UserController;
use Illuminate\Http\Request;
use App\Model\SkillManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Model\Skill;


class GraphController extends Controller
{

//    public function graph()
//    {
//        echo"pap";
//        $app = new SkillManager();
//        $a = $app->findChildren('54302dd8c7fad5f18236577');
//        return $a;
//    }

    public function graphAction(){

        $statManager = new StatManager();
        $skillManager = new SkillManager();
        $rootNode = $skillManager->findRootNode();
        $data = array(
            "rootNode"  => $rootNode,
            "title"     => _("Explore"),
            "userClass" => UsersController::getUserClass(),
            "skillCount" => $statManager->countLabel("Skill"),
//                "wsUrl" => Config::CROSSBAR_WS_URL
        );
        return view('pages.graph',['data'=> $data]);
    }
}
