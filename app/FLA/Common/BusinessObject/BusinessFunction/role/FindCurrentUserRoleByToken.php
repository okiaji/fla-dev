<?php

namespace App\FLA\Common\BusinessObject\BusinessFunction\role;


use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Common\Model\Role;
use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\ConditionExpression;
use App\FLA\Core\CoreException;
use App\FLA\Core\QueryBuilder;
use App\FLA\Core\Util\ValidationUtil;
use Illuminate\Support\Facades\DB;

class FindCurrentUserRoleByToken extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, "token");

        $token = $input['token'];

        $builder = new QueryBuilder();
        $builder->add(' SELECT A.role_id, A.role_code, A.role_name, A.role_desc ')
            ->add(' FROM ')->add(Role::getTableName())->add(' A ')
            ->add(' INNER JOIN ')->add(UserLoggedInfo::getTableName())->add(' B ON A.role_id = B.user_current_role_id ')
            ->add(' WHERE ')->add(ConditionExpression::equalCaseSensitive("B.user_token", $token));
        $role = DB::select($builder->toString());

        if(!empty($role) && $role[0]!=null) {
            return $role[0];
        } else {
            throw new CoreException(CommonExceptionsConstant::$CURRENT_USER_ROLE_IS_NOT_FOUND_BY_TOKEN, $token);
        }
    }

    function getDescription()
    {
        return "Digunakan untuk mendapatkan current role dari token yang dikirim";
    }
}