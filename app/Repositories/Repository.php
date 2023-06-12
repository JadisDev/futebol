<?php

namespace App\Repositories;

use App\Interfaces\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class Repository implements RepositoryInterface
{
    protected Model $model;

    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getById($id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): ?Model
    {
        $model = $this->getById($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id): ?Model
    {
        $contact = $this->getById($id);
        if ($contact) {
            $contact->delete();
            return $contact;
        }
        return null;
    }
}
