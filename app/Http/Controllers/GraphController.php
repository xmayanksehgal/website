<?php

namespace App\Http\Controllers;

use App\JSTranslations;
use App\Model\JsonResponse;
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

    public function getJSTranslationsAction(){

        $jsTrans = new JSTranslations();
        header("Content-type: application/javascript");
        echo "var jt = " . json_encode($jsTrans->getJSTranslations(), JSON_PRETTY_PRINT);
    }

    public function goToAction($slug){
        $skillManager = new SkillManager();

        $rootNode = $skillManager->findRootNode();

        $uuid = $skillManager->getUuidFromSlug($slug);

        //will fail if called after findNodePathToRoot
        //cause unknown
        //another workaround : get a new client before calling this one with:
        //\Model\DatabaseFactory::setNewClient();
        $skill = $skillManager->findByUuid($uuid);

        $path = $skillManager->findNodePathToRoot($uuid);

        if (!$path){
            return redirect()->route('fourofour');
//            Router::fourofour();
        }

        $json = new JsonResponse();
        $json->setData($path);

        $data = array(
                "rootNode"  => $rootNode,
                "title"     => $skill->getName(),
                "action"    => "goto",
                "jsonAutoLoad"  => $json->getJson($path, false),
                "slug"      => $slug,
                "userClass" => $this->getUserClass()
        );
        return view('layouts.graph',['data'=>$data]);
//        $view->setLayout("../View/layouts/graph.php");
//        $view->send();
    }

}
