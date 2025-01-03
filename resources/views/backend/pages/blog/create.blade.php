@extends('backend.layouts.app')

@section('title', 'Blog Management')

@push('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/summernote/summernote.min.css') }}">
@endpush

@push('page_css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                            <h1>Add Blog</h1>
                        </span>
                        <span class="float-right">
                            <a href="{{ route('blog.index') }}" class="btn btn-info">Back</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                                        <input id="title" type="text" name="title" placeholder="Enter title"
                                            value="{{ old('title') }}" class="form-control" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Sub title --}}
                                    <div class="form-group">
                                        <label for="subtitle" class="col-form-label">Subtitle</label>
                                        <input id="subtitle" type="text" name="subtitle" placeholder="Enter subtitle"
                                            value="{{ old('subtitle') }}" class="form-control">
                                        @error('subtitle')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- content --}}
                                    <div class="form-group">
                                        <label for="content" class="col-form-label">Content <span class="text-danger">*</span></label>
                                        <textarea id="content" type="text" name="content" placeholder="Enter content"
                                            class="form-control" required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                     {{-- Image --}}
                                     <div class="form-group">
                                        <label for="image" class="col-form-label">Blog Image <span class="text-danger">*</span></label>
                                        <input id="image" type="file" name="image" placeholder="Enter image" required
                                            value="{{ old('image') }}" class="form-control" onchange="previewBlogImage(this)">
                                        <img id="blog-image-preview" src="#" alt="Blog image preview" style="display: none; max-width: 200px; margin-top: 10px;">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Author --}}
                                    <div class="form-group">
                                        <label for="author" class="col-form-label">Author </label>
                                        <input id="author" type="text" name="author" placeholder="Enter author"
                                            value="{{ old('author') }}" class="form-control">
                                        @error('author')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Author Image --}}
                                    <div class="form-group">
                                        <label for="author_image" class="col-form-label">Author Image </label>
                                        <input id="author_image" type="file" name="author_image" placeholder="Enter author image"
                                            value="{{ old('author_image') }}" class="form-control" onchange="previewAuthorImage(this)">
                                        <img id="author-image-preview" src="#" alt="Author image preview" style="display: none; max-width: 200px; margin-top: 10px;">
                                        @error('author_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    {{-- Status --}}
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Status</label>
                                        <select name="status" class="form-control" >
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('third_party_scripts')
    <script src="{{ asset('assets/backend/library/summernote/summernote.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
        function previewBlogImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blog-image-preview')
                        .attr('src', e.target.result)
                        .css('display', 'block');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewAuthorImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#author-image-preview')
                        .attr('src', e.target.result)
                        .css('display', 'block');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
