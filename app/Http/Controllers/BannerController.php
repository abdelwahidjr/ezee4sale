<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerCreateRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Http\Resources\ModelResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

use File;
use Storage;

class BannerController extends Controller
{

    public function __construct()
    {

    }
    public function all()
    {
        return ModelResource::collection(Banner::paginate(config('main.JsonResultCount')));
    }
    public function store(BannerCreateRequest $request)
    {
        $banner = new Banner;
        $extension = $request->image->getClientOriginalExtension();
        $sha1      = sha1($request->image->getClientOriginalName());
        $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);
        if($request->has('image_size_w') and $request->has('image_size_h'))
            $image = Image::make($request->image)
                ->resize($request->input('image_size_w'), $request->input('image_size_h'))
                ->encode($extension);
        else
            $image = File::get($request->image);
        Storage::disk('public')->put('images/banners/' . $filename . '.' . $extension , $image);
        $banner->fill($request->all());
        $banner->image = 'storage/images/banners/' . $filename . "." . $extension;
        $banner->categories = $request->input('categories');
        $banner->save();
        return new ModelResource($banner);
    }
    public function show($id)
    {
        $banner = Banner::find($id);

        if ($banner === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return new ModelResource($banner);
    }
    public function update(BannerUpdateRequest $request , $id)
    {
        $banner = Banner::find($id);

        if ($banner === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $extension = $request->image->getClientOriginalExtension();
        $sha1      = sha1($request->image->getClientOriginalName());
        $filename  = date('Ymdhis') . '-' . $sha1 . rand(100 , 100000);
        if($request->has('image_size_w') and $request->has('image_size_h'))
            $image = Image::make($request->image)
                ->resize($request->input('image_size_w'), $request->input('image_size_h'))
                ->encode($extension);
        else
            $image = File::get($request->image);
        Storage::disk('public')->put('images/banners/' . $filename . '.' . $extension , $image);
        $banner->update($request->all());
        $banner->categories = $request->input('categories');
        $banner->image = 'storage/images/banners/' . $filename . "." . $extension;
        $banner->save();
        return new ModelResource($banner);
    }
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $banner->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }

    public function getHomeBanners(){
        return ModelResource::collection(Banner::where('appear_on_home',true)->paginate(config('main.JsonResultCount')));
    }
    public function getCategoryBanners($category_id){
        return ModelResource::collection(Banner::where('categories','LIKE','%"' . $category_id . '"%')->paginate(config('main.JsonResultCount')));
    }

}
