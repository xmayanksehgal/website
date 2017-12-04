<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UsersController extends Controller
{
    public function index()
    {
        $app =  new User();
        $table = $app::all();
        return $table;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function project()
    {
        return view('pages.project');
    }
}