<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['reference_no','total','user_id','payment_status','status', 'note','first_name','last_name','email','address','phone'];

    public static $allOrderStauts = [
        'pending' => "Pending",
        'processing' => "Processing",
        'ready_for_pickup' => "Ready For PickUp",
        'pickedUp' => "Picked Up",
        'cancelled' => "Cancelled"
    ];

    public static $allColourStauts = [
        'pending' => "bg-teal-800",
        'processing' => "bg-pink-400",
        'ready_for_pickup' => "bg-green-600",
        'pickedUp' => "bg-grey-400",
        'cancelled' => "bg-danger-400"
    ];
    /**
     * Order transaction relation
     * @return void
     */
    public function orderTransaction()
    {
        return $this->hasOne(OrderTransaction::class, 'order_id');
    }

    /**
     * Order transaction relation
     * @return void
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    /**
     * Name of user
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name ." ". $this->last_name;
    }

    /**
     * Frontend status
     * @return string
     */
    public function getFrontendStatusAttribute()
    {
        return self::$allOrderStauts[$this->status] ?? "Pending";
    }

    /**
     * Get All Order Data
     * @param array $data
     * @return void
     */
    public function getAllData($data = [])
    {
        $orders = self::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $orders->whereRaw("(CONCAT_WS('', reference_no)) LIKE LOWER('%".(trim($data)) ."%')");
        }

        return $orders->orderBy('created_at', 'desc')->paginate(20);
    }
}
