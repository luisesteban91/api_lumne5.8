<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    
    function index(Request $request){

        if($request->isJson()){
            //Eloquent
            $user = User::all();
            return response()->json([$user], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401, []);
    }

    function crearUser(Request $request){

        if($request->isJson()){
            //todo: create user
            $data = $request->json()->all();
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60)
            ]);
            return response()->json([$user], 201);
        }

        return response()->json(['error' => 'Unauthorized'], 401, []);
    }

    function getToken($request){
        if($request->isJson){
            try{
            $data = $request->json()->all();

            $user = User::where('username', $data['username'])->first();

            if($user && Hash::check($data['password'], $user->password)){
                return response()->json($user, 200);
            }else{
                return response()->json(['error'=>'No content'],406);
            }

            }catch (ModelNotFoundException $e){
                return response()->json(['error'=>'No content'],406)
            }
        }
    }

}
