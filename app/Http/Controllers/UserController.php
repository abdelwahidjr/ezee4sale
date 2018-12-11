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
        $user->fill($request->all());
        $user->password = Hash::make($user->password);

        $user->save();

        return new ModelResource($user);


    }


    public function show($id)
    {
        $user = User::with('')->find($id);
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

}


