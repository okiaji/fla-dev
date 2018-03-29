<?php
namespace App\Http\Controllers\App\Admin;

use App\FLA\BusinessObject\BusinessFunction\GetUserListAdvance;
use App\FLA\Common\CommonConstant;
use App\FLA\Core\CoreException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{

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

}