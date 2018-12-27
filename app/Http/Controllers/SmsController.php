<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//require_once '/vendor/autoload.php';
use Twilio\Rest\Client;


class SmsController extends Controller
{

    public function send($to, $body)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $message = $twilio->messages
            ->create($to,
                array("from" => env('TWILIO_NUMBER'), "body" => $body)
            );
    }
}
