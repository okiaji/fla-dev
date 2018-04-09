<?php

namespace App\FLA\Common\BusinessObject\BusinessFunction\user;

use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Common\Model\UserAdditionalInfo;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\CoreException;
use App\FLA\Core\Util\ValidationUtil;

class FindUserAdditionalInfoByIndex extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'userId');

        $userId = $input['userId'];
        $userAdditionalInfo = UserAdditionalInfo::where('user_id', '=', $userId)->first();
        if ($userAdditionalInfo == null) {
            throw new CoreException(CommonExceptionsConstant::$USER_ADDITIONAL_INFO_IS_NOT_FOUND_WITH_INDEX, $userId);
        }

        return $userAdditionalInfo;
    }

    function getDescription()
    {
        return "Digunakan untuk mengambil data additional info user by index";
    }
}