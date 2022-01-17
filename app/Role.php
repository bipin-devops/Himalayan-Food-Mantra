<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=['id'];

    public function getAllData($data = array())
    {
        $role = Role::query();
        if (isset($data['keywords'])) {
            $role->where('name', 'LIKE', '%' . $data['keywords'] . '%');
        }
        return $role->paginate(20);
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getUserRoles($id)
    {
        $permisssionArray = array();
        $role = Role::where('id', $id)->first();
        $permission = $role->permissions;
        if ($permission != null) {
            foreach (json_decode($permission) as $key => $value) {
                $key = explode('.', $key, 2);
                @$permisssionArray[$key[0]][$key[1]] = $value;
            }
        }

        return $permisssionArray;
    }
}
