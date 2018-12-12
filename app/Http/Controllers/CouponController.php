<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponCreateRequest;

use App\Http\Requests\CouponUpdateRequest;
use App\Http\Resources\ModelResource;

use App\Models\Coupon;
use Hash;


class CouponController extends Controller
{

    public function __construct()
    {

    }


    public function all()
    {
        // all
        return ModelResource::collection(Coupon::paginate(config('main.JsonResultCount')));

        // all with relations
        //return ModelResource::collection((Coupon::with('relation','relation'))->paginate(config('main.JsonResultCount')));

    }


    public function store(CouponCreateRequest $request)
    {

        $coupon = new Coupon;
        $coupon->fill($request->all());
        $coupon->code = uniqid();
        $coupon->save();

        return new ModelResource($coupon);


    }


    public function show($id)
    {
        $coupon = Coupon::with('user')->find($id);
        if ($coupon === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        return response([
            'data'          => $coupon ,
        ] , 200);

    }

    public function update(CouponUpdateRequest $request , $id)
    {
        $coupon = Coupon::find($id);
        if ($coupon === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }

        $coupon->update($request->all());
        return new ModelResource($coupon);
    }


    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon === null)
        {
            return response([
                'message' => trans('main.null_entity') ,
            ] , 422);
        }
        $coupon->delete();

        return response()->json([
            'status'  => 'deleted' ,
            'message' => trans('main.deleted') ,
        ] , 200);
    }

}


