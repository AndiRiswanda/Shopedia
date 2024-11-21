<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use App\Models\Category;
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
        $storeProducts = $store->storeProducts;
        $category = Category::all();
        return view('seller.dashboard', compact('store','storeProducts','category'));
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
            'store_desc' => 'required|string|max:255',
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Seller',
        ]);

        // Create user store
        $user->store()->create([  
            'user_id' => $user->id,  
            'store_name' => $request->store_name,  
            'store_desc' => $request->store_desc,  
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
