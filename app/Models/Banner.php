<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = ['id'];

    protected $fillable
        = [
            'phone',
            'whats_app',
            'email',
            'image',
            'type',
            'appear_on_home'
        ];

    protected $casts
        = [
            'categories' => 'array',
            'sub_categories' => 'array'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
