<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('product')->latest()->get();
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
            'product_id' => 'required|exists:products,id',
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'reviewer_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('reviewer_image')) {
            $image = $request->file('reviewer_image');
            $path = $image->store('reviews', 'public');
            $data['reviewer_image'] = $path;
        }

        Review::create($data);

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
            'product_id' => 'required|exists:products,id',
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'reviewer_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('reviewer_image')) {
            // Delete old image
            if ($review->reviewer_image) {
                Storage::disk('public')->delete($review->reviewer_image);
            }

            $image = $request->file('reviewer_image');
            $path = $image->store('reviews', 'public');
            $data['reviewer_image'] = $path;
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully');
    }

    public function destroy(Review $review)
    {
        if ($review->reviewer_image) {
            Storage::disk('public')->delete($review->reviewer_image);
        }
        
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully');
    }
}
