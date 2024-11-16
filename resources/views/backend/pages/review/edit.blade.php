@extends('backend.layouts.app')

@section('content')
<div class="">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Review</h1>
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
                            <form action="{{ route('admin.reviews.update', $review) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="product_id">Product (Optional - Leave empty for global review)</label>

                                    <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                        <option value="">Global Review (Show on all products)</option>

                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $review->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="images">Add More Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('images.*') is-invalid @enderror"
                                               id="images" name="images[]" multiple accept="image/*">
                                        <label class="custom-file-label" for="images">Choose images</label>
                                    </div>
                                    @error('images.*')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if($review->images->count() > 0)
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
                                    <label for="reviewer_name">Reviewer Name</label>
                                    <input type="text"
                                           name="reviewer_name"
                                           id="reviewer_name"
                                           class="form-control @error('reviewer_name') is-invalid @enderror"
                                           value="{{ $review->reviewer_name }}">
                                    @error('reviewer_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror">
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
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
                                              rows="4">{{ $review->review_text }}</textarea>
                                    @error('review_text')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" {{ $review->is_active ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$review->is_active ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Review</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('page_css')
    <style>
        .review-images {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        .review-image-item {
            position: relative;
            width: 150px;
        }
        .review-image-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .delete-image {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 5px 8px;
            border-radius: 50%;
        }
    </style>
@endpush

@push('page_scripts')
    <script>
        $(document).ready(function() {
            // Image preview for new uploads
            $('#images').on('change', function() {
                const preview = $('#image-preview');
                preview.empty();

                if (this.files) {
                    [...this.files].forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.append(`
                                <div class="position-relative" style="width: 150px; margin: 10px;">
                                    <img src="${e.target.result}" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            `);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });

            // Delete existing images
            $('.delete-image').on('click', function() {
                const button = $(this);
                const imageId = button.data('id');
                console.log('delete images');
                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: `{{ url('admin/reviews/image') }}/${imageId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                button.closest('.review-image-item').remove();
                            }
                        },
                        error: function(xhr) {
                            alert('Error deleting image. Please try again.');
                        }
                    });
                }
            });

            // Update file input label with selected files
            $('.custom-file-input').on('change', function() {
                let fileName = Array.from(this.files).map(file => file.name).join(', ');
                $(this).next('.custom-file-label').html(fileName || 'Choose images');
            });
        });
    </script>
@endpush
