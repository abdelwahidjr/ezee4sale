<?php

namespace App;

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
            'views_count',
            'state',
            'order',
            'images_url',
            'appear_on_home',
        ];
    protected $casts
        = [
            'images_url' => 'array' ,
        ];

}
