<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct(\App\Role $role, \App\RoleUser $roleUser)
    {
        $this->role = $role;
        $this->roleUser = $roleUser;
    }

    /**
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function run()
    {
        if(DB::table('roles')->where('role_id',config('rolesconfig.roles.superuser.role_id'))->orWhere('name','superuser')->first() == null) {
            $roleDetail =  [
                'id'   => 1,
                'name' => config('rolesconfig.roles.superuser.name'),
                'role_id' => config('rolesconfig.roles.superuser.role_id')
            ];
            $this->role->create($roleDetail);
        }

        // Role User
        if(DB::table('role_user')->where('user_id',1)->where('role_id',1)->first()==null){
            $roleUserDetail = [
                'user_id' => 1,
                'role_id' => 1,
            ];
            $this->roleUser->create($roleUserDetail);
        }
    }
}
