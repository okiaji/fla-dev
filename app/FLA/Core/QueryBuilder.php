<?php

namespace App\FLA\Core;

class QueryBuilder
{

    private $query;

    public function __construct() {
        $this->query = "";
    }

    public function add(string $query){
        $this->query .= $query;
        return $this;
    }

    public function addIfNotEmpty(string $string, string $query){
        if($string!=null&&$string!='') {
            $this->query .= $query;
        }
        return $this;
    }

    public function addIfEmpty(string $string, string $query){
        if($string==null||$string=='') {
            $this->query .= $query;
        }
        return $this;
    }

    public function addIfNotEquals($string, $comparison, string $query){
        if($comparison!=$string) {
            $this->query .= $query;
        }
    }

    public function addIfEquals($string, $comparison, string $query){
        if($comparison==$string) {
            $this->query .= $query;
        }
        return $this;
    }

    public function addIfTrue(boolean $boolean, string $query){
        if($boolean) {
            $this->query .= $query;
        }
        return $this;
    }

    public function toString(){
        return $this->query;
    }

}