<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\OutletAreaCreateRequest;
use App\Http\Requests\OutletAreaUpdateRequest;
use App\Http\Resources\ModelResource;
use App\Models\OutletArea;

class OutletAreaController extends Controller
{


    public function all()
    {
        return ModelResource::collection(OutletArea::with('area' , 'outlet')->paginate(config('main.JsonResultCount')));
    }

    public function create()
    {
        //
    }

    public function store(ItemCreateRequest $request)
    {
        $area = new OutletArea();
        $area->fill($request->all());
        $area->save();

        return new ModelResource($area);
    }

    public function show($id)
    {
        $outlet_area = OutletArea::with('area' , 'outlet')->find($id);

        if ($outlet_area === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return new ModelResource($outlet_area);
    }

    public function edit(OutletArea $outletArea)
    {
        //
    }

    public function update(OutletAreaUpdateRequest $request)
    {

        $outlet_area = OutletArea::find($request->outlet_area_id);
        if ($outlet_area === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $outlet_area->update($request->all());
        $outlet_area->save();

        return new ModelResource($outlet_area);
    }

    public function destroy($id)
    {
        $outlet_area = OutletArea::find($id);
        if ($outlet_area === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $outlet_area->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }
}
