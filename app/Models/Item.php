<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable
        = [
            'title',
            'type',
            'user_id',
            'whats_app',
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
            'views_count', 'due_date'
        ];

    protected $casts
        = [
            'images_url' => 'array',
        ];

    public function viewed()
    {
        $this->views_count += 1;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
