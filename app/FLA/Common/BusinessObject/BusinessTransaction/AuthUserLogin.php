<?php

namespace App\FLA\Common\BusinessObject\BusinessTransaction;

use App\FLA\Common\BusinessObject\BusinessFunction\IsUserExistsByForLogin;
use App\FLA\Common\BusinessObject\BusinessFunction\IsUserLoggedInfoExistsByIndex;
use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Core\AbstractBusinessTransaction;
use App\FLA\Core\CoreException;
use App\FLA\Core\CoreMail;
use App\FLA\Core\Util\DateUtil;
use App\FLA\Core\Util\GeneralUtil;
use App\FLA\Core\Util\ModelUtil;
use App\FLA\Core\Util\ValidationUtil;

class AuthUserLogin extends AbstractBusinessTransaction
{

    protected function prepare(&$input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, "usernameOrEmail");
        ValidationUtil::valBlankOrNull($input, "password");
        ValidationUtil::valBlankOrNull($input, "ip");
        ValidationUtil::valBlankOrNull($input, "device");
        ValidationUtil::valBlankOrNull($input, "browser");

        $usernameOrEmail = $input['usernameOrEmail'];
        $password = md5($input['password']);
        $ip = $input['ip'];
        $device = $input['device'];
        $browser = $input['browser'];
        $datetimeNow = DateUtil::currentDatetime();
        $isNewClient = false;

        $checkUser = new IsUserExistsByForLogin();
        $resultCheckUser = $checkUser->execute([
            'usernameOrEmail'=>$usernameOrEmail,
            'password'=>$password
        ]);

        if(!$resultCheckUser['exists']) {
            throw new CoreException(CommonExceptionsConstant::$LOGIN_INFORMATION_IS_NOT_VALID);
        }

        $user = $resultCheckUser['user'];
        $userToken = GeneralUtil::generateToken($user->username, $datetimeNow);
        $userId = $user->user_id;

        $checkUserLoggedInfo = new IsUserLoggedInfoExistsByIndex();
        $resultCheckUserLoggedInfo = $checkUserLoggedInfo->execute([
            'userId'=>$user->user_id,
            'userIp'=>$ip,
            'userDevice'=>$device,
            'userBrowser'=>$browser
        ]);

        if($resultCheckUserLoggedInfo['exists']) {
            $isNewClient = true;

            $userLoggedInfo = $resultCheckUserLoggedInfo['userLoggedInfo'];

            $userLoggedInfoArr = [
                'id' => $userLoggedInfo->user_logged_info_id,
                'userToken' => $userToken,
                'updateUserId' => $userId
            ];

        } else {
            $userLoggedInfoArr = [
                'userId' => $user->user_id,
                'userIp' => $ip,
                'userDevice' => $device,
                'userBrowser' => $browser,
                'userToken' => $userToken,
                'createUserId' => $userId,
                'updateUserId' => $userId,
                'version' => 0
            ];
            $this->activated($userLoggedInfoArr);
        }

        $input['isNewClient'] = $isNewClient;
        $input['userLoggedInfoArr'] = $userLoggedInfoArr;


    }

    protected function process(&$input, $oriInput)
    {
        $isNewClient = $input['isNewClient'];
        $userLoggedInfoArr = $input['userLoggedInfoArr'];

        if($isNewClient) {
            // Update token
            $userLoggedInfo = UserLoggedInfo::find($userLoggedInfoArr['id']);
            $userLoggedInfo = ModelUtil::convertArrayToModel($userLoggedInfoArr, $userLoggedInfo);
            $result = $userLoggedInfo->edit();
        } else {
            // Insert data user logged info
            $userLoggedInfo = new UserLoggedInfo();
            $userLoggedInfo = ModelUtil::convertArrayToModel($userLoggedInfoArr, $userLoggedInfo);
            $result = $userLoggedInfo->add();
        }

        $data = array('name'=>"Congky", 'text'=>'Anda baru saja login');

//        CoreMail::send('mail',$data);

        return $result;
    }

    function getDescription()
    {
        return "Untuk melakukan authentikasi login";
    }
}