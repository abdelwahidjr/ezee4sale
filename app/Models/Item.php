<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable
        = [
            'title' ,
            'type' ,
            'user_id',
            'whats_app' ,
            'place',
            'phone',
            'category_id',
            'sub_category_id',
            'state',
            'order',
            'images_url',
            'appear_on_home',
        ];
    protected $guarded
    = [
            'views_count',
        ];
    protected $casts
        = [
            'images_url' => 'array' ,
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
