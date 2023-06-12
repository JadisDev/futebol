<?php

namespace App\Interfaces\User\Repository;

use App\Interfaces\Repository\RepositoryInterface;
use App\Models\User;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function getByLogin(string $login): ?User;
}
