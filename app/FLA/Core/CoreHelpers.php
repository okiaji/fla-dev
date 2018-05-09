<?php

namespace App\FLA\Core;

use App\FLA\Common\BusinessObject\BusinessFunction\task\IsTaskValidForCurrentRole;

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

        $token = isset($_COOKIE['FLA-TOKEN'])?$_COOKIE['FLA-TOKEN']:'';
        $isTaskValidForCurrentRole = new IsTaskValidForCurrentRole();
        $task = $isTaskValidForCurrentRole->execute([
            'token' => $token,
            'taskList' => $task,
        ]);
        return $task;
    }

}