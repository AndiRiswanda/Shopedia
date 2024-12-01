<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'order_detail_id';
    
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status',
    ];

    //realationship
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
