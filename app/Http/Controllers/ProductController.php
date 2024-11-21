<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\InventoryLog;
use App\Models\ProductImage;
use App\Models\StoreProduct;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::create($validated);


        $imagePath = null;
        if ($request->hasFile('image')) {

            $storage_path = storage_path('app/public/products');
            if (!file_exists($storage_path)) {
                mkdir($storage_path, 0755, true);
            }

            $file = $request->file('image');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($storage_path, $filename);

            $imagePath = 'storage/products/' . $filename;
        }

        InventoryLog::create([
            'product_id' => $product->product_id,
            'change_type' => 'Restock',
            'quantity_chance' => $product->stock,
            'chance_date' => now()
        ]);

        ProductImage::create([
            'product_id' => $product->product_id,
            'image_url' => $imagePath
        ]);

        StoreProduct::create([
            'store_id' => Auth::user()->store->store_id,
            'product_id' => $product->product_id
        ]);



        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) {

    }

    public function showSeller(Product $product)
    {
        return view('seller.showProduct', compact('product'));
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
            'image' => 'nullable|array|max:5', // Ensure it's an array and max 5 images
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Validate each image
        ]);
        $oldStock = $product->stock;

        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
        ]);

        // Handle image uploads if any
        if ($request->hasFile('image')) {
            // Delete existing images if needed
            foreach ($product->productImages as $image) {
                // Remove the 'storage/' part from the URL
                $imagePath = public_path(str_replace('storage/', 'storage/app/public/', $image->image_url));

                // Check if the file exists and delete it
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete the image record from the database
                $image->delete();
            }

            // Store new images
            $imagePaths = [];
            foreach ($request->file('image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/products'), $filename);
                $imagePaths[] = 'storage/products/' . $filename;
            }

            // Save the new image URLs to the database
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
                'chance_date' => now()
            ]);
        } elseif ($stockChange < 0) {
            InventoryLog::create([
                'product_id' => $product->product_id,
                'change_type' => 'Sold',
                'quantity_chance' => abs($stockChange),
                'chance_date' => now()
            ]);
        }
        if (Auth::user()->role == 'Seller') {
            return redirect()->route('product.show.seller', ['product' => $product->product_id])->with('success', 'Product updated successfully!');
        }elseif (Auth::user()->role == 'Admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');

        }
        return redirect()->route('product.show', ['product' => $product->product_id])->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Check if the product has an associated image
        $image = $product->productImages->first(); // Assuming you have a relationship named productImages

        if ($image && file_exists(public_path($image->image_url))) {
            // Delete the image from the storage
            unlink(public_path($image->image_url));
        }

        // Now delete the product
        $product->delete();

        // Redirect with success message
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
        }
        
        return redirect()->route('store.index')
            ->with('status', 'Product and associated image deleted successfully');
    }
}
