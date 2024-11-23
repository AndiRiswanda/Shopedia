<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Auth::user()->carts;
        return view('cart.show', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($cart->cartDetails->isEmpty()) {
            $existing = false;
        } else {
            $existing = $cart->cartDetails->where('product_id', $product->product_id)->first();
        }

        if ($existing) {
            $existing->increment('quantity');
        } else {
            $cart->cartDetails()->create([
                'product_id' => $product->product_id,
                'quantity' => 1,
                'cart_id' => $cart->cart_id,
            ]);
        }
        return back()->with('success', 'Product added to cart!');
    }

    public function incrementItem(CartDetail $cartDetail)
    {
        $cartDetail->increment('quantity');
        return back()->with('success', 'Quantity updated!');
    }

    public function decrementItem(CartDetail $cartDetail)
    {
        if ($cartDetail->quantity > 1) {
            $cartDetail->decrement('quantity');
        } else {
            $cartDetail->delete();
        }
        return back()->with('success', 'Quantity updated!');
    }

    public function removeItem(CartDetail $cartDetail)
    {
        $cartDetail->delete();
        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
