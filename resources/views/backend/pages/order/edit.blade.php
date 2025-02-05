@extends('backend.layouts.app')

@section('title', 'Edit Order')

@push('third_party_stylesheets')
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
                            <h4>Update Order</h4>
                        </span>
                        <span class="float-right">
                            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <form method="post" action="{{ route('order.update',$order->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input id="name" type="text" name="name" placeholder="Enter title" required
                                            value="{{ $order->name }}" class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="col-form-label">Phone <span
                                                class="text-danger">*</span></label>
                                        <input id="phone" type="text" name="phone" placeholder="Enter phone" required
                                            value="{{ $order->phone }}" class="form-control">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-form-label">Address <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="address" name="address" required>{{ $order->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input id="email" type="text" name="email" placeholder="Enter email"
                                            value="{{ $order->email }}" class="form-control">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total" class="col-form-label">Paid Amount <span
                                                class="text-danger">*</span></label>
                                        <input id="total" type="number" name="total" min="0" step="1"
                                            placeholder="Enter total" value="{{ $order->total }}" required
                                            class="form-control">
                                        @error('total')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="note" class="col-form-label">User Note</label>
                                        <textarea class="form-control" id="note" name="note">{{ $order->note }}</textarea>
                                        @error('note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="invoice_id" class="col-form-label">Invoice ID <span class="text-danger">*</span></label>
                                        <input id="invoice_id" type="text" name="invoice_id"
                                               placeholder="Enter Invoice ID (4 digits, min 1000)"
                                               value="{{ old('invoice_id',$order->invoice_id) }}"
                                               class="form-control" required>
                                        @error('invoice_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Order status --}}
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Order Status <span
                                                class="text-danger">*</span></label>
                                        <select name="status" class="form-control" name="order_status">
                                            @foreach ($order_statuses as $order_status)
                                                <option value="{{ $order_status->name }}"
                                                    @if ($order_status->name == $order->status) selected @endif>
                                                    {{ $order_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button class="btn btn-success" type="submit">Update</button>
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
    <script src="{{ asset('assets/js/DataTable/datatables.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script></script>
@endpush
