<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
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


    public function getAllData($data = [])
    {
        $users = self::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $users->whereRaw(" 		(CONCAT_WS('', first_name,last_name,username,email)) LIKE LOWER('%".(trim($data)) ."%')");
        }

        return $users->orderBy('created_at', 'desc')->paginate(20);
    }

    /**
     * Get user cart
     * @return void
     */
    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    /**
     * Get user orders
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Get user orders
     * @return void
     */
    public function activeOrders()
    {
        return $this->hasMany(Order::class, 'user_id')->where('status', '<>', "cancelled");
    }


    public function getNameAttribute()
    {
        return $this->first_name ." ".$this->last_name;
    }
}
