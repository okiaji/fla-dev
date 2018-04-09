<?php
namespace App\FLA\Core;


class ConditionExpression
{

    public static function likeCaseSensitive($column, $value){
        return $column." LIKE '%".$value."%'";
    }

    public static function likeCaseInsensitive($column, $value){
        return " UPPER(".$column.") LIKE '%".strtoupper($value)."%' ";
    }

    public static function equalCaseSensitive($column, $value){
        return $column." = '".$value."'";
    }

    public static function equalCaseInsensitive(){

    }

    public static function notEqualCaseSensitive(){

    }

    public static function notEqualCaseInsensitive(){

    }

}