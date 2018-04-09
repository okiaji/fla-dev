<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction\user;

use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\QueryBuilder;
use App\FLA\Core\Util\ValidationUtil;
use Illuminate\Support\Facades\DB;

class GetUserLoggedInfoListByUserId extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valContainsKey($input, 'userId');

        $userId = $input['userId'];

        $builder = new QueryBuilder();
        $builder->add(' SELECT A.user_logged_info_id, A.user_id, ')
                ->add(' A.user_ip, A.user_device, A.user_browser, ')
                ->add(' A.user_token, A.version, A.active ')
                ->add(' FROM ')->add(UserLoggedInfo::getTableName())->add(' A ')
                ->add(' WHERE A.user_id = ')->add($userId);
        $userLoggedInfo = DB::select($builder->toString());

        return [
            "userLoggedInfoList"=>$userLoggedInfo
        ];
    }

    function getDescription()
    {
        return "Digunakan untuk mendapatkan list user logged info";
    }
}