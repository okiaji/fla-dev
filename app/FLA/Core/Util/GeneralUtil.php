<?php
namespace App\FLA\Core\Util;

use Ramsey\Uuid\Uuid;

class GeneralUtil
{
    public static function camelCaseToUnderscore($camelCase) {
        return strtolower(preg_replace('/(?<=\w)(?=[A-Z])/',"_$1", $camelCase));
    }

    public static function generateToken($user, $datetimeNow) {
        return "FLA-".md5(uniqid($user."_".rand()."_".$datetimeNow, true))."-".Uuid::uuid4()->toString();
    }
}