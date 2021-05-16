<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey = 'b_id';

    protected $fillable = [
        'brand',
        'brand_slug',
    ];
    
    public function products() {
        return $this->hasMany(Product::class);
    }
}
