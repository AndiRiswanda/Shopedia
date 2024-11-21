<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    protected $primaryKey = 'product_id';
    use HasFactory;

    //REALTIONSHIP
    //works
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }
    //works
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }  

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'product_id', 'product_id');
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class, 'product_id', 'product_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id', 'product_id');
    }

    public function storeProduct()
    {
        return $this->belongsTo(StoreProduct::class, 'product_id', 'product_id');
    }
    
}
