<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable
        = [
            'name' ,
            'email' ,
            'password' ,
            'phone' ,
            'language',
            'toggle_music'
        ];

    protected $guarded
        = [
          'balance'
        ];

    use HasApiTokens , Notifiable , HasRoles;


    protected $casts
        = [
            'address'         => 'array' ,
            'social_media'    => 'array' ,
            'all_time_habits' => 'array' ,
            'used_coupons'    => 'array' ,
        ];

    protected $hidden
        = [
            'password' ,
            'remember_token' ,
            'activation_token' ,
        ];


    /*############################################################################################*/

    //   $user->AssignRole('admin'); // guard will be default
    //   $user->AssignRole('admin', 'api'); // explcitly setting the guard name

    public function AssignRole($roles , string $guard = null)
    {
        if ($guard)
        {
            $roles = is_string($roles) ? [$roles] : $roles;
            $guard = $guard ?: $this->getDefaultGuardName();

            $roles = collect($roles)->flatten()->map(function ($role) use (
                $guard
            )
            {
                return $this->GetStoredRole($role , $guard);
            })->each(function ($role)
            {
                $this->ensureModelSharesGuard($role);
            })->all();

            $this->roles()->saveMany($roles);

            $this->forgetCachedPermissions();

        }

        return $this;

    }

    protected function GetStoredRole($role , string $guard) : Role
    {
        if (is_string($role))
        {
            return app(Role::class)->findByName($role , $guard);
        }

        return $role;
    }

    /*############################################################################################*/

    public function city()
    {
        return $this->belongsTo(City::class);

    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }


    public function notification()
    {
        //select * from notifications where send_to regexp '[[:<:]]$id[[:>:]]';

        return Notification::where('send_to' , 'regexp' , '[[:<:]]' . $this->id . '[[:>:]]')
            ->orderBy('created_at' , 'desc')->get();
    }


    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }


    public function user_setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function Habits()
    {
        return $this->hasMany(Habit::class);
    }


    public function sent_request()
    {
        return $this->hasMany(Friendship::class , 'sender_id');
    }


    public function received_request()
    {
        return $this->hasMany(Friendship::class , 'receiver_id');
    }


    public function friends()
    {
        $friends_id = [];
        $friends    = Friend::where([
            ['user_id' , '=' , $this->id] ,
        ])->get();

        foreach ($friends as $friend)
        {
            array_push($friends_id , $friend->friend_id);
        }

        return User::whereIn('id' , $friends_id)->get();
    }

    public function gift_cards()
    {
        return $this->hasMany(GiftCard::class);
    }


    public function chat_rooms()
    {
        return $this->belongsToMany(ChatRoom::class , 'chat_room_users')->withTimestamps();
    }


}
