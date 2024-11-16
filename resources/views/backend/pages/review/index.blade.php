@extends('backend.layouts.app')

@section('content')
<div class="">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reviews</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Add New Review
                    </a>
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
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Images</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reviews as $review)
                                            <tr>
                                                <td>{{ $review->id }}</td>
                                                <td>
                                                    @if($review->product)
                                                        <a target='_blank' href="{{ route('product_details', $review->product->slug) }}">
                                                        {{ $review->product->title }}
                                                        </a>
                                                    @else
                                                        <span class="badge badge-info">Global Review</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="review-images-container">
                                                        @if($review->images->count() > 0)
                                                            <div class="review-images">
                                                                @foreach($review->images as $image)
                                                                    <div class="review-image-item">
                                                                        <img src="{{ asset('storage/'.$image->image_path) }}"
                                                                             alt="Review Image"
                                                                             class="img-thumbnail review-thumbnail"
                                                                             data-toggle="modal"
                                                                             data-target="#imageModal"
                                                                             data-image="{{ asset('storage/'.$image->image_path) }}">
                                                                        <button type="button"
                                                                                class="btn btn-danger btn-sm delete-image"
                                                                                data-id="{{ $image->id }}">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="text-muted">No images</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                               class="custom-control-input status-toggle"
                                                               id="status_{{ $review->id }}"
                                                               data-id="{{ $review->id }}"
                                                               {{ $review->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="status_{{ $review->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $review->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.reviews.edit', $review) }}"
                                                           class="btn btn-sm btn-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.reviews.destroy', $review) }}"
                                                              method="POST"
                                                              class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-danger delete-review"
                                                                    data-id="{{ $review->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No reviews found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="" class="img-fluid w-100" id="modalImage">
            </div>
        </div>
    </div>
</div>

<style>
    .review-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .review-image-item {
        position: relative;
        width: 60px;
        height: 60px;
    }

    .review-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .review-thumbnail:hover {
        transform: scale(1.05);
    }

    .review-image-item .btn-danger {
        position: absolute;
        top: -5px;
        right: -5px;
        padding: 2px 6px;
        font-size: 10px;
        opacity: 0;
        transition: opacity 0.2s;
        border-radius: 50%;
    }

    .review-image-item:hover .btn-danger {
        opacity: 1;
    }

    .review-images-container {
        max-width: 200px;
    }

    #modalImage {
        max-height: 80vh;
        object-fit: contain;
    }
</style>


@endsection
@push('page_scripts')
    <script>
        $(document).ready(function() {
            // Image modal
            $('#imageModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const imageUrl = button.data('image');
                const modal = $(this);
                modal.find('#modalImage').attr('src', imageUrl);
            });

            // Status toggle
            $('.status-toggle').change(function() {
                const id = $(this).data('id');
                const isActive = $(this).prop('checked');

                $.ajax({
                    url: `/admin/reviews/${id}`,
                    type: 'PUT',
                    data: {
                        is_active: isActive,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success) {
                            toastr.success('Status updated successfully');
                        }
                    },
                    error: function() {
                        toastr.error('Failed to update status');
                        // Revert the toggle if the request failed
                        $(this).prop('checked', !isActive);
                    }
                });
            });

            // Delete image
            $('.delete-image').click(function(e) {
                e.preventDefault();
                e.stopPropagation();

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

            // Delete review confirmation
            $('.delete-review').click(function(e) {
                if(!confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
