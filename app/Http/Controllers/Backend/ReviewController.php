<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\ReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('images')->latest()->get();
        return view('backend.pages.review.index', compact('reviews'));
    }


    public function create()
    {
        $products = Product::all();
        return view('backend.pages.review.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp,svg,gif|max:2048',
            'reviewer_name' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'review_text' => 'nullable|string'
        ]);

        $review = Review::create([
            'product_id' => $request->product_id ?: null,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'is_active' => true
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $review->images()->create([
                    'image_path' => $path,
                    'is_active' => true
                ]);
            }
        }

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully');
    }

    public function edit(Review $review)
    {
        $products = Product::all();
        return view('backend.pages.review.edit', compact('review', 'products'));
    }

    public function update(Request $request, Review $review)
    {
        if ($request->ajax()) {
            $review->update([
                'is_active' => $request->is_active
            ]);
            return response()->json(['success' => true]);
        }

        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:2048',
            'reviewer_name' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'review_text' => 'nullable|string',
            'is_active' => 'required|boolean'
        ]);

        $review->update([
            'product_id' => $request->product_id ?: null,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'is_active' => $request->is_active
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $review->images()->create([
                    'image_path' => $path,
                    'is_active' => true
                ]);
            }
        }

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully');
    }

    public function destroy(Review $review)
    {
        foreach ($review->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully');
    }

    /**
     * Delete a review image
     */
    public function deleteImage($id)
    {
        $image = ReviewImage::findOrFail($id);
        
        // Delete the file from storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // Delete the database record
        $image->delete();
        
        return response()->json(['success' => true]);
    }
}
