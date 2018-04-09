<?php
namespace App\Http\Controllers\App\Admin;

use App\FLA\Common\BusinessObject\BusinessFunction\user\CountUserListAdvance;
use App\FLA\Common\BusinessObject\BusinessFunction\user\GetUserListAdvance;
use App\FLA\Common\CommonConstant;
use App\FLA\Core\CoreException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function adduser(Request $request) {
        try {

            $input=[
                'userTypeId' => $request['username'],
                'username' => $request['username'],
                'fullName' => $request['fullName'],
                'email' => $request['email'],
                'password' => $request['email'],
                'rePassword' => $request['rePassword'],
                'phoneNumber' => $request['phoneNumber'],
                'religion' => $request['religion'],
                'dateOfBirth' => $request['dateOfBirth'],
                'placeOfBirth' => $request['placeOfBirth'],
                'country' => $request['country'],
                'fullAddress' => $request['fullAddress'],
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

    public function editRole(Request $request) {
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

    public function removeRole(Request $request) {
        try {

            $input=[
                'id' => $request['id'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $role = new RemoveRole();
            $resultRemoveRole = $role->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultRemoveRole
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getUserListAdvance(Request $request)
    {
        try {

            $input=[
                'username' => $request['username'],
                'fullName' => $request['fullName'],
                'email' => $request['email'],
                'phoneNumber' => $request['phoneNumber'],
                'limit' => $request['limit'],
                'offset' => $request['offset']
            ];

            $userList = new GetUserListAdvance();
            $resultUserList = $userList->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultUserList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function countUserListAdvance(Request $request)
    {
        try {

            $input=[
                'username' => $request['username'],
                'fullName' => $request['fullName'],
                'email' => $request['email'],
                'phoneNumber' => $request['phoneNumber']
            ];

            $userList = new CountUserListAdvance();
            $resultUserList = $userList->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $resultUserList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

}