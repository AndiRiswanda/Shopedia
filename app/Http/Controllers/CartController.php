<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\InventoryLog;
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

    public function checkout()
    {
        $cart = Auth::user()->carts;
        $total = 0;

        // create order
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => 0,
        ]);

        
        foreach($cart->cartDetails as $item) {
            // Create order detail
            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);

            $total += ($item->quantity * $item->product->price);

            // Update
            $product = Product::find($item->product_id);
            $product->decrement('stock', $item->quantity);
            InventoryLog::create([
                'product_id' => $product->product_id,
                'change_type' => 'Sold',
                'quantity_chance' => $item->quantity,
            ]);

            // clean
            $item->delete();
        }

        $order->update(['total' => $total]);


        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }

    public function markAsShipped(Order $order)
    {
        $storeId = Auth::user()->store->store_id;

        $orderProducts = $order->orderDetail->pluck('product.store_id')->unique();

        if (!$orderProducts->contains($storeId)) {
            return back()->with('error', 'Unauthorized action.');
        }

        foreach ($order->orderDetail as $detail) {
            if ($detail->product->store_id == $storeId) {
                $detail->update(['status' => 'Shipped']);
            }
        }

        return back()->with('success', 'Order marked as shipped.');
    }

    
    public function markAsDelivered(Order $order,$storeId) 
    {

        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }
        
        $storeOrderDetails = $order->orderDetail->where('product.store_id', $storeId);
        if ($storeOrderDetails->contains('status', '!=', 'Shipped')) {
            return back()->with('error', 'Order must be shipped before marking as delivered.');
        }

        foreach ($storeOrderDetails as $detail) {
            $detail->update(['status' => 'Delivered']);
        }

        return back()->with('success', 'Order marked as delivered.');
    }

}
