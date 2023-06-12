<?php

namespace App\Interfaces\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Model;
    public function create(array $data): Model;
    public function update($id, array $data): ?Model;
    public function delete($id): ?Model;
}