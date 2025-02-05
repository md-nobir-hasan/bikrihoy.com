@extends('backend.layouts.app')

@section('title', 'Order Management')

@push('third_party_stylesheets')
    <link href="{{ asset('assets/backend/js/DataTable/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('page_css')
    <style>
        .btn-box {
            display: flex;
            justify-content: center;
        }

        .dialogify-bottom-select {
            margin-bottom: 33px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Cusomer Details</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-info ml-auto">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="table table-striped m-auto table-sm">
                                <tbody>
                                    <tr>
                                        <td>Order Number:</td>
                                        <td>{{ $order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Price:</td>
                                        <td>{{ $order->shipping ? $order->shipping->price : 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method:</td>
                                        <td>{{ $order->payment->payment }}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Note:</td>
                                        <td>{{ $order->note }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex justify-content-between">
                            <h4>Product Details</h4>
                            <div class="d-flex justify-content-right">

                                {{-- Status  --}}
                                @if (serviceCheck('Order Status'))
                                    <span class="align-middle">
                                        <a class="btn">
                                            @if ($order->order_status == 'new')
                                                <span class="badge p-2 badge-primary order_status" id="order_status"
                                                    data-order-id="{{ $order->id }}" onclick="orderStatus({{ $order->id }})"
                                                    >{{ $order->order_status }}</span>
                                            @elseif($order->order_status == 'process')
                                                <span class="badge p-2 badge-warning order_status" id="order_status"
                                                    data-order-id="{{ $order->id }}" onclick="orderStatus({{ $order->id }})"
                                                    >{{ $order->order_status }}</span>
                                            @elseif($order->order_status == 'delivered')
                                                <span class="badge p-2 badge-success order_status" id="order_status"
                                                    data-order-id="{{ $order->id }}" onclick="orderStatus({{ $order->id }})"
                                                    >{{ $order->order_status }}</span>
                                            @else
                                                <span class="badge p-2 badge-danger order_status" id="order_status"
                                                    data-order-id="{{ $order->id }}" onclick="orderStatus({{ $order->id }})"
                                                    >{{ $order->order_status }}</span>
                                            @endif
                                        </a>
                                    </span>
                                @endif

                                {{-- order edit and delete  --}}
                                <div class="align-middle mr-1 @if (!check('Order')->edit && !check('Order')->delete) d-none @endif">
                                    <div class="btn-group">
                                        {{-- Edit order  --}}
                                        <a href="{{ route('order.edit', $order->id) }}" target="_blank"
                                            class="btn btn-dark btnEdit" title="Edit"><i
                                                class="fas fa-edit"></i></a>

                                        {{-- Delete order  --}}
                                        <a href="{{ route('order.delete', $order->id) }}"
                                            class="btn btn-danger btnDelete @if (!check('Order')->delete) d-none @endif" title="Move to trash"><i
                                                class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                                {{-- Send to curier button  --}}
                                <a class="btn btn-primary" href="{{route('order.sendToCourier', $order->id)}}">Send to Courier</a>&nbsp;
                                
                                <a class="btn btn-success" href="{{route('order.sendToPathao', $order->id)}}">Send to Pathao</a>

                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        @include('backend.partial.flush-message')
                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Product title</th>
                                        <th>Proudct Price</th>
                                        <th>Discount</th>
                                        <th>Quantity</th>
                                        <th>Total Amound</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_dis = 0;
                                    @endphp
                                    @forelse($order->orderItem as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> {{ $item->product->title }}</td>
                                            <td>{{ $item->product->price }}</td>
                                            <td>{{ $item->product->discount  }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Shipping =</td>
                                        <td>{{ $order->shipping ? $order->shipping->price : 0 }}৳</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold h5">Total =</td>
                                        <td class="fw-bold h5">{{ $order->total - $total_dis }}৳</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('third_party_scripts')
    <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
@endpush

@push('page_scripts')
    <script>

        // Dialogify
        function orderStatus(order_id) {
            var options = {
                ajaxPrefix: ''
            };
            new Dialogify('{{ url('order-status/ajax') }}', options)
                .title("Ordere Status")
                .buttons([{
                        text: "Cancle",
                        type: Dialogify.BUTTON_DANGER,
                        click: function(e) {
                            this.close();
                        }
                    },
                    {
                        text: 'Status update',
                        type: Dialogify.BUTTON_PRIMARY,
                        click: function(e) {
                            var name = $('#order_status_name').val();

                            $.ajax({
                                cache: false,
                                url: "{{ route('order-status.order-status-assign') }}",
                                method: "GET",
                                data: {
                                    name: name,
                                    order_id: order_id
                                },
                                success: function(data) {
                                    if (data != 0) {
                                        alert('Order Status successfully updated')
                                        // console.log($('#order_status').html());
                                        $('#order_status').html(data);

                                    } else {
                                        alert("Order Status can't update")

                                    }
                                }
                            });

                        }
                        // }
                    }
                ]).showModal();

        }

        function updateOrderStatuses() {
            $('.order_status').each(function() {
                const orderId = $(this).data('order-id');
                const statusElement = $(this);

                $.ajax({
                    url: `/api/order/${orderId}/check-status`,
                    method: 'GET',
                    success: function(response) {
                        if (response.newStatus) {
                            statusElement.removeClass('badge-primary badge-warning badge-success badge-danger');

                            switch(response.newStatus) {
                                case 'new':
                                    statusElement.addClass('badge-primary');
                                    break;
                                case 'process':
                                    statusElement.addClass('badge-warning');
                                    break;
                                case 'delivered':
                                    statusElement.addClass('badge-success');
                                    break;
                                default:
                                    statusElement.addClass('badge-danger');
                            }

                            statusElement.text(response.newStatus);
                        }
                    }
                });
            });
        }

        // Update statuses every 5 minutes
        setInterval(updateOrderStatuses, 300000);

        // Initial update
        updateOrderStatuses();
    </script>
@endpush
