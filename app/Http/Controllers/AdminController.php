<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $products = Product::with('Category')->get();
        $categories = Category::all();
        $stores = Store::all();
        $revenue = Product::sum('price'); // calculation for revenue
        $newOrders = 567; //value for new orders

        return view('admin.dashboard', compact('users', 'products', 'categories', 'stores', 'revenue', 'newOrders'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);

        // Update the user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = 'Buyer';

        // Update the password if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the user data
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if (Auth::user()->role === 'Admin') {
            if ($user->role === 'Admin') { 
                return redirect()->route('admin.dashboard')->with('error', 'You cannot delete an admin user.');
            }
            $user->delete();
        }


        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
