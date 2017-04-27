<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;

use App\User;

use Auth;
use JWTAuth;

class AuthController extends Controller
{
    public function signup(UserRequest $request)
    {
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt( $request->password );
    	$user->save();

    	$token = JWTAuth::fromUser( $user );

      return response()->json( compact('token') );
    }

    public function signin(Request $request)
    {
    	$credentials = $request->only( 'email', 'password' );

   		if ( ! $token = JWTAuth::attempt( $credentials ) ) {
       		return response()->json([ 'error' => 'Invalid Credentials' ], 400 );
   		}

   		return response()->json( compact('token') );
    }
}
