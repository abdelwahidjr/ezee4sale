<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCreateRequest;

use App\Http\Requests\ItemUpdateRequest;
use App\Http\Resources\ModelResource;

use App\Models\Item;
use App\Models\User;
use File;
use Hash;
use Storage;


class ItemController extends Controller
{

    public function __construct()
    {

    }


    public function all()
    {
        // all
        return ModelResource::collection(Item::paginate(config('main.JsonResultCount')));

        // all with relations
        //return ModelResource::collection((Item::with('relation','relation'))->paginate(config('main.JsonResultCount')));

    }


    public function store(ItemCreateRequest $request)
    {

        $item = new Item;
        $item->fill($request->all());

        $image_arr = [];

        foreach ($request->image as $k => $v)
        {
            $extension = $v->getClientOriginalExtension();
            $sha1      = sha1($v->getClientOriginalName());
            $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);

            Storage::disk('public')->put('images/item/' . $filename . '.' . $extension , File::get($v));

            $image_arr[$k] = 'storage/images/item/' . $filename . "." . $extension;
        }
        $item->images_url = $image_arr;

        $item->save();

        return new ModelResource($item);


    }


    public function show($id)
    {
        $item = Item::with('user')->find($id);
        if ($item === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return response([
            'data'          => $item ,
        ] , 200);

    }

    public function update(ItemUpdateRequest $request , $id)
    {
        $item = Item::find($id);
        if ($item === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        $item->update($request->all());

        if (isset( $request->image))
        {
            $image_arr = [];

            foreach ($request->image as $k => $v)
            {
                $extension = $v->getClientOriginalExtension();
                $sha1      = sha1($v->getClientOriginalName());
                $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);

                Storage::disk('public')->put('images/item/' . $filename . '.' . $extension , File::get($v));

                $image_arr[$k] = 'storage/images/item/' . $filename . "." . $extension;
            }

            $item->images_url = $image_arr;

            $item->save();
        }


        return new ModelResource($item);
    }


    public function destroy($id)
    {
        $item = Item::find($id);
        if ($item === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $item->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }

    public function userAds($id)
    {
        $user = User::find($id);
        if ($user === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        return new ModelResource($user->items()->where('type', 'ad')->paginate(config('main.JsonResultCount')));
    }
}


