<?php

namespace App\FLA\Common\BusinessObject\BusinessTransaction;

use App\FLA\Common\CommonConstant;
use App\FLA\Core\AbstractBusinessTransaction;
use App\FLA\Core\DateUtil;
use App\FLA\Core\ValidationUtil;
use App\FLA\Common\BusinessObject\BusinessFunction\FindUserByUsername;

class AddUserLoggedInfo extends AbstractBusinessTransaction
{
    protected function prepare($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'userName');
        ValidationUtil::valBlankOrNull($input, 'userIp');
        ValidationUtil::valBlankOrNull($input, 'userDevice');
        ValidationUtil::valBlankOrNull($input, 'userBrowser');

        $username = $input['username'];
        $userIp = $input['userIp'];
        $userDevice = $input['userDevice'];
        $userBrowser = $input['userBrowser'];

        $findUserByUsername = new FindUserByUsername;
        $user = $findUserByUsername->execute($username);

        $userLoggedInfo = [
            'userId' => $user,
            'userIp' => '',
            'userDevice' => '',
            'userBrowser' => '',
            'userToken' => '',
            'active' => CommonConstant::$YES,
            'activeDatetime' => DateUtil::currentDate(),
            'nonActiveDatetime' => '',
        ];
    }

    protected function process($input, $oriInput)
    {
        $userLoggedInfo = $input['userLoggedInfo'];

    }

    function getDescription()
    {
        return "Digunakan untuk melakukan generate informasi user login";
    }
}