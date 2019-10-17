<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    
    function index(){
        return response()->json([], 200);
    }
}
