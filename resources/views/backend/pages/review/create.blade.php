@extends('backend.layouts.app')
@section('title', isset($review) ? 'Edit Review' : 'Add Review')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ isset($review) ? 'Edit Review' : 'Add Review' }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($review) ? route('admin.reviews.update', $review->id) : route('admin.reviews.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($review))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="product_id">Product <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                        {{ (isset($review) && $review->product_id == $product->id) || old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reviewer_name">Reviewer Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="reviewer_name" 
                                   id="reviewer_name" 
                                   class="form-control @error('reviewer_name') is-invalid @enderror"
                                   value="{{ isset($review) ? $review->reviewer_name : old('reviewer_name') }}" 
                                   required>
                            @error('reviewer_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating <span class="text-danger">*</span></label>
                            <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" 
                                        {{ (isset($review) && $review->rating == $i) || old('rating') == $i ? 'selected' : '' }}>
                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="review_text">Review Text <span class="text-danger">*</span></label>
                            <textarea name="review_text" 
                                      id="review_text" 
                                      class="form-control @error('review_text') is-invalid @enderror" 
                                      rows="4" 
                                      required>{{ isset($review) ? $review->review_text : old('review_text') }}</textarea>
                            @error('review_text')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reviewer_image">Reviewer Image</label>
                            <input type="file" 
                                   name="reviewer_image" 
                                   id="reviewer_image" 
                                   class="form-control @error('reviewer_image') is-invalid @enderror">
                            @error('reviewer_image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            @if(isset($review) && $review->reviewer_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$review->reviewer_image) }}" alt="Current Image" width="100">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1" {{ (isset($review) && $review->is_active) || old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ (isset($review) && !$review->is_active) || old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($review) ? 'Update' : 'Create' }} Review
                        </button>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
