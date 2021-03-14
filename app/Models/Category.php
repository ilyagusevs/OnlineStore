<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function products(){
        return $this->hasManyThrough(Product::class, Category::class, 'parent_id', 'category_id', 'id', 'id');
    }

//    public function products(){
//          return $this->hasMany('App\Models\Product');
//     }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
