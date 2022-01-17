<?php

namespace App;

use App\Traits\CheckPermission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable ,CheckPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllData($data=array())
    {
        $users = User::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $users->whereRaw(" 		(CONCAT_WS('', first_name,last_name,username,email)) LIKE LOWER('%".(trim($data)) ."%')");
        }
        if (isset($data['role'])) {
            $users = User::select('users.*')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', $data['role']);
        }
        if (isset($data['role']) && isset($data['keywords'])) {
            $users = User::select('users.*')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', $data['role'])
                ->whereRaw(" LOWER(CONCAT_WS('', first_name,last_name,username,email)) LIKE LOWER('%".(trim($data['keywords'])) ."%')");
        }


        return $users->orderBy('created_at', 'desc')->paginate(20);
    }

    public function rolesUser()
    {
        return $this->hasOne('App\RoleUser', 'user_id', 'id');
    }
}
