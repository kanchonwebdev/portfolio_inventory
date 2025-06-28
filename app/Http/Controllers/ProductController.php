<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ProductController extends Controller
{
    public function all()
    {
        $collection = Shop::paginate(8);

        return view('frontend.shop', compact('collection'));
    }

    public function index()
    {
        $collection = Shop::paginate(8);

        return view('frontend.index', compact('collection'));
    }

    public function show($id)
    {
        $product = Shop::findOrFail($id);

        return view('frontend.details', compact('product'));
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Shop::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        if ($request->ajax()) {
            return response()->json([
                'success' => 'Product added to cart successfully!',
                'cartCount' => count($cart),
                'cart' => $cart
            ]);
        } else {
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => 'Product removed from cart successfully!',
                'cartCount' => count($cart),
                'cart' => $cart
            ]);
        } else {
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            if ($quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Cart updated successfully!',
                'cartCount' => count($cart),
                'cart' => $cart
            ]);
        } else {
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.cart', compact('cart', 'total'));
    }
}
