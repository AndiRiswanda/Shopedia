<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'store_product_id';
    protected $fillable = [
        'store_id',
        'product_id',
    ];
    
    //realationship
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function store()
    {
        return $this->belongsTo(store::class, 'store_id', 'store_id');
    }

}
