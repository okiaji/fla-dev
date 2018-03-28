<?php
namespace App\FLA\Core\Middleware;
use App\FLA\Common\BusinessObject\BusinessFunction\ValTokenIsExists;
use Jenssegers\Agent\Agent;
use App\FLA\Core\CoreException;

class VerifyRequestMiddleware extends CoreMiddleware
{
    protected function beforeRequest($request)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);

        $platform = $agent->platform();
        $platformVersion = $agent->version($platform);

        $token = $request->header('token');
        $tokenCookie = isset($_COOKIE['token'])?$_COOKIE['token']:'';

        if(($token!=null && $token!='') || ($tokenCookie!=null && $tokenCookie!='')) {
            $token = $token!=null&&$token!=''?$token:$tokenCookie;
            $valTokenIsExists = new ValTokenIsExists();
            $valTokenIsExists->execute(['token'=>$token]);
        } else {
            return redirect('/login');
        }
    }

    protected function afterRequest($request)
    {
        $data = array('name'=>"Congky123", 'text'=>'test text 123');

//        CoreMail::send('mail',$data);
    }
}