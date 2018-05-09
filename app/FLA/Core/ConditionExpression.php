<?php
namespace App\FLA\Core;


class ConditionExpression
{

    public static function likeCaseSensitive(string $column, string $value){
        return $column." LIKE '%".$value."%' ";
    }

    public static function likeCaseInsensitive(string $column, string $value){
        return " UPPER(".$column.") LIKE '%".strtoupper($value)."%' ";
    }

    public static function equalCaseSensitive(string $column, string $value){
        return $column." = '".$value."'";
    }

    public static function equalCaseInsensitive(string $column, string $value){
        return " UPPER(".$column.") = UPPER('".$value."') ";
    }

    public static function notEqualCaseSensitive(string $column, string $value){
        return $column." != '".$value."'";
    }

    public static function notEqualCaseInsensitive(string $column, string $value){
        return " UPPER(".$column.") != UPPER('".$value."') ";
    }

    public static function inCaseSensitive(string $column, ...$valueList){

        $values = "";
        foreach($valueList as $value) {
            $values .= "'".$value."',";
        }
        $values = substr($values, 0, -1);

        return $column." IN (".$values.") ";
    }

    public static function inCaseInsensitive(string $column, ...$valueList){

        $values = "";
        foreach($valueList as $value) {
            $values .= "'".$value."',";
        }
        $values = strtoupper(substr($values, 0, -1));

        return " UPPER(".$column.") IN (".$values.") ";
    }

    public static function inListCaseSensitive(string $column, $valueList){

        $values = "";
        foreach($valueList as $value) {
            $values .= "'".$value."',";
        }
        $values = substr($values, 0, -1);

        return $column." IN (".$values.") ";
    }

    public static function inListCaseInsensitive(string $column, $valueList){

        $values = "";
        foreach($valueList as $value) {
            $values .= "'".$value."',";
        }
        $values = strtoupper(substr($values, 0, -1));

        return " UPPER(".$column.") IN (".$values.") ";
    }

    public static function inStringCaseSensitive(string $column, string $value){
        return $column." IN (".$value.") ";
    }

    public static function inStringCaseInsensitive(string $column, string $value){
        return " UPPER(".$column.") IN (".strtoupper($value).") ";
    }

}