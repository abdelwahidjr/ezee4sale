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

    use HasApiTokens , Notifiable , HasRoles;


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

    public function notification()
    {
        //select * from notifications where send_to regexp '[[:<:]]$id[[:>:]]';

        return Notification::where('send_to' , 'regexp' , '[[:<:]]' . $this->id . '[[:>:]]')
            ->orderBy('created_at' , 'desc')->get();
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

}
