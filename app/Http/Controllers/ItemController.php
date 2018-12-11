<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCreateRequest;

use App\Http\Requests\ItemUpdateRequest;
use App\Http\Resources\ModelResource;

use App\Item;
use Hash;


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
        $item->save();

        return new ModelResource($item);


    }


    public function show($id)
    {
        $item = Item::with('')->find($id);
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

}


