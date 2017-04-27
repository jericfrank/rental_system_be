<?php

namespace App\Repositories;

use App\Models\User;

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
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt( $data->password );
        $user->save();

        $token = JWTAuth::fromUser( $data );

        return $token;
    }

    public function signin( $data ) {
        $credentials = $data->only( 'email', 'password' );

        $token = JWTAuth::attempt( $credentials );

        return $token;
    }
}