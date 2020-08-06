<?php

namespace App\Service;

use App\Repository\UserRepository;
use JWTAuth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        return $this->userRepository->getAllUser();
    }
    
    public function register($request)
    {       
        return $this->userRepository->register($request);       
    }
}
