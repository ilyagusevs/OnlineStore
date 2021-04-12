<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'size');
    }

    // Increases the number of items $id in the cart by $count
    public function increase($id, $size = "", $count = 1) {
        $this->change($id, $size, $count);
    }

    // Decreases the number of items $id in the cart by the amount of $count
    public function decrease($id, $size = "", $count = 1) {
        $this->change($id, $size, -1 * $count);
    }

    // Changes the quantity of the item $id in the cart by $count
    // If the item is not yet in the cart, it adds this item; 
    // $count can be either positive or negative
    private function change($id, $size, $count = 0) {
        if ($count == 0) {
            return;
        }
        // If the item is in the cart - change the quantity
        if ($this->products->contains($id)) {
            // Get the table row object `cart_product`
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // Update the quantity of the item $id in the cart
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                // Quantity is equal to zero - we remove the item from the cart
                $pivotRow->delete();
            }
        } elseif ($count > 0) { // otherwise - add this product
            $this->products()->attach($id, ['quantity' => $count, 'size' => $size]);
        }
        // update the `updated_at` field of the `carts` table
        $this->touch();
    }

    // Removes the item with the identifier $id from the shopping cart
    public function remove($id) {
        // deleting an item from the cart (breaking the relationship)
        $this->products()->detach($id);
        // update the `updated_at` field of the `carts` table
        $this->touch();
    }
         
    // Returns the cart object; 
    // If not found - creates a new one
    public static function getCart() {
        $cart_id = request()->cookie('cart_id');
        if (!empty($cart_id)) {
            try {
                $cart = Cart::findOrFail($cart_id);
            } catch (ModelNotFoundException $e) {
                $cart = Cart::create();
            }
        } else {
            $cart = Cart::create();
        }
        Cookie::queue('cart_id', $cart->id, 525600);
        return $cart;
    }

    public static function getCount() {
        $cart_id = request()->cookie('cart_id');
        if (empty($cart_id)) {
            return 0;
        }
        return self::getCart()->products->count();
    }

    public function getAmount() {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->new_price * $product->pivot->quantity;
        }
        return $amount;
    }

}
