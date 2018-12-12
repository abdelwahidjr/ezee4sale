<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable
        = [
            'title' ,
            'price' ,
        ];
    protected $guarded
    = [
            'code',
            'user_id' ,
        ];
    protected $casts
        = [
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
