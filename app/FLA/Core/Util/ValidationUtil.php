<?php

namespace App\FLA\Core\Util;
use Exception;
use DateTime;

class ValidationUtil
{

    public static function valContainsKey(Array $inputArray, String $key){

        if(!array_key_exists($key, $inputArray)) {
            throw new Exception('Input with parameter '.$key.' is not found');
        }

    }

    public static function valBlankOrNull(Array $inputArray, String $key){

        if(!array_key_exists($key, $inputArray) || $inputArray[$key] == '') {
            throw new Exception('Input with parameter '.$key.' must be filled');
        }

    }

    public static function valDate(Array $inputArray, String $key){

        self::valBlankOrNull($inputArray, $key);
        $date = $inputArray[$key];

        if(!self::validateDate($date, 'Ymd')) {
            throw new Exception('Input with parameter '.$key.' is not type of Date (Ymd)');
        }

    }

    public static function valDatetime(Array $inputArray, String $key){

        self::valBlankOrNull($inputArray, $key);
        $datetime = $inputArray[$key];

        if(!self::validateDate($datetime, 'YmdHis')) {
            throw new Exception('Input with parameter '.$key.' is not type of Datetime (YmdHis)');
        }

    }

    private static function validateDate(String $date, String $format)
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }


}