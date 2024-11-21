<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'store_id';
    protected $fillable = [
        'store_name',
        'store_desc'
    ];
    
    //relationship
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function storeProducts()
    {
        return $this->hasMany(StoreProduct::class, 'store_id', 'store_id');
    }
}
