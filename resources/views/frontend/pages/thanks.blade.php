

@extends('frontend.layouts.app')


@section('page_conent')
<section class="thankyouSection">
    <div class="container">
        <div class="thankMain">
            <div class="thankTop">
                <h4 class="thankData">Thank you. Your order has been received.</h4>
            </div>

            {{-- Order Details --}}
            <div class="thankOrder">

                <h3 class="orderproces">Order details</h3>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <td>Order Id:</td>
                        <td>{{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Order Date:</td>
                        <td><b>{{$order->created_at->format('d-M-Y')}}</b></td>
                    </tr>
                    <tr>
                        <td>Payment type</td>
                        <td><b>Cash on delivery</b></td>
                    </tr>
                    <tr>
                        <td>Total payment</td>
                        <td><b>&#2547;{{$order->total}}</b></td>
                    </tr>

                </table>
            </div>
            <div class="thankAddress">
                <h2 class="sub_title2">Shipping address</h2>
                <h3 class="thankName">{{$order->name}}</h3>
                <p class="thankAddressData">{{$order->address}}</p>
                <p class="thankMobile">{{$order->phone}}</p>

            </div>
        </div>
    </div>
</section>
@endsection
@push('custom-js')
<script>
    $(document).ready(function () {
        fbq('track', 'Purchase', {
            value: '{{ $order->total }}', // Total order value
            currency: 'BDT', // Currency code
            order_id: '{{ $order->order_number }}', // Order number
            customer_name: '{{ $order->name }}', // Customer name
            customer_phone: '{{ $order->phone }}', // Customer phone
        });
    });
</script>
@endpush
