@extends('backend.layouts.app')
@section('title', 'Reviews')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Reviews</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">Add Review</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Reviewer</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->product->title }}</td>
                                    <td>{{ $review->reviewer_name }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fa fa-star text-warning"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </td>
                                    <td>{{ Str::limit($review->review_text, 50) }}</td>
                                    <td>
                                        @if($review->reviewer_image)
                                            <img src="{{ asset('storage/'.$review->reviewer_image) }}" alt="Reviewer" width="50">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" 
                                                   class="custom-control-input review-status" 
                                                   id="status_{{ $review->id }}"
                                                   data-id="{{ $review->id }}" 
                                                   {{ $review->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status_{{ $review->id }}">
                                                {{ $review->is_active ? 'Active' : 'Inactive' }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('.review-status').change(function() {
            const id = $(this).data('id');
            const isActive = $(this).prop('checked');
            
            $.ajax({
                url: `{{ route('admin.reviews.update', '') }}/${id}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_active: isActive
                },
                success: function(response) {
                    if(response.success) {
                        toastr.success('Review status updated successfully');
                    } else {
                        toastr.error('Error updating review status');
                    }
                },
                error: function() {
                    toastr.error('Error updating review status');
                }
            });
        });
    });
</script>
@endpush
