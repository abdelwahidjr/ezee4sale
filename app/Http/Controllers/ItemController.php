<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCreateRequest;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Requests\ItemUpdateRequest;
use App\Http\Requests\ItemViewsRequest;
use App\Http\Requests\ReShareItemRequest;
use App\Http\Resources\ModelResource;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
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

    public function categoryItems($category, $sub_category)
    {
        return ModelResource::collection(Item::where('category_id', $category)
            ->where('sub_category_id', $sub_category)
            ->where('due_date', '>', Carbon::now()->format('Y-m-d'))
            ->orderBy('state', 'ASC')->orderBy('order', 'DESC')->paginate(config('main.JsonResultCount')));
    }
    public function categoryAdItems($category, $sub_category)
    {
        return ModelResource::collection(Item::where('category_id', $category)
            ->where('sub_category_id', $sub_category)
            ->where('type','ad')
            ->where('due_date', '>', Carbon::now()->format('Y-m-d'))
            ->orderBy('state', 'ASC')->orderBy('order', 'DESC')->paginate(config('main.JsonResultCount')));
    }

    public function categoryMarketItems($category, $sub_category)
    {
        return ModelResource::collection(Item::where('category_id', $category)
            ->where('sub_category_id', $sub_category)
            ->where('type','market')
            ->where('due_date', '>', Carbon::now()->format('Y-m-d'))
            ->orderBy('state', 'ASC')->orderBy('order', 'DESC')->paginate(config('main.JsonResultCount')));
    }
    public function store(ItemCreateRequest $request)
    {

        $item = new Item;
        $item->fill($request->all());
        $category = Category::find($item->category_id);
        $user = User::find($item->user_id);
        if ($category->price > $user->balance) {
            return response([
                'message' => trans('main.balanceShortage'),
            ], 400);
        }

        $image_arr = [];

        foreach ($request->image as $k => $v) {
            $extension = $v->getClientOriginalExtension();
            $sha1 = sha1($v->getClientOriginalName());
            $filename = date('Ymdhis') . '-' . $sha1 . rand(100, 100000);
            if($request->has('image_size_w') and $request->has('image_size_h'))
            $image = Image::make($v)
                ->resize($request->input('image_size_w'), $request->input('image_size_h'))
                ->encode($extension);
            else
            $image = File::get($v);
            Storage::disk('public')->put('images/item/' . $filename . '.' . $extension, $image);

            $image_arr[$k] = 'storage/images/item/' . $filename . "." . $extension;
        }
        $item->images_url = $image_arr;
        $date = Carbon::now()->format('d-m-Y');
        $daysToSum = $category->deprecated_time;
        $due_date = date('Y-m-d', strtotime($date . ' + ' . $daysToSum . ' days'));
        $item->due_date = $due_date;
        $user->balanceSubtract($category->price);
        $item->save();

        return new ModelResource($item);


    }

    public function reshareItem(ReShareItemRequest $request)
    {
        $item_id = $request->input('item_id');
        $user_id = $request->input('user_id');
        $item = Item::with('user')->find($item_id);
        if ($item === null) {
            return response([
                'message' => trans('main.null_entity'),
            ], 422);
        }
        if ($item->user->id != $user_id) {
            return response([
                'message' => trans('main.credentials'),
            ], 400);
        }
        $category = Category::find($item->category_id);
        if ($category->price > $item->user->balance) {
            return response([
                'message' => trans('main.balanceShortage'),
            ], 400);
        }
        $mydate = Carbon::now()->format('d-m-Y');
        $daysTosum = $category->deprecated_time;
        $due_date = date('Y-m-d', strtotime($mydate . ' + ' . $daysTosum . ' days'));
        $item->due_date = $due_date;
        $item->save();
        $item->user->balanceSubtract($category->price);
        return new ModelResource($item);
    }

    public function viewed(ItemViewsRequest $request)
    {
        $item = Item::find($request->input('item_id'));
        $item->viewed();
        return new ModelResource($item);
    }

    public function show($id)
    {
        $item = Item::with('user')->find($id);
        if ($item === null) {
            return response([
                'message' => trans('main.null_entity'),
            ], 422);
        }

        return response([
            'data' => $item,
        ], 200);

    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $item = Item::find($id);
        if ($item === null) {
            return response([
                'message' => trans('main.null_entity'),
            ], 422);
        }

        $item->update($request->all());

        if (isset($request->image)) {
            $image_arr = [];

            foreach ($request->image as $k => $v) {
                $extension = $v->getClientOriginalExtension();
                $sha1 = sha1($v->getClientOriginalName());
                $filename = date('Ymdhis') . '-' . $sha1 . rand(100, 100000);

                if($request->has('image_size_w') and $request->has('image_size_h'))
                    $image = Image::make($v)
                        ->resize($request->input('image_size_w'), $request->input('image_size_h'))
                        ->encode($extension);
                else
                    $image = File::get($v);
                Storage::disk('public')->put('images/item/' . $filename . '.' . $extension, $image);

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
        if ($item === null) {
            return response([
                'message' => trans('main.null_entity'),
            ], 422);
        }
        $item->delete();

        return response()->json([
            'status' => 'deleted',
            'message' => trans('main.deleted'),
        ], 200);
    }

    public function userAds($id)
    {
        $user = User::find($id);
        if ($user === null) {
            return response([
                'message' => trans('main.null_entity'),
            ], 422);
        }
        return new ModelResource($user->items()->where('type', 'ad')->paginate(config('main.JsonResultCount')));
    }
}


