<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {

        
        $userGrowth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        
        $revenueTrends = Order::selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('revenue', 'month')
            ->toArray();

        // Format data for charts
        $months = array_map(function ($m) {
            return date('F', mktime(0, 0, 0, $m, 1));
        }, range(1, 12));

        $userData = array_map(function ($month) use ($userGrowth) {
            return $userGrowth[date('n', strtotime($month))] ?? 0;
        }, $months);

        $revenueData = array_map(function ($month) use ($revenueTrends) {
            return $revenueTrends[date('n', strtotime($month))] ?? 0;
        }, $months);
        $users = User::all();
        $products = Product::with('Category')->get();
        $categories = Category::all();
        $stores = Store::all();
        $revenue = Order::sum('total'); // calculation for revenue
        $newOrders = Order::all()->count(); //value for new orders

        return view('admin.dashboard', compact(
            'users',
            'months',
            'userGrowth',
            'revenueTrends',
            'products',
            'categories',
            'stores',
            'revenue',
            'newOrders',
            'userData',
            'revenueData'

        ));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);

        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = 'Buyer';

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

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
