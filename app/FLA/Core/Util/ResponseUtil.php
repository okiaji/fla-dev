<?php

namespace App\FLA\Core\Util;

class ResponseUtil
{
    public static function resultObject($object) {

        $data = $object->getData();

        return $data->response;
    }
}