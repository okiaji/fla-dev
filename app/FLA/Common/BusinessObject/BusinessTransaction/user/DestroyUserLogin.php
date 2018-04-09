<?php

namespace App\FLA\Common\BusinessObject\BusinessTransaction\user;

use App\FLA\Common\BusinessObject\BusinessFunction\user\IsTokenExists;
use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Core\AbstractBusinessTransaction;
use App\FLA\Core\Util\ValidationUtil;

class DestroyUserLogin extends AbstractBusinessTransaction
{

    protected function prepare(&$input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, "userToken");

        $userToken = $input['userToken'];
        $isFoundToken = false;
        $userLoggedInfoArr = [];

        $checkToken = new IsTokenExists();
        $resultCheckToken = $checkToken->execute([
            'token'=>$userToken
        ]);

        if($resultCheckToken['exists']) {
            $isFoundToken = true;
            $userLoggedInfo = $resultCheckToken['userLoggedInfo'];
            $userLoggedInfoArr = [
                'id' => $userLoggedInfo->user_logged_info_id
            ];
        }

        $input['isFoundToken'] = $isFoundToken;
        $input['userLoggedInfoArr'] = $userLoggedInfoArr;

    }

    protected function process(&$input, $oriInput)
    {
        $isFoundToken = $input['isFoundToken'];
        $userLoggedInfoArr = $input['userLoggedInfoArr'];

        if($isFoundToken) {
            // Remove token
            $userLoggedInfo = UserLoggedInfo::find($userLoggedInfoArr['id']);
            $userLoggedInfo->delete();
        }

        return $userLoggedInfoArr;
    }

    function getDescription()
    {
        return "Untuk melakukan penghapusan token user";
    }
}