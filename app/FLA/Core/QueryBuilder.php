<?php

namespace App\FLA\Core;


class QueryBuilder
{

    private $query;

    public function __construct() {
        $this->query = "";
    }

    public function add($query){
        $this->query .= $query;
        return $this;
    }

    public function addIfNotEmpty($string, $query){
        if($string!=null&&$string!='') {
            $this->query .= $query;
        }
        return $this;
    }

    public function addIfEmpty($string, $query){
        if($string==null||$string=='') {
            $this->query .= $query;
        }
        return $this;
    }

    public function addIfNotEquals($string, $comparison, $query){
        if($comparison!=$string) {
            $this->query .= $query;
        }
    }

    public function addIfEquals($string, $comparison, $query){
        if($comparison==$string) {
            $this->query .= $query;
        }
        return $this;
    }

    public function addIfTrue($booleam, $query){
        if($booleam) {
            $this->query .= $query;
        }
        return $this;
    }

    public function toString(){
        return $this->query;
    }

}