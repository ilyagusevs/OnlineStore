<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_b_id',
        'title',
        'old_price',
        'new_price',
        'description',
        'slug',
    ];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_b_id');
    }
    
    public function carts() {
        return $this->belongsTo(Cart::class)->withPivot('quantity');
    }

    public function sizes() {
        return $this->hasMany(Size::class);
    }

   
}
