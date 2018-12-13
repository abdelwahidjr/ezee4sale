<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendNotificationsRequest;
use App\Models\User;
use App\Notifications\ItemNotification;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    //
    public function SendNotifications(SendNotificationsRequest $request)
    {
        $users = User::find($request->user_ids);
        foreach ($users as $user)
        {
            $user->notify(new ItemNotification($request->item_id));
        }

        return response([
            'message' => trans('notifications.sent') ,
        ] , 200);

    }
}
