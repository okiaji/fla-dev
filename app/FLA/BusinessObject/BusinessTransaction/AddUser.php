<?php

namespace App\FLA\BusinessObject\BusinessTransaction;

use App\FLA\Common\BusinessObject\BusinessFunction\IsUserExistByUsername;
use App\FLA\Common\CommonConstant;
use App\FLA\Common\Model\User;
use App\FLA\Core\AbstractBusinessTransaction;
use App\FLA\Core\CoreException;
use App\FLA\Core\Util\DateUtil;
use App\FLA\Core\Util\ModelUtil;
use App\FLA\Core\Util\ValidationUtil;

class AddUser extends AbstractBusinessTransaction
{

    protected function prepare($input, $oriInput)
    {

        ValidationUtil::valBlankOrNull($input, 'username');

        $username = $input['username'];

        $checkUser = new IsUserExistByUsername();
        $resultCheck = $checkUser->execute(['username'=>$username]);

        if($resultCheck['exists']) {
            throw new CoreException('User already exists');
        }
    }

    protected function process($input, $oriInput)
    {

        $user = User::find(3);
//        $user->username = $input['username'];
//        $user->full_name = $input['fullName'];
//        $user->email = $input['email'];
//        $user->password = md5($input['password']);
//        $user->create_user_id = -1;
//        $user->update_user_id = -1;
//        $user->version = 0;
//        $user->active = CommonConstant::$YES;
//        $user->active_datetime = DateUtil::currentDatetime();
//        $user->non_active_datetime = '';
        $user = ModelUtil::convertArrayToModel($input, $user);
//        $user->setAttribute("version", "3");

        $result = $user->edit();

        return $result;
    }

    function getDescription()
    {
        return "Digunakan untuk menambah data User";
    }
}