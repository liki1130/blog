<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Service\UserService;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    //登入
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'data' => '',
            ], 401);
        }
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $token,
        ], 200);
    }
    //登出
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::gettoken());
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully',
                'data' => '',
            ], 200);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out',
                'data' => '',
            ], 401);
        }
    }
    //註冊
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:10',
            'email' =>'required|unique:users|email|max:255',
            'password' => 'required|min:8|max:20|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => '',
            ], 422);
        }
        $this->userService->register($request);
        return response()->json([
            'success' => true,
            'message' => '註冊成功',
            'data' => '',
        ], 200);
    }
}
