<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::inRandomOrder()->limit(6)->get();
        return view('Home', compact(['products', 'categories']));
    }
    public function about()
    {
        $products = Product::all();
        $users = User::all();
        return view('about', compact(['products', 'users']));
    }
}
