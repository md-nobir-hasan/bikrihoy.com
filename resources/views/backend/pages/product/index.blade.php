@extends('backend.layouts.app')

@section('title', 'Product Management')

@push('third_party_stylesheets')
    <link href="{{ asset('assets/backend/js/DataTable/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('page_css')
<style>
    .size-6{
        height: 21px;
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
                            <h4>View Product</h4>
                        </span>
                        <span class="float-right @if (!check('Product')->add) d-none @endif">
                            <a href="{{ route('product.create') }}" class="btn btn-info">Add new Product</a>
                        </span>
                    </div>
                    <div class="card-body">
                        @include('backend.partial.flush-message')

                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Title</th>
                                        <th>Sku</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Stock</th>
                                        <th>Photo</th>
                                        <th>Product gallery</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th class="@if (!check('Product')->edit && !check('Product')->delete) d-none @endif"
                                            id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($products as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->sku }}</td>
                                            <td>{{ $value->cat_info ? $value->cat_info->title : '' }}</td>
                                            <td>TK. {{ $value->price }} /-</td>
                                            <td> {{ $value->discount }}TK</td>
                                            <td>
                                                @if ($value->stock > 0)
                                                    <span class="badge badge-primary">{{ $value->stock }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $value->stock }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset($value->photo) }}" style="height: 100px; width: 150px;"
                                                    class="img-fluid zoom" style="max-width:80px"
                                                    alt="{{ $value->photo }}">
                                            </td>

                                            <td>
                                                <a href="{{ url('product/show_gallery', $value->id) }}" class="btn btn-sm btn-primary">Show_Gallery</a>
                                            </td>

                                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td>
                                                @if ($value->status == 'active')
                                                    <span class="badge badge-success">{{ $value->status }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $value->status }}</span>
                                                @endif
                                            </td>
                                            <td class="text-middle py-0 align-middle @if (!check('Product')->edit && !check('Product')->delete) d-none @endif">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.edit', $value->id) }}"
                                                        class="btn btn-dark btnEdit @if (!check('Product')->edit) d-none @endif"><i class="fas fa-edit"></i></a>
                                                    {{-- @endif --}}
                                                    {{-- @if (Auth::user()->can('delete product') || Auth::user()->role->id == 1) --}}
                                                    <a href="{{ route('product.destroy', $value->id) }}"
                                                        class="btn btn-danger btnDelete @if (!check('Product')->delete) d-none @endif"><i class="fas fa-trash"></i></a>
                                                    @if ($value->is_landing)
                                                        <a href="{{ route('lp.edit', $value->id) }}" target="_blank"
                                                            class="btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                                            </svg>
                                                        </a>
                                                      @endif
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
                        title: 'District Management',
                        download: 'open',
                        orientation: 'potrait',
                        pagesize: 'LETTER',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }, 'pageLength'
                ]
            });
        });
    </script>
@endpush
