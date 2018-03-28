<?php
namespace App\FLA\Core;
use Mail;

class CoreMail
{
    public static function send($template_view, $data) {
        Mail::send($template_view, $data, function($message) {
            $message->to('ky.cong11@gmail.com', 'Success Login')->subject
            ('Laravel Basic Testing Mail');
            $message->from('no-reply@fla.com','Admin FLA');
        });
    }
}