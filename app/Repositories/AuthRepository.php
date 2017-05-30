<?php

namespace App\Repositories;

use App\User;
use Auth;
use JWTAuth;

class AuthRepository
{
    public function getModel()
    {
        return new User();
    }

    public function signup( $data )
    {
        $user = $this->getModel();
        $user->name = $data->UserName;
        $user->email = $data->Email;
        $user->password = bcrypt( $data->Password );
        $user->save();

        $token = JWTAuth::fromUser( $data );

        return $token;
    }

    public function signin( $data ) {
        $credentials = [
            'email'    => $data->get('UserName'),
            'password' => $data->get('Password')
        ];

        $token = JWTAuth::attempt( $credentials );

        if ( $token ) {
            return [
                'token' => $token,
                'user' => Auth::User()
            ];
        }

        return $token;
    }
}