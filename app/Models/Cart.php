<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'cart_id';
    
    protected $fillable = [
        'user_id',
    ];

    //realtionship
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
    
    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'cart_id');
    }

}
