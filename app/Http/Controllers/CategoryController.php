<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()
            ->with(['productImages'])
            ->latest()
            ->paginate(12);
            
        return view('category.show', compact('category', 'products'));
    }
}
