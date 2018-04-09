<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction\user;

use App\FLA\Common\CommonConstant;
use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\Util\ValidationUtil;

class IsTokenExists extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'token');

        $token = $input['token'];

        $userLoggedInfo = UserLoggedInfo::where([
            ['user_token', $token],
            ['active', CommonConstant::$YES]
        ])->first();

        $result = [
            'exists' => false
        ];

        if ($userLoggedInfo != null) {
            $result = [
                'exists' => true,
                'userLoggedInfo' => $userLoggedInfo
            ];
        }

        return $result;
    }

    function getDescription()
    {
        return "Digunakan untuk melakukan pengecekan apakah token yang dikirim benar terdaftar";
    }
}