<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction;

use App\FLA\Common\CommonConstant;
use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\CoreException;
use App\FLA\Core\Util\ValidationUtil;

class ValTokenIsExists extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'token');

        $token = $input['token'];

        $userLoggedInfo = UserLoggedInfo::where([
            ['user_token', $token],
            ['active', CommonConstant::$YES]
        ])->first();

        if ($userLoggedInfo == null) {
            throw new CoreException('Not Authorized');
        }

        return null;
    }

    function getDescription()
    {
        return "Digunakan untuk memastikan apakah token yang dikirim benar terdaftar";
    }
}