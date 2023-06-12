<?php

namespace App\Interfaces\Services\User;

use App\Http\Requests\LoginPostRequest;

interface UserServiceInterface
{
    public function auth(LoginPostRequest $request): string;
}
