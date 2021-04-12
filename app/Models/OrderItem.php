<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'title',
        'size',
        'price',
        'quantity',
        'cost',
    ];

    // An item belongs relationship of the `order_items` table to the` products` table
     public function product() {
        return $this->belongsTo(Product::class);
    }
}
