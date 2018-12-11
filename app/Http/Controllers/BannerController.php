<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Requests\BannerCreateRequest;
use App\Http\Resources\ModelResource;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\File;
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
        Storage::disk('public')->put('images/Banners/' . $filename . '.' . $extension , File::get($request->image));
        $banner->fill($request->all());
        $banner->image = 'storage/images/Banners/' . $filename . "." . $extension;

        return new ModelResource($banner);
    }
}
