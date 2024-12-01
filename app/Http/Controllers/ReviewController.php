<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
     * Store a newly created resource in storage with an image.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment'=> 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5048'
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $storage_path = storage_path('app/public/reviewsPic');
            if (!file_exists($storage_path)) {
                mkdir($storage_path, 0755, true);
            }
            
            // Move file to storage
            $file->move($storage_path, $filename);
            $imagePath = 'storage/reviewsPic/' . $filename;
        }
        
        Review::create([
            'user_id' => Auth::user()->id,
            'product_id' => $validated['product_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'review_pic' => $imagePath
        ]);
    
        return redirect()->back()->with('success', 'Review Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
