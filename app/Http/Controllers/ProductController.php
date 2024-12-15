<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\InventoryLog;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function search(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');
        $minPrice = $request->input('price_min');
        $maxPrice = $request->input('price_max');
        $categoryId = $request->input('category');
        if (empty(trim($query))) {
            return redirect()->route('Home');
        }
        $products = Product::query()
            ->with(['category', 'productImages'])
            ->where('product_name', 'LIKE', "%{$query}%")
            // Apply category 
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            // Apply price 
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                return $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            // Apply sorting
            ->when($sort, function ($query) use ($sort) {
                return match ($sort) {
                    'price_asc' => $query->orderBy('price', 'asc'),
                    'price_desc' => $query->orderBy('price', 'desc'),
                    'newest' => $query->orderBy('created_at', 'desc'),
                    default => $query
                };
            })
            ->paginate(12);

        $categories = Category::all();

        return view('search.results', compact('products', 'categories', 'query'));
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
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:99999999',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,category_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', //10 MB
        ]);

        $validated['store_id'] = Auth::user()->store->store_id;

        $product = Product::create($validated);

        $imagePath = null;
        if ($request->hasFile('image')) {
            //Define the storage path
            $storage_path = storage_path('app/public/products');
            //Check if the directory exists; if not, create it
            if (!file_exists($storage_path)) {
                mkdir($storage_path, 0755, true);
            }
            //Get the uploaded file from the request
            $file = $request->file('image');
            // Step 4: Generate a unique filename based on the current timestamp and original file name
            $filename = time() . '_' . $file->getClientOriginalName();
            //Move the uploaded file to the defined directory
            $file->move($storage_path, $filename);
            //Store the path to the file in a variable
            $imagePath = 'storage/products/' . $filename;
        }

        InventoryLog::create([
            'product_id' => $product->product_id,
            'change_type' => 'Restock',
            'quantity_chance' => $product->stock,
        ]);

        ProductImage::create([
            'product_id' => $product->product_id,
            'image_url' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        $product->averageRating = $product->reviews->avg('rating');
        $reviews = $product->reviews()->latest()->paginate(5);
        return view('product.show', compact(['product', 'reviews']));
    }

    public function showSeller(Product $product)
    {

        $reviews = $product->reviews()->latest()->paginate(5);

        return view('seller.showProduct', compact('product', 'reviews'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:99999999',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,category_id',
            'image' => 'nullable|array|max:5', // Max 5 images
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', //10 MB
        ]);
        $oldStock = $product->stock;

        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
        ]);

        // Handle images
        if ($request->hasFile('image')) {
            // Delete old images
            foreach ($product->productImages as $image) {
                $imagePath = public_path(str_replace('storage/', 'storage/app/public/', $image->image_url));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            // Store new images
            $imagePaths = [];
            foreach ($request->file('image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/products'), $filename);
                $imagePaths[] = 'storage/products/' . $filename;
            }

            // Save new URLs
            foreach ($imagePaths as $path) {
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_url' => $path,
                ]);
            }
        }

        $stockChange = $validated['stock'] - $oldStock;

        if ($stockChange > 0) {
            InventoryLog::create([
                'product_id' => $product->product_id,
                'change_type' => 'Restock',
                'quantity_chance' => $stockChange,
            ]);
        } elseif ($stockChange < 0) {
            InventoryLog::create([
                'product_id' => $product->product_id,
                'change_type' => 'Sold',
                'quantity_chance' => abs($stockChange),
            ]);
        }
        if (Auth::user()->role == 'Seller') {
            return redirect()->route('product.show.seller', ['product' => $product->product_id])->with('success', 'Product updated successfully!');
        } elseif (Auth::user()->role == 'Admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
        }
        return redirect()->route('product.show', ['product' => $product->product_id])->with('success', 'Product updated successfully!');
    }

    public function showStore(Store $store)
    {
        return view('product.showStore', compact('store'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // check gambar product
        $image = $product->productImages->first();

        if ($image !== null && file_exists(public_path($image->image_url))) {
            // Delete the image from the storage
            unlink(public_path($image->image_url));
        }


        $product->delete();


        $redirectRoutes = [
            'Admin' => 'admin.dashboard',
            'Seller' => 'store.index',
        ];

        $role = Auth::user()->role;
        $route = $redirectRoutes[$role] ?? 'store.index';

        return redirect()->route($route)->with('success', 'Product deleted successfully!');
    }
}
