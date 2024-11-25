<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'Seller') {
            $storeId = Auth::user()->store->store_id;
            $orders = Order::whereHas('orderDetail.product', function($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })->paginate(10);
        } else {
            $orders = Auth::user()->orders->paginate(10);
        }
        
        return view('orders.index', compact('orders'));
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
    public function showSeller(order $order)
    {
        if ($order->user_id !== Auth::id() && Auth::user()->role == 'Seller') {
            abort(403);
        }
        return view('order.showSeller', compact('order'));
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
