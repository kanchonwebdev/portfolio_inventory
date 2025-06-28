<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('product.checkout')->with('error', 'Your cart is empty!');
        }

        $checkout = Checkout::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'products' => json_encode($cart),
        ]);

        $order = Order::create([
            'checkout_id' => $checkout->id,
            'user_id' => $request->id,
            'status' => 'pending',
            'total_amount' => $request->total_amount,
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'unpaid',
        ]);


        foreach ($cart as $item) {
            $product = Shop::find($item['id']);
            if ($product) {
                $product->decrement('quantity', $item['quantity']);
            }
        }

        session()->forget('cart');
        return redirect()->route('shop.checkout')->with('success', 'Checkout successful!');
    }
}
