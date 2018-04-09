<?php

namespace App\FLA\Common\BusinessObject\BusinessFunction\user;

use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Common\Model\User;
use App\FLA\Common\Model\UserAdditionalInfo;
use App\FLA\Common\Model\UserLoggedInfo;
use App\FLA\Common\Model\UserType;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\ConditionExpression;
use App\FLA\Core\CoreException;
use App\FLA\Core\QueryBuilder;
use App\FLA\Core\Util\ValidationUtil;
use Illuminate\Support\Facades\DB;

class FindUserByToken extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valBlankOrNull($input, 'token');

        $token = $input['token'];

        $builder = new QueryBuilder();
        $builder->add(' SELECT A.user_id, A.username, A.full_name, A.email, B.phone_number, B.religion, B.date_of_birth, ')
                ->add(' B.place_of_birth, B.country, B.full_address, C.user_type_name, A.active ')
                ->add(' FROM ')->add(User::getTableName())->add(' A ')
                ->add(' INNER JOIN ')->add(UserAdditionalInfo::getTableName())->add(' B ')
                ->add(' ON A.user_id = B.user_id ')
                ->add(' INNER JOIN ')->add(UserType::getTableName())->add(' C ')
                ->add(' ON B.user_type_id = C.user_type_id ')
                ->add(' INNER JOIN ')->add(UserLoggedInfo::getTableName())->add(' D ')
                ->add(' ON A.user_id = D.user_id ')
                ->add(' WHERE ')->add(ConditionExpression::equalCaseSensitive('D.user_token', $token));
        $user = DB::select($builder->toString());

        if ($user[0] == null) {
            throw new CoreException(CommonExceptionsConstant::$TOKEN_IS_NOT_VALID);
        }

        return $user[0];

    }

    function getDescription()
    {
        return "Digunakan untuk mendapatkan informasi user berdasarkan token yang dikirim";
    }
}