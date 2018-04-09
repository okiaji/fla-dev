<?php
/**
 * Created by PhpStorm.
 * User: Cong
 * Date: 2/25/2018
 * Time: 10:47 PM
 */

namespace App\Http\Controllers;
use App\FLA\BusinessObject\BusinessTransaction\AddUser;
use App\FLA\Common\BusinessObject\BusinessFunction\FindUserByUsername;
use App\FLA\Common\BusinessObject\BusinessFunction\user\FindUserByToken;
use App\FLA\Common\BusinessObject\BusinessFunction\user\GetUserLoggedInfoListByUserId;
use App\FLA\Common\BusinessObject\BusinessTransaction\AuthUserLogin;
use App\FLA\Common\BusinessObject\BusinessTransaction\role\RemoveRole;
use App\FLA\Common\CommonExceptionsConstant;
use App\FLA\Core\Util\ResponseUtil;
use App\Http\Controllers\Controller;
use App\FLA\BusinessObject\BusinessFunction\GetUserListAdvance;
use Exception;
use App\FLA\Core\CoreException;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class TestController extends Controller
{
    public function test(Request $request)
    {
        try {
            $agent = new Agent();
            $device = $agent->platform()." ".$agent->version($agent->platform());
            $browser = $agent->browser()." ".$agent->version($agent->browser());

            $input=[
                'id' => $request['token'],
                'username' => $request['username'],
                'fullName' => $request['fullName'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $user = new RemoveRole();
            $userJson = $user->execute($input);
//            $userData = $userJson->getData();
//            $userResponse = $userData->response->user_id;

//            dd($userJson);
//            var_dump($userData);
            $data = "";
//            foreach ($userJson["userList"] as $value){
////                echo $key." = ".$value;
//                print_r($value);
//            }
            return response()->json([
                'status' => 'OK',
                'response' => $userJson
            ]);
//            throw new CoreException(CommonExceptionsConstant::$DATA_IS_NOT_ACTIVE, 'Congky');

        } catch (CoreException $e) {
            return response()->json([
                'status' => 'FAIL',
                'message' => $e->getMessage()
            ]);
        }

        return "teswtasdasdsa";
    }
}