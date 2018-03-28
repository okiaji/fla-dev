<?php

namespace App\FLA\Core\Util;

class DateUtil
{
    public static function currentDate() {
        return date('Ymd');
    }

    public static function currentDatetime() {
        return date('YmdHis');
    }
}