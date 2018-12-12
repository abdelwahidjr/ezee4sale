<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //
    protected $fillable
        = [
            'audio_file' ,
            'whats_app' ,
            'phone' ,
            'email' ,
        ];

    protected $casts
        = [
            'audio_file' => 'array',
            'whats_app'  => 'array',
            'phone'  => 'array',
            'email'  => 'array',
        ];
}
