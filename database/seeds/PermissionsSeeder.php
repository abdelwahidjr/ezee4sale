<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{

    public function run()
    {


        $this->roles_api_seeding();
        $this->permissions_api_seeding();

        $user = User::find('1');
        $user->AssignRole('admin' , 'api');
    }


    public function roles_api_seeding()
    {
        $roles = [
            'admin' ,
            'user' ,
        ];

        foreach ($roles as $role)
        {
            Role::create(['guard_name' => 'api' , 'name' => $role]);
        }
    }

    public function permissions_api_seeding()
    {
        $permissions = [
            'show' ,
            'create' ,
            'edit' ,
            'delete' ,
        ];

        foreach ($permissions as $permission)
        {
            Permission::create(['guard_name' => 'api' , 'name' => $permission]);
        }
    }
}
