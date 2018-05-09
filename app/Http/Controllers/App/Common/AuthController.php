<?php
namespace App\Http\Controllers\App\Common;

use App\FLA\Common\BusinessObject\BusinessFunction\user\GetUserInfoByToken;
use App\FLA\Common\BusinessObject\BusinessTransaction\user\AuthUserLogin;
use App\FLA\Common\BusinessObject\BusinessTransaction\user\DestroyUserLogin;
use App\FLA\Common\CommonConstant;
use App\FLA\Core\CoreException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $agent = new Agent();
            $device = $agent->platform()." ".$agent->version($agent->platform());
            $browser = $agent->browser()." ".$agent->version($agent->browser());

            $input=[
                'usernameOrEmail' => $request['username'],
                'password' => $request['password'],
                'ip' => $request->ip(),
                'device' => $device,
                'browser' => $browser
            ];

            // Auth login
            $authUser = new AuthUserLogin();
            $userLoggedInfo = $authUser->execute($input);

            // Get user info
            $getUserInfo = new GetUserInfoByToken();
            $userInfo = $getUserInfo->execute([
                'token' => $userLoggedInfo['user_token']
            ]);

            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $userInfo
            ])->withCookie(Cookie()->forever('FLA-TOKEN', $userLoggedInfo['user_token'], null, null, false, false));

        } catch (CoreException $e) {
            return response()->json([
                'status' => CommonConstant::$FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $destroyUserLogin = new DestroyUserLogin();
        $destroyUserLogin->execute([
            'userToken' => $_COOKIE['FLA-TOKEN']
        ]);

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }

        return response()->json([
            'status' => CommonConstant::$OK
        ]);
    }

}