@extends('backend.layouts.app')

@section('title', 'Page Section')

@push('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/summernote/summernote.min.css') }}">
@endpush

@push('page_css')
    <style>
        .w20px{
            width: 20px;
        }

        .bg80808047{
            background: #80808047;
        }

        .image-preview {
            max-width: 200px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .section-controls {
            position: relative;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .section-header {
            background: #f8f9fa;
            margin: -20px -20px 20px -20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .remove-section {
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 10;
        }

        #add-section-btn {
            margin: 20px 0;
        }

        .btn-floating {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .section-number {
            position: absolute;
            left: -10px;
            top: -10px;
            background: #007bff;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .invalid-feedback {
            display: block;
        }

        .preview-container {
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                            <h4>Landing page</h4>
                        </span>
                        <span class="float-right">
                            <a href="{{ route('product.index') }}" class="btn btn-info">Back</a>
                        </span>
                    </div>
                    <div class="card-body bg80808047">
                        @include('backend.partial.flush-message')

                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <form method="post" id="landing-page-form" action="{{ route('lp.update', $product_id ?? null) }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('POST')

                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{$error}}</p>
                                        @endforeach
                                    </div>

                                    <div id="sections-container">
                                        @if (old('sections'))
                                            @foreach (old('sections') as $datum)
                                                <input type="hidden" name="sections[{{$loop->index}}][id]" value="{{$datum['id'] ?? null }}">
                                                <section class="card card-body mt-3 section-controls">
                                                    <div class="section-number">{{ $loop->iteration }}</div>
                                                    <div class="section-header">
                                                        <h5 class="section-title">Section {{ $loop->iteration }}</h5>
                                                        <button type="button" class="btn btn-danger btn-sm remove-section">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>

                                                    {{-- Is with previous section --}}
                                                    <div class="form-group d-flex justify-content-center align-items-center">
                                                        <input id="is_with_previous_{{$loop->index}}" type="checkbox" value="1"
                                                            name="sections[{{$loop->index}}][is_with_previous]"
                                                            @if($datum['is_with_previous'] ?? null) checked @endif
                                                            class="form-control w20px mr-2">
                                                        <label for="is_with_previous_{{$loop->index}}" class="col-form-label">
                                                            Is with previous section?
                                                        </label>
                                                    </div>

                                                    {{-- Image --}}
                                                    <div class="form-group">
                                                        <label for="image_{{$loop->index}}" class="col-form-label">
                                                            Image
                                                        </label>
                                                        <input id="image_{{$loop->index}}" type="file"
                                                            name="sections[{{$loop->index}}][image]"
                                                            class="form-control image-input"
                                                            accept="image/*"
                                                            value="{{$datum['image'] ?? null}}"
                                                            >
                                                        <div class="image-preview-container">
                                                            @if($datum['image'] ?? null)
                                                                <img src="/storage/{{ $datum['image'] ?? null }}"
                                                                    class="image-preview"
                                                                    alt="Section Image">
                                                            @endif
                                                        </div>
                                                        @error("sections.{$loop->index}.image")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Video --}}
                                                    <div class="form-group">
                                                        <label for="video_link_{{$loop->index}}" class="col-form-label">
                                                            Video (Embedded Code)
                                                        </label>
                                                        <textarea class="form-control"
                                                                id="video_link_{{$loop->index}}"
                                                                name="sections[{{$loop->index}}][video_link]">{!! $datum['video_link'] ?? null !!}</textarea>
                                                        @error("sections.{$loop->index}.video_link")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Title --}}
                                                    <div class="form-group">
                                                        <label for="title_{{$loop->index}}" class="col-form-label">
                                                            Title
                                                        </label>


                                                        <textarea class="form-control csummernote"
                                                        id="title_{{$loop->index}}"
                                                        name="sections[{{$loop->index}}][title]">{!! $datum['title'] ?? null !!}</textarea>

                                                        @error("sections.{$loop->index}.title")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Sub Title --}}
                                                    <div class="form-group">
                                                        <label for="sub_title_{{$loop->index}}" class="col-form-label">
                                                            Sub Title
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                                id="sub_title_{{$loop->index}}"
                                                                name="sections[{{$loop->index}}][sub_title]">{!! $datum['sub_title'] ?? null !!}</textarea>

                                                        @error("sections.{$loop->index}.sub_title")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Description --}}
                                                    <div class="form-group">
                                                        <label for="description_{{$loop->index}}" class="col-form-label ">
                                                            Description
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                                id="description_{{$loop->index}}"
                                                                name="sections[{{$loop->index}}][description]">{!! $datum['description'] ?? null !!}</textarea>
                                                        @error("sections.{$loop->index}.description")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Button --}}
                                                    <div class="form-group">
                                                        <label for="button_{{$loop->index}}" class="col-form-label">
                                                            Button Text
                                                        </label>
                                                        <input id="button_{{$loop->index}}" type="text"
                                                            name="sections[{{$loop->index}}][button]"
                                                            value="{{$datum['button'] ?? null}}"
                                                            placeholder="Enter button text"
                                                            class="form-control">
                                                        @error("sections.{$loop->index}.button")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </section>
                                            @endforeach
                                        @else
                                            @forelse ($data as $datum)
                                                <input type="hidden" name="sections[{{$loop->index}}][id]" value="{{$datum->id}}">
                                                <section class="card card-body mt-3 section-controls">
                                                    <div class="section-number">{{ $loop->iteration }}</div>
                                                    <div class="section-header">
                                                        <h5 class="section-title">Section {{ $loop->iteration }}</h5>
                                                        <button type="button" class="btn btn-danger btn-sm remove-section">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>

                                                    {{-- Is with previous section --}}
                                                    <div class="form-group d-flex justify-content-center align-items-center">
                                                        <input id="is_with_previous_{{$loop->index}}" type="checkbox" value="1"
                                                            name="sections[{{$loop->index}}][is_with_previous]"
                                                            @if($datum->is_with_previous) checked @endif
                                                            class="form-control w20px mr-2">
                                                        <label for="is_with_previous_{{$loop->index}}" class="col-form-label">
                                                            Is with previous section?
                                                        </label>
                                                    </div>

                                                    {{-- Image --}}
                                                    <div class="form-group">
                                                        <label for="image_{{$loop->index}}" class="col-form-label">
                                                            Image
                                                        </label>
                                                        <input id="image_{{$loop->index}}" type="file"
                                                            name="sections[{{$loop->index}}][image]"
                                                            class="form-control image-input"
                                                            accept="image/*"
                                                            value="{{$datum->image}}"
                                                            >
                                                        <div class="image-preview-container">
                                                            @if($datum->image)
                                                                <img src="/storage/{{ $datum->image }}"
                                                                    class="image-preview"
                                                                    alt="Section Image">
                                                            @endif
                                                        </div>
                                                        @error("sections.{$loop->index}.image")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Video --}}
                                                    <div class="form-group">
                                                        <label for="video_link_{{$loop->index}}" class="col-form-label">
                                                            Video (Embedded Code)
                                                        </label>
                                                        <textarea class="form-control"
                                                                id="video_link_{{$loop->index}}"
                                                                name="sections[{{$loop->index}}][video_link]">{!! $datum->video_link !!}</textarea>
                                                        @error("sections.{$loop->index}.video_link")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Title --}}
                                                    <div class="form-group">
                                                        <label for="title_{{$loop->index}}" class="col-form-label">
                                                            Title
                                                        </label>
                                                                    <textarea class="form-control csummernote"
                                                        id="title_{{$loop->index}}"
                                                        name="sections[{{$loop->index}}][title]">{!! $datum->title ?? null !!}</textarea>

                                                        @error("sections.{$loop->index}.title")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Sub Title --}}
                                                    <div class="form-group">
                                                        <label for="sub_title_{{$loop->index}}" class="col-form-label">
                                                            Sub Title
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                                id="sub_title_{{$loop->index}}"
                                                                name="sections[{{$loop->index}}][sub_title]">{!! $datum->sub_title ?? null !!}</textarea>
                                                        @error("sections.{$loop->index}.sub_title")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Description --}}
                                                    <div class="form-group">
                                                        <label for="description_{{$loop->index}}" class="col-form-label ">
                                                            Description
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                                id="description_{{$loop->index}}"
                                                                name="sections[{{$loop->index}}][description]">{!! $datum->description !!}</textarea>
                                                        @error("sections.{$loop->index}.description")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Button --}}
                                                    <div class="form-group">
                                                        <label for="button_{{$loop->index}}" class="col-form-label">
                                                            Button Text
                                                        </label>
                                                        <input id="button_{{$loop->index}}" type="text"
                                                            name="sections[{{$loop->index}}][button]"
                                                            value="{{$datum->button}}"
                                                            placeholder="Enter button text"
                                                            class="form-control">
                                                        @error("sections.{$loop->index}.button")
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </section>
                                            @empty
                                                <section class="card card-body mt-3 section-controls">
                                                    <div class="section-number">1</div>
                                                    <div class="section-header">
                                                        <h5 class="section-title">Section 1</h5>
                                                        <button type="button" class="btn btn-danger btn-sm remove-section">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Empty state form fields -->
                                                    <div class="form-group d-flex justify-content-center align-items-center">
                                                        <input id="is_with_previous_0" type="checkbox" value="1"
                                                            name="sections[0][is_with_previous]"
                                                            class="form-control w20px mr-2">
                                                        <label for="is_with_previous_0" class="col-form-label">
                                                            Is with previous section?
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="image_0" class="col-form-label">
                                                            Image
                                                        </label>
                                                        <input id="image_0" type="file"
                                                            name="sections[0][image]"
                                                            class="form-control image-input"
                                                            accept="image/*">
                                                        <div class="image-preview-container"></div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="video_link_0" class="col-form-label">
                                                            Video (Embedded Code)
                                                        </label>
                                                        <textarea class="form-control"
                                                                id="video_link_0"
                                                                name="sections[0][video_link]"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="title_0" class="col-form-label">
                                                            Title
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                        id="title_0"  placeholder="Enter title"
                                                        name="sections[0][title]"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="sub_title_0" class="col-form-label">
                                                            Sub Title
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                                id="sub_title_0" placeholder="Enter sub-title"
                                                                name="sections[0][sub_title]"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description_0" class="col-form-label">
                                                            Description
                                                        </label>
                                                        <textarea class="form-control csummernote"
                                                                id="description_0"
                                                                name="sections[0][description]"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="button_0" class="col-form-label">
                                                            Button Text
                                                        </label>
                                                        <input id="button_0" type="text"
                                                            name="sections[0][button]"
                                                            placeholder="Enter button text"
                                                            class="form-control">
                                                    </div>
                                                </section>
                                            @endforelse
                                        @endif

                                    </div>

                                    <div class="text-center">
                                        <button type="button" id="add-section-btn" class="btn btn-primary btn-floating">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="form-group mb-3 text-center mt-4">
                                        <button type="reset" class="btn btn-warning">
                                            <i class="fas fa-undo"></i> Reset
                                        </button>
                                        <button class="btn btn-success" type="submit">
                                            <i class="fas fa-save"></i> Submit
                                        </button>
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

    //Summar note
    $('.csummernote').summernote({
        placeholder: "Write short description.....",
        tabsize: 2,
        height: 100
    });
    // Image preview functionality
    $(document).on('change', '.image-input', function() {
        const file = this.files[0];
        const previewContainer = $(this).siblings('.image-preview-container');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewContainer.html(`<img src="${e.target.result}" class="image-preview" alt="Preview">`);
            }

            reader.readAsDataURL(file);
        } else {
            previewContainer.empty();
        }
    });

    // Add new section functionality
    $('#add-section-btn').click(function() {
        const sectionCount = $('.section-controls').length;
        const newSection = `
            <section class="card card-body mt-3 section-controls">
                <div class="section-number">${sectionCount + 1}</div>
                <button type="button" class="btn btn-danger btn-sm remove-section"><i class="fas fa-minus"></i></button>

                <div class="form-group d-flex justify-content-center align-items-center">
                    <input id="is_with_previous_${sectionCount}" type="checkbox" value="1" name="sections[${sectionCount}][is_with_previous]" placeholder="Enter title" class="form-control w20px mr-2">
                    <label for="is_with_previous_${sectionCount}" class="col-form-label">Is with previous section?</label>
                </div>

                <div class="form-group">
                    <label for="image_${sectionCount}" class="col-form-label">Image</label>
                    <input id="image_${sectionCount}" type="file" name="sections[${sectionCount}][image]" class="form-control image-input" accept="image/*">
                    <div class="image-preview-container"></div>
                </div>

                <div class="form-group">
                    <label for="video_link_${sectionCount}" class="col-form-label">Video (Embeded Code) </label>
                    <textarea class="form-control" id="video_link_${sectionCount}" name="sections[${sectionCount}][video_link]"></textarea>
                </div>

                <div class="form-group">
                    <label for="title_${sectionCount}" class="col-form-label">Title </label>
                    <textarea class="form-control csummernote${sectionCount}" id="title_${sectionCount}"  placeholder="Enter title" name="sections[${sectionCount}][title]"></textarea>
                </div>

                <div class="form-group">
                    <label for="sub_title_${sectionCount}" class="col-form-label">Sub Title </label>
                    <textarea class="form-control csummernote${sectionCount}" id="sub_title_${sectionCount}" placeholder="Enter sub-title" name="sections[${sectionCount}][sub_title]"></textarea>
                </div>

                <div class="form-group">
                    <label for="description_${sectionCount}" class="col-form-label">Description </label>
                    <textarea class="form-control csummernote${sectionCount}" id="description_${sectionCount}" name="sections[${sectionCount}][description]"></textarea>
                </div>

                <div class="form-group">
                    <label for="button_${sectionCount}" class="col-form-label">Text for Button</label>
                    <input id="button_${sectionCount}" type="text" name="sections[${sectionCount}][button]" placeholder="Enter text for button" class="form-control">
                </div>
            </section>
        `;

        $('#sections-container').append(newSection);
        //Summar note
        $(`.csummernote${sectionCount}`).summernote({
            placeholder: "Write short description.....",
            tabsize: 2,
            height: 100
        });
        reorderSections();
    });

    // Remove section functionality
    $(document).on('click', '.remove-section', function() {
        if ($('.section-controls').length > 1) {
            $(this).closest('section').remove();
            reorderSections();
        } else {
            alert('You cannot remove the last section!');
        }
    });

    // Function to reorder section indices
    function reorderSections() {
        $('.section-controls').each(function(index) {
            // Update all input names and IDs in this section
            $(this).find('input, textarea').each(function() {
                const element = $(this);
                const name = element.attr('name');
                if (name) {
                    element.attr('name', name.replace(/sections\[\d+\]/, `sections[${index}]`));
                }
                const id = element.attr('id');
                if (id) {
                    element.attr('id', id.replace(/\_\d+$/, `_${index}`));
                }
            });

            // Update labels' for attributes
            $(this).find('label').each(function() {
                const forAttr = $(this).attr('for');
                if (forAttr) {
                    $(this).attr('for', forAttr.replace(/\_\d+$/, `_${index}`));
                }
            });
        });
    }


});
</script>
@endpush
