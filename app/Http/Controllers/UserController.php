<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkAsReadRequest;
use App\Http\Requests\NearbyCafeRequest;
use App\Http\Requests\UserChangePassword;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserFindByMail;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ModelResource;
use App\Models\User;
use App\Notifications\ItemNotification;
use File;
use Hash;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use Redis;
use Storage;

class UserController extends Controller
{

    public function __construct()
    {

    }


    public function all()
    {
        // all
        return ModelResource::collection(User::paginate(config('main.JsonResultCount')));

        // all with relations
        //return ModelResource::collection((User::with('relation','relation'))->paginate(config('main.JsonResultCount')));

    }


    public function store(UserCreateRequest $request)
    {

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($user->password);

        $user->save();

        return new ModelResource($user);


    }


    public function show($id)
    {
        $user = User::with('items', 'notifications')->find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return response([
            'data'          => $user ,
        ] , 200);

    }

    public function update(UserUpdateRequest $request , $id)
    {
        $user = User::find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        $user->update($request->all());
        return new ModelResource($user);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $user->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }


    public function ChangeUserPassword(UserChangePassword $request)
    {
        $user = User::where('email' , $request->input('email'))->first();

        if ( ! $user)
        {
            return response()->json([
                'status'  => 'Failed' ,
                'message' => trans('main.credentials') ,
            ] , 400);
        } elseif (Hash::check($request->input('old_password') , $user->password)
        )
        {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return response(['message' => trans('passwords.reset')] , 200);
        }

        return response()->json([
            'status'  => 'Failed' ,
            'message' => trans('main.credentials') ,
        ] , 400);
    }

    public function getUserNotifications($id)
    {
        $user = User::find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        return new ModelResource($user->notifications);
    }

    public function markAsRead(MarkAsReadRequest $request)
    {
        // TODO validate if the user is authorized to mark the notification
        $notification = DatabaseNotification::find($request->notification_id);
        $notification->markAsRead();
        return new ModelResource($notification);
    }

}


