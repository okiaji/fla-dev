<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction\role;

use App\FLA\Common\Model\Role;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\ConditionExpression;
use App\FLA\Core\QueryBuilder;
use App\FLA\Core\Util\ValidationUtil;
use Illuminate\Support\Facades\DB;

class CountRoleListAdvance extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valContainsKey($input, 'code');
        ValidationUtil::valContainsKey($input, 'name');
        ValidationUtil::valContainsKey($input, 'desc');

        $code = $input['code'];
        $name = $input['name'];
        $desc = $input['desc'];

        $builder = new QueryBuilder();
        $builder->add(' SELECT COUNT(1) AS count ')
                ->add(' FROM ')->add(Role::getTableName())->add(' A ')
                ->add(' WHERE true ')
                ->addIfNotEmpty($code, ' AND '.ConditionExpression::likeCaseInsensitive('A.role_code', $code))
                ->addIfNotEmpty($name, ' AND '.ConditionExpression::likeCaseInsensitive('A.role_name', $name))
                ->addIfNotEmpty($desc, ' AND '.ConditionExpression::likeCaseInsensitive('A.role_desc', $desc));
        $role = DB::select($builder->toString());

        return [
            "count"=>$role[0]->count
        ];
    }

    function getDescription()
    {
        return "Digunakan untuk mengitung jumlah list role";
    }
}