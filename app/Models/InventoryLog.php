<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'log_id';

    protected $fillable = [
        'product_id',
        'change_type',
        'quantity_chance',
        'chance_date',
    ];

    //realtionship
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
