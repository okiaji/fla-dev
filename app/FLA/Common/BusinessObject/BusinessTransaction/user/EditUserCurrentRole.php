<?php

namespace App\FLA\Common\BusinessObject\BusinessTransaction\user;


use App\FLA\Core\AbstractBusinessTransaction;
use App\FLA\Core\Util\ValidationUtil;

class EditUserCurrentRole extends AbstractBusinessTransaction
{

    protected function prepare(&$input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, "userLoginId");
        ValidationUtil::valBlankOrNull($input, "roleLoginId");
        ValidationUtil::valBlankOrNull($input, "token");
        ValidationUtil::valBlankOrNull($input, "roleCode");

        $userLoginId = $input['userLoginId'];
        $roleLoginId = $input['roleLoginId'];
        $token = $input['token'];
        $roleCode = $input['roleCode'];

    }

    protected function process(&$input, $oriInput)
    {
    }

    function getDescription()
    {
        return "Melakukan perubahan user current role id";
    }
}