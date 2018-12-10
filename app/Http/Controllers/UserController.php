<?php

namespace App\Http\Controllers;

use App\Http\Requests\NearbyCafeRequest;
use App\Http\Requests\UserChangePassword;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserFindByMail;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ModelResource;
use App\Models\Friend;
use App\Models\Outlet;
use App\Models\User;
use File;
use Hash;
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

        $extension = $request->avatar->getClientOriginalExtension();
        $sha1      = sha1($request->avatar->getClientOriginalName());
        $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);

        Storage::disk('public')->put('images/avatar/' . $filename . '.' . $extension , File::get($request->avatar));

        $user->fill($request->all());
        $user->avatar   = 'storage/images/avatar/' . $filename . "." . $extension;
        $user->password = Hash::make($user->password);

        $user->save();

        return new ModelResource($user);


    }


    public function show($id)
    {
        $user = User::with('employee' , 'city' , 'order' ,
            'review' , 'user_setting' , 'habits' ,
            'sent_request' , 'received_request', 'gift_cards')->find($id);

        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return response([
            'data'          => $user ,
            'notifications' => $user->notification() ,
            'friends'       => $user->friends() ,
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

        $extension = $request->avatar->getClientOriginalExtension();
        $sha1      = sha1($request->avatar->getClientOriginalName());
        $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);
        $path      = 'images/avatar/' . $filename . '.' . $extension;

        Storage::disk('public')->put($path , File::get($request->avatar));

        $user->update($request->all());
        $user->avatar = 'storage/images/avatar/' . $filename . "." . $extension;
        $user->save();

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


    public function FindByMail(UserFindByMail $request)
    {
        $email = $request->input('email');

        $user = User::with('area')->where('email' , $email)->first();

        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return new ModelResource($user);
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


    public function getOnlineUsers()
    {
        $users = json_decode(Redis::get('presence-onlineUsers:members') , true);
        $ids   = [];

        foreach ($users as $user)
        {
            if ( ! in_array($user['user_id'] , $ids , true))
            {
                array_push($ids , $user['user_id']);
            }

        }

        return new ModelResource(User::whereIn('id' , $ids)->paginate('10'));
    }


    public function suggestionsByFriends($id)
    {
        $suggestions_ids = collect();
        $user = User::find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        // get user friends suggestions according to mutual friends
        $friends_ids = Friend::where('user_id', $id)->pluck('friend_id');
        foreach ($friends_ids as $friend_id){
           $suggestions_ids = $suggestions_ids->merge(
               Friend::where('user_id', $friend_id)
                   ->whereNotIn('friend_id', $suggestions_ids)
                   ->whereNotIn('friend_id', $friends_ids)
                   ->pluck('friend_id'));
        }
        $selected_suggestions_ids = $suggestions_ids->count() <= 10 ? $suggestions_ids : $suggestions_ids->random(10)->all();
        return new ModelResource(User::find($selected_suggestions_ids));
    }
    public function suggestionsByLocation($id)
    {
        $user = User::find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
       return new ModelResource(User::where('city_id', $user->city_id)->where('id', '!=', $id)->get());
    }

    public function nearbyCafes(NearbyCafeRequest $request)
    {
        $boundaries  = 0.04497; // equals to 5km
        $lat = $request->lat;
        $lng = $request->lng;
        return new ModelResource(
            Outlet::where('latitude', '<=', $lat + $boundaries)
                ->where('latitude', '>=', $lat - $boundaries)
                ->where('longitude', '<=', $lng + $boundaries)
                ->where('longitude', '>=', $lng - $boundaries)
                ->get()
        );
    }

}


