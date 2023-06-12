<?php

namespace App\Repositories\User;

use App\Interfaces\User\Repository\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{

    public function getByLogin(string $login): ?User
    {
        return $this->model->where('login', $login)->first();
    }
}