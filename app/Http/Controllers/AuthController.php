<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\UserRequest;

use App\Repositories\AuthRepository;

class AuthController extends Controller
{
    public function __construct(AuthRepository $authRepository)
    {
      $this->authRepository = $authRepository;
    }

    public function signup(UserRequest $request)
    {
       $data = $this->authRepository->signup( $request );

       return response()->json( [ 'token' => $data ], 201 );
    }

    public function signin(Request $request)
    {
    	$data = $this->authRepository->signin( $request );

   		if ( ! $data ) {
       	return response()->json([ 'error' => 'Invalid Credentials' ], 400 );
   		}

   		return response()->json( [ 'token' => $data ] );
    }
}
