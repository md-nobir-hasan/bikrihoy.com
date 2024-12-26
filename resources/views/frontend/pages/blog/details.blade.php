@extends('frontend.layouts.app')

@push('css')
<style>
    .blog-image {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
    .related-blog-image {
        height: 120px;
        object-fit: cover;
    }
    .blog-image {
        max-height: 300px;
        object-fit: cover;
    }
</style>
@endpush

@section('page_conent')
<div class="container py-5">
    <div class="row">

        <!-- Main Blog Content -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}" class="blog-image" alt="{{ $blog->title }}">
                @else
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>{{ $blog->title }}</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        <text x="50%" y="50%" fill="#eceeef" dy=".3em">No Image</text>
                    </svg>
                @endif

                <div class="card-body">
                    <h1 class="card-title">{{ $blog->title }}</h1>
                    <small class="text-body-secondary mb-3 d-block">{{ $blog->created_at->diffForHumans() }}</small>
                    <p class="card-text">{!! $blog->content !!}</p>

                    <div class="mt-4">
                        <a href="{{ route('blog.list') }}" class="btn btn-outline-secondary">Back to Blogs</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Blogs Sidebar -->
        <div class="col-md-4">

            <h3 class="mb-4">Related Blogs</h3>
            @forelse($relatedBlogs->take(4) as $relatedBlog)
                <div class="card shadow-sm mb-4">
                    @if($relatedBlog->image)
                        <img src="{{ asset($relatedBlog->image) }}" class="bd-placeholder-img card-img-top related-blog-image" alt="{{ $relatedBlog->title }}">
                    @else
                        <svg class="bd-placeholder-img card-img-top related-blog-image" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">No Image</text>
                        </svg>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::words($relatedBlog->title, 15) }}</h5>
                        <p class="card-text">{!! Str::words($relatedBlog->content, 40) !!}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('blog.details', $relatedBlog->slug) }}" class="btn btn-sm btn-outline-secondary">Read More</a>
                            {{-- <small class="text-body-secondary">{{ $relatedBlog->created_at->diffForHumans() }}</small> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">No related blogs found</h5>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
