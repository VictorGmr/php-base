<?php

namespace Modules\Core\Traits;

use Illuminate\Support\Facades\DB;

trait ServiceCommonTrait
{
    public function delete($model)
    {
        try {
            $model->delete();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function deleteBatch($models)
    {
        try{
            $response = DB::transaction(function () use ($models) {
                foreach ($models as $model){
                    $this->delete($model);
                }
                return true;
            });
            return $response;
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function changeStatusBatch($models)
    {
        try{
            $response = DB::transaction(function () use ($models) {
                foreach ($models as $model){
                    $this->merge($model, ["active" => !$model->active]);
                }
                return true;
            });
            return $response;
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }
}
