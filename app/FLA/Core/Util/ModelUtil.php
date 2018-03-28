<?php
namespace App\FLA\Core\Util;
use Illuminate\Support\Facades\Schema;

class ModelUtil
{
    public static function convertArrayToModel($inputArray, $model) {
        foreach ($inputArray as $key => $value) {
            $key = GeneralUtil::camelCaseToUnderscore($key);
            if (Schema::hasColumn($model->getTable(), $key)){
                $model->$key = $value;
            }
        }

        return $model;
    }
}