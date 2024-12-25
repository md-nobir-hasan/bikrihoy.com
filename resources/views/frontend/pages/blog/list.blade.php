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
        <h1 class="text-center"> Blogs</h1>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">

              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($blogs as $blog)
                <div class="col">
                  <div class="card shadow-sm">
                    @if($blog->image)
                      <img src="{{ asset('storage/'.$blog->image) }}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="{{ $blog->title }}">
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
                @empty
                <div class="col-12 text-center">
                  <h3>No blogs found</h3>
                </div>
                @endforelse
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
