<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'phone',
        'address',
        'zipcode',
        'amount',
    ];

    // One-to-many relationship of the `orders` table with the` order_items` table
     public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}
