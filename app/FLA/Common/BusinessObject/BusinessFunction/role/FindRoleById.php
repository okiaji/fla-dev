<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction\role;

use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Common\Model\Role;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\CoreException;
use App\FLA\Core\Util\ValidationUtil;

class FindRoleById extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valContainsKey($input, 'id');

        $id = $input['id'];

        $role = Role::find($id);

        if($role==null) {
            throw new CoreException(CommonExceptionsConstant::$DATA_NOT_FOUND, "Role", $id);
        }

        return $role;
    }

    function getDescription()
    {
        return "Digunakan untuk melakukan pengecekan apakah role yang dikirim benar terdaftar";
    }
}