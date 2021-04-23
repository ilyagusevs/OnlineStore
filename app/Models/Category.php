<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function parent() {
        return self::where('parent_id', null)->get();
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }
    

}
