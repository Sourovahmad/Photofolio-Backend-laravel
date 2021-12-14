<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use PhpParser\Node\Stmt\Foreach_;

class indexController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with('projects')->find($request->user()->id);
            return response()->json([
                "user" => $user,
            ],200);
    }

    public function getUserDetails()
    {
       $users = User::with('projects')->get();
       return response()->json([
        'users' => $users
       ],200);
    }


    public function userProjects($user_id)
    {

       $all_projects = project::with('categories')->where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return response()->json([
            'projects' => $all_projects,
        ],200);
    }
}
