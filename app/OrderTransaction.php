<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTransaction extends Model
{
    //
    protected $fillable = ['order_id','total','response','payment_status'];


    public static $paymentMethods = [
        0 => "Cash After Delivery",
    ];
}
