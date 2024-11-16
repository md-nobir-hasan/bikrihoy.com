@extends('backend.layouts.app')

@section('content')
<div class="">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($review) ? 'Edit Review' : 'Add New Review' }}</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary float-right">Back to Reviews</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($review) ? route('admin.reviews.update', $review) : route('admin.reviews.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @if(isset($review))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="product_id">Product (Optional - Leave empty for global review)</label>
                                    <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                        <option value="">Global Review (Show on all products)</option>
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
                                    <label for="images">Images <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('images.*') is-invalid @enderror"
                                               id="images" name="images[]" multiple accept="image/*" required>
                                        <label class="custom-file-label" for="images">Choose images</label>
                                    </div>
                                    @error('images.*')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if(isset($review) && $review->images->count() > 0)
                                <div class="form-group">
                                    <label>Current Images</label>
                                    <div class="review-images">
                                        @foreach($review->images as $image)
                                        <div class="review-image-item">
                                            <img src="{{ asset('storage/'.$image->image_path) }}" alt="Review Image" class="img-thumbnail">
                                            <button type="button" class="btn btn-danger btn-sm delete-image" data-id="{{ $image->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <div id="image-preview" class="d-flex flex-wrap gap-2"></div>
                                </div>

                                <div class="form-group">
                                    <label for="reviewer_name">Reviewer Name </label>
                                    <input type="text"
                                           name="reviewer_name"
                                           id="reviewer_name"
                                           class="form-control @error('reviewer_name') is-invalid @enderror"
                                           value="{{ isset($review) ? $review->reviewer_name : old('reviewer_name') }}"
                                           >
                                    @error('reviewer_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror">
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
                                    <label for="review_text">Review Text</label>
                                    <textarea name="review_text"
                                              id="review_text"
                                              class="form-control @error('review_text') is-invalid @enderror"
                                              rows="4"
                                              >{{ isset($review) ? $review->review_text : old('review_text') }}</textarea>
                                    @error('review_text')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" {{ (isset($review) && $review->is_active) || old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ (isset($review) && !$review->is_active) || old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ isset($review) ? 'Update' : 'Create' }} Review</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.review-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.review-image-item {
    position: relative;
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

.review-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
}

.review-image-item .btn-danger {
    position: absolute;
    top: 5px;
    right: 5px;
    padding: 2px 6px;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.2s;
}

.review-image-item:hover .btn-danger {
    opacity: 1;
}

#image-preview img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin: 5px;
    border-radius: 4px;
}
</style>


@endsection

@push('page_scripts')
<script>
    $(document).ready(function() {
        // Image preview
        $('#images').change(function() {
            const preview = $('#image-preview');
            preview.empty();

            if (this.files) {
                [...this.files].forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.append(`<img src="${e.target.result}" class="img-thumbnail">`);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });

        // Custom file input
        $('.custom-file-input').on('change', function() {
            let fileName = Array.from(this.files).map(file => file.name).join(', ');
            $(this).next('.custom-file-label').html(fileName || 'Choose images');
        });

        // Delete image
        $('.delete-image').click(function() {
            const button = $(this);
            const id = button.data('id');
            if(confirm('Are you sure you want to delete this image?')) {
                $.ajax({
                    url: `/admin/reviews/image/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success) {
                            button.closest('.review-image-item').fadeOut(300, function() {
                                $(this).remove();
                                if($('.review-image-item').length === 0) {
                                    $('.review-images').html('<span class="text-muted">No images</span>');
                                }
                            });
                            toastr.success('Image deleted successfully');
                        }
                    },
                    error: function() {
                        toastr.error('Failed to delete image');
                    }
                });
            }
        });
    });
</script>
@endpush
