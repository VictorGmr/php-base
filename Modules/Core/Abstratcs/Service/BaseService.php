<?php

namespace Modules\Core\Abstratcs\Service;

class BaseService
{
    protected $repository;

    public function find($value, $param = null)
    {
        return $this->repository->find($value, $param);
    }

    public function findByUuid(string $uuid, $param = null)
    {
        return $this->repository->findByUuid($uuid, $param);
    }

    public function create(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function merge(Object $model, array $data)
    {
        try {
            $model->fill($data);
            return $this->repository->update($model);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function findBy(array $criteria, $param = null)
    {
        try {
            return $this->repository->findBy($criteria, $param);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function all($param = null)
    {
        try {
            return $this->repository->all($param);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function paginate(int $perPage = 10, array $criteria = [])
    {
        try {
            return $this->repository->paginate($perPage, $criteria);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }
}
