<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GraphAware\Neo4j\Client\ClientBuilder;
use App\Model\SkillManager;
use Model\Skill;

class GraphController extends Controller
{
    public function graph()
    {
        $app = new SkillManager();
        $app->findChildren();
    }
}
