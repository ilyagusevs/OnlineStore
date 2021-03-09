<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id', 'name'];

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id'); // static, jo savienojas pats ar sevi (rekursija)
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
