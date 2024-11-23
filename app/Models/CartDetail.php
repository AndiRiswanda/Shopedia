<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'cart_detail_id';

    protected $fillable = [
        'product_id',
        'quantity',
        'cart_id',
    ];
    //realtionshgip
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_detail_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'product_id');
    }
}
