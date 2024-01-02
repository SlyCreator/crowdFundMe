<?php

namespace App\Services\User;

use App\Models\User;
use App\Utils\Utilities;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function creatUser($data)
    {
        $hashPassword = Hash::make($data['password']);
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => $hashPassword
        ]);
        return $user;
    }

    public function login($data)
    {
        $user = $this->compareEmailAndPassword($data);
        $token = $user->createToken('access token')->accessToken;
        return ['user'=>$user,'token'=>$token];
    }
    public function compareEmailAndPassword($data)
    {
        $user = User::where('email',$data['email'])->firstOrFail();
        if (Hash::check($data['password'], $user->password)) {
            return $user;
        }else{
            Utilities::customAbort('Invalid email or  Password Try again.', 401);
        }
    }
}
