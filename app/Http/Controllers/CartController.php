<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    private $cart;

    public function __construct() {
        $this->cart = Cart::getCart();
    }

    
     // Shows the shopping cart
    public function cart() {
        $products = $this->cart->products;
        return view('cart', compact('products'));
    }

    // Checkout form
    public function checkout() {
        return view('checkout');
    }

    // Add product with ID  $id to cart
    public function cartAdd(Request $request, $id) {
        $quantity = $request->input('quantity') ?? 1;
        $this->cart->increase($id, $quantity);
        // redirect back to the page where the "Add to cart" button was clicked
        return back();
    }

    // Increases the number of items $id in the cart by one
    public function cartPlus($id) {
        $this->cart->increase($id);
        // redirect back to the cart page
        return redirect()->route('cart');
    }

    // Decreases the number of items $id in the cart by one
    public function cartMinus($id) {
        $this->cart->decrease($id);
        // redirect back to the cart page
        return redirect()->route('cart');
    }  

    // Removes item with $id from cart
    public function cartRemove($id) {
        $this->cart->remove($id);
        // redirect back to the cart page
        return redirect()->route('cart');
    }

    // Clears the contents of the shopping cart completely
    public function cartClear() {
        $this->cart->delete();
        // redirect back to the cart page
        return redirect()->route('cart');
    }

}
