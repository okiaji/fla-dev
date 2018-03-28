<?php
namespace App\Http\Controllers\App\Common;

use App\FLA\Common\BusinessObject\BusinessTransaction\AuthUserLogin;
use App\FLA\Common\BusinessObject\BusinessTransaction\DestroyUserLogin;
use App\FLA\Common\CommonConstant;
use App\FLA\Core\CoreException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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

            $user = new AuthUserLogin();
            $userJson = $user->execute($input);
            return response()->json([
                'status' => CommonConstant::$OK,
                'response' => $userJson
            ])->withCookie(Cookie::forever('token', $userJson['user_token']));;

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
            'userToken' => $_COOKIE['token']
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