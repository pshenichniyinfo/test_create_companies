<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends ApiController
{
    private $salt;

    public function __construct()
    {
        $this->salt = 'testUserloginRegister';
    }

    public function register(RegisterRequest $registerRequest): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $apiToken = Str::random(60);

        $user = new User();
        $user->first_name = $registerRequest->input('first_name');
        $user->last_name = $registerRequest->input('last_name');
        $user->email = $registerRequest->input('email');
        $user->phone = $registerRequest->input('phone');
        $user->password = sha1($this->salt.$registerRequest->input('password'));
        $user->api_token = $apiToken;

        if ($user->save()) {
            return $this->sendResponse(['user' => $apiToken], 'Successful registered user');
        }

        return $this->sendError();
    }

    public function sign_in(LoginRequest $loginRequest): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $user = User:: where("email", "=", $loginRequest->input('email'))
            ->where("password", "=", sha1($this->salt.$loginRequest->input('password')))
            ->first();

        if ($user)  {
            $token=Str::random(60);
            $user->api_token = $token;
            $user->save();

            return $this->sendResponse(['token' => $user->api_token], 'Success auth');
        }

        return $this->sendError('Error auth, wrong email or password');
    }
}
