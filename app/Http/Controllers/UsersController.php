<?php

namespace App\Http\Controllers;
use App\User;

class UsersController extends Controller
{
    
    function index(){

        //Eloquent

        $user = User::all();
        return response()->json([$user], 200);
    }
}
