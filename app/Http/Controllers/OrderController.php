<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Orderdetail;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::user()->id);
        
        if ($request->filter && $request->filter !== 'All') {
            $query->whereHas('orderDetail', function($q) use ($request) {
                $q->where('status', $request->filter);
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        
        return view('order.showBuyer', compact('orders'));
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
    public function show(order $order)
    {
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'Seller') {
            abort(403);
        }
        return view('order.show', compact('order'));
    }
    
    public function showSeller(Store $store)

    {
        if ($store->user_id !== Auth::id() && Auth::user()->role !== 'Seller') {
            abort(403);
        }

        $store = Auth::user()->store;
        $products = $store->products;
        $productIds = $products->pluck('product_id');
        $orders = collect();
        
        $newOrders = Orderdetail::whereIn('product_id', $productIds)->count();
        $processingOrders = Orderdetail::whereIn('product_id', $productIds)->where('status', 'Processing')->count();
        $shippedOrders = Orderdetail::whereIn('product_id', $productIds)->where('status', 'Shipped')->count();
        $completedOrders = Orderdetail::whereIn('product_id', $productIds)->where('status', 'Completed')->count();
        
        $orderDetails = Orderdetail::whereIn('product_id', $productIds)->get();
        foreach ($orderDetails as $orderDetail) {
            $orders->push($orderDetail->order);
        }
        $orders = $orders->unique();

        return view('order.showSeller', compact('orders', 'newOrders', 'processingOrders', 'shippedOrders', 'completedOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
