<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class CartController extends Controller
{
    private $cart;

    public function __construct() {
        $this->cart = Cart::getCart();
    }

     // Shows the shopping cart
    public function cart() {
        $products = $this->cart->products;
        return view('cart.cart', compact('products'));
    }

    // Checkout form
    public function cartCheckout() {
        $products = $this->cart->products;

        return view('cart.checkout', compact('products'));
    }

    // Add product with ID  $id to cart
    public function cartAdd(Request $request, $id) {
        $quantity = $request->input('quantity') ?? 1;
        $size = $request->input('size');
        $user_id = $request->input('user_id');
        $this->cart->increase($id, $size, $user_id, $quantity);
        //echo "<pre>"; print_r($size); die;
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

    // Saving the order in the database
    public function saveOrder(Request $request) {
        // Сhecking the data of the form
        $this->validate($request, [
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'zipcode' => 'required|max:255',
        ]);

        // Validation passed, save the order
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
            $request->all() + ['amount' => $this->cart->getAmount(), 'user_id' => $user_id]
        );

        foreach ($this->cart->products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'title' => $product->title,
                'size' => $product->pivot->size,
                'price' => $product->new_price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->new_price * $product->pivot->quantity,
            ]);
        }

        // Deleting products from cart
        $this->cart->delete();

        return redirect()
            ->route('cart.success')
            ->with('order_id', $order->id);
    }

    // Successful checkout message
    public function cartSuccess(Request $request) {
        if ($request->session()->exists('order_id')) {
            // Here the buyer enters immediately after successful ordering
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('cart.success', compact('order'));
        } else {
            // If the buyer came here by accident, not after placing the order, then
            // he has nothing to do here - redirect to the cart page
            return redirect()->route('cart');
        }
    }
    
}