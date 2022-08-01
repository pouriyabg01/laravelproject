<?php

namespace App\Http\Controllers;

use App\Http\Requests\testRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 *@group User Management
 *APIs to manage the user resource.
 **/

class AuthController extends Controller
{
    /**
     * @bodyParam email string required The email of the user
     * @bodyParam name string required The name of the user
     * @bodyParam password string required The password of the user
     * @bodyParam confirm_password string required The confirm_password of the user
     * @return UserResource
     */
    public function register(Request $request)
    {
        $validated = Validator::make($request->all() , [
            'name'=>'required|min:2|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:100',
            'confirm_password'=>'required|same:password'
        ])->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

//        $token = $user->createtoken('gym')->accesstoken;

        if(!$user) {
            return response()->json(['message' => 'register was not successfully']);
        }else{
            return response()->json([
                'message' => 'register was successfully',
                'user' => $user
//                'token' => $token
            ]);
        }
    }

    /**
     * @bodyParam email string required The email of the user
     * @bodyParam password string required The password of the user
     * @return UserResource
     */
    public function login(Request $request)
    {
        $validated = Validator::make($request->all() , [
            'email'=>'required|email',
            'password'=>'required'
        ])->validate();

        if(!Auth::attempt($validated))
            return response()->json(['message' => 'login was not successfully']);

        $token = Auth::user()->createToken('gym')->accessToken;

        return response()->json([
            'user' => Auth::user(),
            'token_type' => 'Bearer',
            'token' => $token
        ]);
    }

}
