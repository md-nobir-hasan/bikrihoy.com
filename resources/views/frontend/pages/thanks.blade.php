@extends('frontend.layouts.app')

@push('css')
<style>
.thankyouSection {
    padding: 60px 0;
    background-color: #f8f9fa;
}

.thankMain {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

.thankTop {
    text-align: center;
    margin-bottom: 40px;
}

.thankData {
    color: #28a745;
    font-size: 24px;
    margin-bottom: 20px;
    position: relative;
}

.thankData:before {
    content: '✓';
    display: block;
    width: 60px;
    height: 60px;
    line-height: 60px;
    background: #28a745;
    color: white;
    border-radius: 50%;
    margin: 0 auto 20px;
    font-size: 30px;
}

.thankOrder {
    margin-bottom: 40px;
}

.orderproces {
    font-size: 20px;
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
}

.table {
    margin-bottom: 0;
}

.table td {
    padding: 15px;
    vertical-align: middle;
}

.table tr:first-child td {
    border-top: none;
}

.thankAddress {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
}

.sub_title2 {
    font-size: 20px;
    margin-bottom: 20px;
    color: #333;
}

.thankName {
    font-size: 18px;
    margin-bottom: 10px;
    color: #444;
}

.thankAddressData, .thankMobile {
    color: #666;
    margin-bottom: 5px;
    line-height: 1.6;
}
</style>
@endpush
@section('page_content')
<section class="thankyouSection">
    <div class="container">
        <div class="thankMain">
            <div class="thankTop">
                <h4 class="thankData">Thank you. Your order has been received.</h4>
            </div>

            {{-- Order Details --}}
            <div class="thankOrder">
                <h3 class="orderproces">Order Details</h3>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <td width="30%">Order ID</td>
                        <td><strong>{{$order->order_number}}</strong></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td><strong>{{$order->created_at->format('d-M-Y')}}</strong></td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td><strong>Cash on Delivery</strong></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td><strong>&#2547;{{number_format($order->total, 2)}}</strong></td>
                    </tr>
                </table>
            </div>

            <div class="thankAddress">
                <h2 class="sub_title2">Shipping Address</h2>
                <h3 class="thankName">{{$order->name}}</h3>
                <p class="thankAddressData">{{$order->address}}</p>
                <p class="thankMobile">📞 {{$order->phone}}</p>
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
