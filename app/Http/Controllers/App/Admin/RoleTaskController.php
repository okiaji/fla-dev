<?php
namespace App\Http\Controllers\App\Admin;

use App\FLA\Common\BusinessObject\BusinessFunction\role\CountRoleListAdvance;
use App\FLA\Common\BusinessObject\BusinessFunction\role\GetRoleListAdvance;
use App\FLA\Common\BusinessObject\BusinessTransaction\role\AddRole;
use App\FLA\Common\BusinessObject\BusinessTransaction\role\EditRole;
use App\FLA\Common\BusinessObject\BusinessTransaction\role\RemoveRole;
use App\FLA\Common\CommonConstant;
use App\FLA\Core\CoreException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleTaskController extends Controller
{

    public function mappingRoleTask(Request $request) {
        try {

            $input=[
                'roleCode' => $request['roleCode'],
                'roleName' => $request['roleName'],
                'roleDesc' => $request['roleDesc'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $role = new AddRole();
            $resultAddRole = $role->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultAddRole
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function unmappingRoleTask(Request $request) {
        try {

            $input=[
                'id' => $request['id'],
                'roleName' => $request['roleName'],
                'roleDesc' => $request['roleDesc'],
                'active' => $request['active'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $role = new EditRole();
            $resultEditRole = $role->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultEditRole
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getTaskListAdvance(Request $request)
    {
        try {

            $input=[
                'code' => $request['code'],
                'name' => $request['name'],
                'desc' => $request['desc'],
                'limit' => $request['limit'],
                'offset' => $request['offset']
            ];

            $roleList = new GetRoleListAdvance();
            $resultRoleList = $roleList->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultRoleList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function countTaskListAdvance(Request $request)
    {
        try {

            $input=[
                'code' => $request['code'],
                'name' => $request['name'],
                'desc' => $request['desc']
            ];

            $roleList = new CountRoleListAdvance();
            $resultRoleList = $roleList->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultRoleList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

}