<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use Illuminate\Http\Request;


class PushNotificationController extends Controller
{


    public function send(NotificationRequest $request)
    {
        $notifier = new OnSignalNotifierController();
        $messages = array();
        foreach ($request->input('message') as $row) {
            $messages[$row['key']] = $row['body'];
        }
        foreach ($messages as $key => $message)
             $notifier->addMessage($key,$message);
        if ($request->has('data')) {
            $notifier->addData($request->input('data'));
        }
        if ($request->has('player_ids')) {
            $notifier->addPlayerIDS($request->input('player_ids'));
            $notifier->send();
        }
        if ($request->has('segment')) {
            $notifier->addSegment($request->input('segment'));
            $notifier->send();
        }
    }
}
