<?php

namespace App\FLA\Core;
use Exception;

class CoreException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct() {
        $numargs = func_num_args();
        $arg_list = func_get_args();
        $argsList = [];
        for ($i = 1; $i < $numargs; $i++) {
            array_push($argsList, $arg_list[$i]);
        }

        $message = $this->generateMessage($arg_list[0], $argsList);

        // make sure everything is assigned properly
        parent::__construct($message);
    }

    private function generateMessage($msg, $paramMsgList) {
        for ($i = 0; $i < count($paramMsgList); $i++) {
            $msg = str_replace('{'.$i.'}',$paramMsgList[$i], $msg );
        }
        return $msg;
    }
}