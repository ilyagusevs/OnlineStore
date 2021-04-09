<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'category_id',
        'brand_id',
        'title',
        'old_price',
        'new_price',
        'in_stock',
        'description',
        'alias',
    ];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    
    public function carts() {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
}
