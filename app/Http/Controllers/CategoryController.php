<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\ModelResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {

    }
    public function all()
    {
        return ModelResource::collection(Category::with('subCategories')->paginate(config('main.JsonResultCount')));
    }
    public function store(CategoryCreateRequest $request)
    {
        $category = new Category;
        $category->fill($request->all());
        $category->save();
        return new ModelResource($category);
    }
    public function show($id)
    {
        $category = Category::with('subCategories')->find($id);

        if ($category === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return new ModelResource($category);
    }
    public function update(CategoryUpdateRequest $request , $id)
    {
        $category = Category::find($id);

        if ($category === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        $category->update($request->all());
        $category->save();
        return new ModelResource($category);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $category->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }

   

}
