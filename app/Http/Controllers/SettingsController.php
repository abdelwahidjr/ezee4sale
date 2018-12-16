<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsCreateRequest;

use App\Http\Requests\SettingsUpdateRequest;
use App\Http\Requests\GenerateSettingssRequest;
use App\Http\Requests\InputCodeRequest;
use App\Http\Resources\ModelResource;

use App\Models\Settings;
use App\Models\User;
use File;
use Hash;
use Storage;


class SettingsController extends Controller
{

    public function __construct()
    {
    }

    public function show()
    {
        // all
        return new ModelResource(Settings::first());
    }


    public function update(SettingsUpdateRequest $request)
    {
        $settings = Settings::first();
        if ($settings === null) {
           $settings = new Settings();
        }
        $settings->fill($request->all());
        if (isset($request->file)) {
            $audio_array = [];

            foreach ($request->file as $k => $v) {
                $extension = $v->getClientOriginalExtension();
                $sha1 = sha1($v->getClientOriginalName());
                $filename = date('Ymdhis') . '-' . $sha1 . rand(100, 100000);

                Storage::disk('public')->put('audio/item/' . $filename . '.' . $extension, File::get($v));

                $audio_array[$k] = 'storage/audio/item/' . $filename . "." . $extension;
            }
            $settings->audio_file = $audio_array;
        }

        $settings->save();
        return new ModelResource($settings);
    }

}


