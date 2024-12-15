<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Auth::user()->store;
        $products = $store->products()->orderBy('created_at', 'desc')->get();
        $orders = collect();

        foreach ($products as $product) {
            foreach ($product->orderDetails as $orderDetail) {
                $orders->push($orderDetail->order);
            }
        }

        // Average Order Value
        $averageOrderValue = $orders->avg('total') ?? 0;

        // Top Selling Category
        $topCategory = Category::select('categories.category_id', 'categories.category_name')
        ->join('products', 'categories.category_id', '=', 'products.category_id')
        ->join('order_details', 'products.product_id', '=', 'order_details.product_id')
        ->where('products.store_id', $store->store_id)
        ->groupBy('categories.category_id', 'categories.category_name')
        ->orderByRaw('COUNT(*) DESC')
        ->first();

        // Average Rating
        $averageRating = Review::whereHas('products', function ($query) use ($store) {
            $query->where('store_id', $store->store_id);
        })->avg('rating') ?? 0;

        // Total Stock Value
        $totalStockValue = $products->sum(function ($product) {
            return $product->price * $product->stock;
        });
        
        $category = Category::all();
        return view('seller.dashboard', compact(
            'store',
            'products',
            'orders',
            'category',
            'averageOrderValue',
            'topCategory',
            'averageRating',
            'totalStockValue'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.seller-register');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'store_name' => 'required|string|max:255',
            'store_desc' => 'required|string|max:1000',
            'store_profile_pic' => 'required|image|max:10240', // 10MB 
            'store_banner' => 'nullable|image|max:10240', // Optional, 
        ]);

        $formattedNum = str_pad(rand(1, 6), 2, '0', STR_PAD_LEFT);
        $profileUrl = "images/DefaultProfilePic/Shopedia Profile-{$formattedNum}-01.png";

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Seller',
            'profile_url' => $profileUrl
        ]);

        // store profile picture
        $profilePicPath = $request->file('store_profile_pic')->store('store_profile_pics', 'public');

        // store banner
        $bannerPath = $request->hasFile('store_banner')
            ? $request->file('store_banner')->store('store_banners', 'public')
            : 'images/BackroundForBanner.jpg';


        $user->store()->create([
            'user_id' => $user->id,
            'store_name' => $request->store_name,
            'store_desc' => $request->store_desc,
            'profile_url' => $profilePicPath,
            'banner_url' => $bannerPath,
        ]);

        Cart::create([
            'user_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->route('store.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_desc' => 'required|string|max:1000',
            'catch' => 'nullable|string',
            'profile_url' => 'nullable|image|max:10240', // 10MB max 
            'banner_url' => 'nullable|image|max:10240', // 10MB max 
        ]);

        $store = Auth::user()->store;

        if ($store->user_id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        // Update 
        $store->update([
            'store_name' => $validated['store_name'],
            'store_desc' => $validated['store_desc'],
            'catch' => $validated['catch'],
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_url')) {
            // Delete old profile picture
            if ($store->profile_url) {
                Storage::disk('public')->delete($store->profile_url);
            }
            // Store the new profile picture
            $profilePicPath = $request->file('profile_url')->store('store_profile_pics', 'public');
            $store->profile_url = $profilePicPath;
        }

        // Handle banner upload
        if ($request->hasFile('banner_url')) {
            // Delete old banner
            if ($store->banner_url && $store->banner_url !== 'images/BackroundForBanner.jpg') {
                Storage::disk('public')->delete($store->banner_url);
            }
            // Store the new banner
            $bannerPath = $request->file('banner_url')->store('store_banners', 'public');
            $store->banner_url = $bannerPath;
        }

        $store->save();

        return redirect()->back()->with('success', 'Store details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
