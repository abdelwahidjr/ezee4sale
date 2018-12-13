<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryCreateRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Http\Resources\ModelResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct()
    {

    }
   
    public function store(SubCategoryCreateRequest $request)
    {
        $subcategory = new SubCategory;
        $subcategory->fill($request->all());
        $subcategory->save();
        return new ModelResource($subcategory);
    }
    public function show($id)
    {
        $subcategory = SubCategory::find($id);

        if ($subcategory === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return new ModelResource($subcategory);
    }
    public function update(SubCategoryUpdateRequest $request , $id)
    {
        $subcategory = SubCategory::find($id);

        if ($subcategory === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        $subcategory->update($request->all());
        $subcategory->save();
        return new ModelResource($subcategory);
    }
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        if ($subcategory === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $subcategory->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }


}
