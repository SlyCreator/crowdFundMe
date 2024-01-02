<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService= $userService;
    }
    public function registerUser(CreateUserRequest $request)
    {
        $data = $this->userService->creatUser($request->all());
        return $this->response(Response::HTTP_CREATED,$data,"Account created successfully");
    }

    public function login(Request $request)
    {
        $data = $this->userService->login($request->all());
        return $this->response(Response::HTTP_OK, [
            'user' => $data['user'],
            'access_token' => $data['token'],
        ], "Login Successfully");
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->response(
            Response::HTTP_OK,[],"Logout successfully"
        );
    }

}
