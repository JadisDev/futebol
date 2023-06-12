<?php

namespace App\Services\User;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\LoginPostRequest;
use App\Interfaces\Services\User\UserServiceInterface;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService implements UserServiceInterface
{

    public string $login;
    public string $password;

    public function auth(LoginPostRequest $request): string
    {
        $credentials = $request->only('login', 'password');
        $user = User::where('login', $credentials['login'])->first();

        if ($user['password'] === $credentials['password']) {
            return JWTAuth::claims($user->toArray())->fromUser($user);
        }

        throw new UserNotFoundException('Erro teste');
    }
}
