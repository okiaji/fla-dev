<?php
namespace App\FLA\Common\BusinessObject\BusinessFunction\role;

use App\FLA\Common\Model\Role;
use App\FLA\Core\AbstractBusinessFunction;
use App\FLA\Core\Util\ValidationUtil;

class IsRoleExistsByIndex extends AbstractBusinessFunction
{

    protected function process($input, $oriInput)
    {
        ValidationUtil::valContainsKey($input, 'roleCode');

        $roleCode = $input['roleCode'];

        $role = Role::where([
            ['role_code', $roleCode]
        ])->first();

        $result = [
            'exists' => false
        ];

        if ($role != null) {
            $result = [
                'exists' => true,
                'role' => $role
            ];
        }
    }

    function getDescription()
    {
        return "Digunakan untuk melakukan pengecekan apakah role yang dikirim benar terdaftar";
    }
}