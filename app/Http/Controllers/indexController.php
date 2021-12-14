<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
