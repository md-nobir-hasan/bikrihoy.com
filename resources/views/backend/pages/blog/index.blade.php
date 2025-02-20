@extends('backend.layouts.app')

@section('title', 'Blog Management')

@push('third_party_stylesheets')
    <link href="{{ asset('assets/backend/js/DataTable/datatables.min.css') }}" rel="stylesheet">
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
                            <h1>View Blog</h1>
                        </span>
                        <span class="float-right @if (!check('Blog')->add) d-none @endif">
                            <a href="{{ route('blog.create') }}" class="btn btn-info">Add new Blog</a>
                        </span>
                    </div>
                    <div class="card-body">
                        @include('backend.partial.flush-message')

                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Author</th>
                                        <th>Author Image</th>
                                        <th>Slug</th>
                                        <th>Content</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th class="@if (!check('Blog')->edit && !check('Blog')->delete) d-none @endif"
                                            id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blogs as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->subtitle }}</td>
                                            <td>{{ $value->author }}</td>
                                            <td><img src="{{ asset($value->author_image) }}" alt="{{ $value->author }}"
                                                    class="rounded img-thumbnail secreen-logo"></td>
                                            <td>{{ $value->slug }}</td>
                                            <td>{!! Str::words($value->content, 100) !!}</td>
                                            <td><img src="{{ asset($value->image) }}" alt="{{ $value->title }}"
                                                    class="rounded img-thumbnail secreen-logo"></td>
                                            <td>{{ $value->status_formatted }}</td>
                                            <td class="text-middle py-0 align-middle @if (!check('Blog')->edit && !check('Blog')->delete) d-none @endif">
                                                <div class="btn-group">
                                                    <a href="{{ route('blog.edit', $value->id) }}"
                                                        class="btn btn-dark btnEdit @if (!check('Blog')->edit) d-none @endif"><i class="fas fa-edit"></i></a>
                                                    {{-- @endif --}}
                                                    {{-- @if (Auth::user()->can('delete brand') || Auth::user()->role->id == 1) --}}
                                                    <form action="{{ route('blog.destroy', $value->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btnDelete @if (!check('Blog')->delete) d-none @endif"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    {{-- @endif --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@push('third_party_scripts')
    <script src="{{ asset('assets/backend/js/DataTable/datatables.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdfHtml5',
                        title: 'Blog Management',
                        download: 'open',
                        orientation: 'potrait',
                        pagesize: 'LETTER',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }, 'pageLength'
                ]
            });
        });
    </script>
@endpush
