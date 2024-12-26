@extends('frontend.layouts.app')

@push('custom-css')
<style>

</style>
@endpush

@push('custom-js')
<script>
    $(document).ready(function () {

    });

</script>
@endpush

@section('page_conent')
<div class="">
    <div class="p-top-15">
        @if($blogs->count() > 0)
        <h1 class="text-center"> Blogs</h1>
        @endif
        <div class="album py-5 bg-body-tertiary">
            <div class="container">


                @forelse($blogs as $blog)
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                        <div class="card shadow-sm">
                            @if($blog->image)
                            <img src="{{ asset($blog->image) }}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="{{ $blog->title }}">
                            @else
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>{{ $blog->title }}</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">No Image</text>
                            </svg>
                            @endif
                            <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <a href="{{ route('blog.details', $blog->slug) }}" class="btn btn-sm btn-outline-secondary">Read More</a>
                                </div>
                                <small class="text-body-secondary">{{ $blog->created_at->diffForHumans() }}</small>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                        <h3 class="text-muted">No Blog Posts Yet</h3>
                        <p class="text-secondary">Check back later for interesting articles and updates!</p>
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left mr-2"></i> Return Home
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse

            </div>
          </div>
    </div>
</div>
@endsection
