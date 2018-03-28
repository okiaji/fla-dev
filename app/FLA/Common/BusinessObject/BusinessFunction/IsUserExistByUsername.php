<?php

namespace App\FLA\Common\BusinessObject\BusinessFunction;

use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\Util\ValidationUtil;
use App\FLA\Common\Model\User;

class IsUserExistByUsername extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'username');
        $username = $input['username'];

        $user = User::where('username', '=', $username)->first();

        $result = [
            'exists' => false
        ];

        if ($user != null) {
            $result = [
                'exists' => true,
                'user' => $user
            ];
        }

        return $result;
    }

    function getDescription()
    {
        return "Digunakan untuk mengambil data user by username yang dikirim";
    }
}