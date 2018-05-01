<?php

namespace App\FLA\Core;

class CoreHelpers
{
    /**
     * @param mixed ...$task
     * @return bool
     *
     * Digunakan untuk melakukan pengecekan task terhadap current role user
     * jika valid akan mengembalikan true, jika tidak akan mengembalikan false
     */
    public static function authTask(...$task) {

        return false;
    }

}