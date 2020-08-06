<?php

namespace App\Repository;

use JWTAuth;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserRepository
{
    public function getAllUser()
    {
        return User::where('identity', '=', NULL)->get();
    }

    public function register($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);                
    }
}
