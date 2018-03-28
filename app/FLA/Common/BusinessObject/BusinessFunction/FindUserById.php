<?php

namespace App\FLA\Common\BusinessObject\BusinessFunction;


use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\ValidationUtil;

class FindUserById extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'id');

        $id = $input['id'];
        $user = User::where('user_id', '=', $id)->first();
        if ($user == null) {
            throw new CoreException(CommonExceptionsConstant::$DATA_NOT_FOUND, 'User', $id);
        }

        return $user;
    }

    function getDescription()
    {
        "Digunakan untuk mengambil data user by id yang dikirim";
    }
}