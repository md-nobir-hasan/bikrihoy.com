

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
                        <td>BKO12054</td>
                    </tr>
                    <tr>
                        <td>Order Date:</td>
                        <td><b>November 4, 2024</b></td>
                    </tr>
                    <tr>
                        <td>Payment type</td>
                        <td><b>Cash on delivery</b></td>
                    </tr>
                    <tr>
                        <td>Total payment</td>
                        <td><b>&#2547;10235</b></td>
                    </tr>
                    
                </table>
            </div>
            <div class="thankAddress">
                <h2 class="sub_title2">Shipping address</h2>
                <h3 class="thankName">Md Anower Hossan</h3>
                <p class="thankAddressData">House: 107, Word: 07, Vill: Char-veduril, Bhola Sadar, Bhola-8300</p>
                <p class="thankMobile">01990000922</p>
                
            </div>
        </div>
    </div>
</section>
@endsection