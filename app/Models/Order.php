<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Orderdetail;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'total',
        'status',
        'order_detail_id',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(Orderdetail::class, 'order_id', 'order_id');
    }
}
