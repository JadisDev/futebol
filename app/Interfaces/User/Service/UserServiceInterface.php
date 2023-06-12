<?php

namespace App\Interfaces\User\Service;

use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\UserPostRequest;
use App\Models\User;

interface UserServiceInterface
{
    public function auth(LoginPostRequest $request): string;
    public function save(UserPostRequest $request): User;
}
