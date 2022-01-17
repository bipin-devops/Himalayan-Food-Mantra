<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['title','order_id','product_id','quantity','unit_price'];


    /**
     * Total Attribute Of Order Product
     * @return int
     */
    public function getTotalAttribute() :int
    {
        return $this->quantity * $this->unit_price;
    }
}
