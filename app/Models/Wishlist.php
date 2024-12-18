<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
    ];

    use HasFactory;
    protected $primaryKey = 'wishlist_id';
    //realtionship
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
