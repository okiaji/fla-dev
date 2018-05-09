<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction\role;

use App\FLA\Common\Model\Role;
use App\FLA\Common\Model\UserRole;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\ConditionExpression;
use App\FLA\Core\QueryBuilder;
use App\FLA\Core\Util\ValidationUtil;
use Illuminate\Support\Facades\DB;

class GetRoleListByUserId extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valContainsKey($input, 'userId');

        $userId = $input['userId'];

        $builder = new QueryBuilder();
        $builder->add(' SELECT A.role_id, A.role_code, A.role_name, A.role_desc, A.active ')
                ->add(' FROM ')->add(Role::getTableName())->add(' A ')
                ->add(' INNER JOIN ')->add(UserRole::getTableName())->add(' B ON A.role_id = B.role_id ')
                ->add(' WHERE ')->add(ConditionExpression::likeCaseSensitive('B.user_id', $userId))
                ->add(' ORDER BY A.role_code, A.role_name ');
        $role = DB::select($builder->toString());

        return [
            "roleList"=>$role
        ];
    }

    function getDescription()
    {
        return "Digunakan untuk mendapatkan list role dari user id yang dikirim";
    }
}