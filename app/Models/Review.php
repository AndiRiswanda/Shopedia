<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey = 'review_id';

    //realtionship
    
    //works
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    //works
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
