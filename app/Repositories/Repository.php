<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected Model $model;

    abstract public function setModel(): Model;

    public function __construct()
    {
        $this->model = $this->setModel();
    }

    public function model(): Model
    {
        return $this->model;
    }

    public function find(int $id): ?Model
    {
        return $this->model::find($id);
    }

    public function create(array $data): Model
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model::where('id', $id)->delete();
    }

    public function take(int $value): Collection
    {
        return $this->model::take($value)->get();
    }

    public function findById($id): ?Model
    {
        return $this->model::where('id', $id)->first();
    }
}
