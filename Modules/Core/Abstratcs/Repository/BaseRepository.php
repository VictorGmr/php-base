<?php

namespace Modules\Core\Abstratcs\Repository;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $model;

    public function find($value, $param)
    {
        try {
            $query = $this->model->newQuery();
            $this->with($query, $param);
            return $query->find($value);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function findByUuid($uuid, $param)
    {
        try {
            $query = $this->model->newQuery();
            $this->with($query, $param);
            return $query->where("uuid",$uuid)->firstOrFail();
        } catch (\Exception $exception) {
            report($exception);
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {

        DB::beginTransaction();

        try {
            $this->model->fill($data);
            $this->model->save();

            DB::commit();

            return $this->model;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollback();
            throw $exception;
        }
    }

    public function update($entity)
    {
        DB::beginTransaction();

        try {
            $entity->update();

            DB::commit();

            return $entity;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollback();
            throw $exception;
        }
    }

    public function findBy($criteria = null, $param = null)
    {

        $query = $this->model->newQuery();
        $this->setParam($query, $criteria);

        if ($criteria) {
            $query->where($criteria);
        }

        // Verifica LIMIT.
        if (isset($param['limit'])) {
            $query->limit($param['limit']);
        }

        return $query->get();
    }

    public function all($criteria = null)
    {
        try {
            $query = $this->model->query();
            $this->setParam($query, $criteria);
            return $query->get();
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function paginate(int $perPage, array $criteria = [])
    {
        try {
            $build = $this->model->newQuery();

            if (isset($criteria['OR'])) {
                collect($criteria['OR'])->map(function ($value, $key) use ($build) {
                    if (!empty($value)) {
                        $build->OrWhere($key, "like", "%$value%");
                    }
                });

                unset($criteria['OR']);
            }

            return $build->paginate($perPage);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    /**
     * Set Param
     */

    public function setParam(&$query, &$criteria = [])
    {
        /**
         * OrderBy
         */
        if (isset($criteria['order'])) {
            $type = (isset($criteria['order'][1])) ? $criteria['order'][1] : 'ASC';
            $query->orderBy($criteria['order'][0], $type);
            unset($criteria['order']);
        }elseif(isset($criteria['orderAsc']) || isset($criteria[strtolower('orderAsc')])){
            $field = $criteria['orderAsc'] ?? $criteria[strtolower('orderAsc')];
            $query->orderBy($field, 'ASC');
            unset($criteria['orderAsc']);
        }elseif(isset($criteria['orderDesc']) || isset($criteria[strtolower('orderDesc')])){
            $field = $criteria['orderDesc'] ?? $criteria[strtolower('orderDesc')];
            $query->orderBy($field, 'DESC');
            unset($criteria['orderDesc']);
        }

        /**
         * WhereIn
         */
        if (isset($criteria['IN'])) {
            collect($criteria['IN'])->map(function ($value, $key) use ($query) {
                if (!empty($value)) {
                    $query->WhereIn($key, $value);
                }
            });
            unset($criteria['IN']);
        }

        /**
         * WhereOR
         */
        if (isset($criteria['OR'])) {
            collect($criteria['OR'])->map(function ($value, $key) use ($query) {
                if (!empty($value)) {
                    $query->OrWhere($key, "like", "%$value%");
                }
            });
            unset($criteria['OR']);
        }
    }

    private function with(&$query, $param = [])
    {
        if (isset($param)) {
            if (isset($param['with'])) {
                $query->with($param['with']);
            }
        }
    }
}
