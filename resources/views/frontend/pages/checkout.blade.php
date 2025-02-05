@extends('frontend.layouts.app')

@push('custom-js')
<script>
    $(document).ready(function () {
    function calculateTotal() {
        // Get values
        let price = parseFloat($('.price').text());
        let discount = parseFloat($('.discount').text());
        let quantity = parseInt($('.countShow').val());
        let shipping = parseFloat($('input[name="shipping_id"]:checked').attr('id'));
         shipping = shipping ? shipping : 0;
        // Calculate subtotal and total
        let subtotal = (price - discount) * quantity;
        let total = subtotal + shipping;

        // Update HTML
        $('.subtotal').text(subtotal.toFixed(2));
        $('.total').text(total.toFixed(2));
    }

    // Initial calculation on page load
    calculateTotal();

    // Update quantity when plus or minus buttons are clicked
    $('.plusBtn').on('click', function () {
        let count = parseInt($('.countShow').val());
        $('.countShow').val(count + 1);
        calculateTotal();
    });

    $('.minusBtn').on('click', function () {
        let count = parseInt($('.countShow').val());
        if (count > 1) {
            $('.countShow').val(count - 1);
            calculateTotal();
        }
    });

    // Update shipping when a different option is selected
    $('.shipping-option').on('change', function () {
        calculateTotal();
    });

    // Update subtotal and total when quantity input field is changed manually
    $('.countShow').on('input', function () {
        if ($(this).val() < 1) {
            $(this).val(1); // Ensure quantity is at least 1
        }
        calculateTotal();
    });
});

fbq('track', 'InitiateCheckout', {
    value: "{{($product->price - $product->discount)* ($qty ?? 1)}}",
    currency: 'BDT',
    num_items: "{{$qty ?? 1}}"
});

</script>
@endpush

@section('page_conent')
    <section class="checkoutSection">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-danger">
                    আপনি ইতিপূর্বেই {{ session('success') }} নাম্বার দিয়ে অর্ডার সম্পূর্ণ করেছেন।
                    অর্ডার সম্পর্কে বিস্তারিত জানতে - <br>
                    Call: <a href="tel:{{$site_contact_info->phone}}"> {{$site_contact_info->phone}}</a> <br>
                    Whatsapp: <a href="https://wa.me/{{$site_contact_info->whatsapp}}"> {{$site_contact_info->whatsapp}}</a>
                </div>
            @endif
            <div class="checkoutMain">
                <!-- main form -->
                 <form action="{{route('order.store')}}" method="POST" class="multiple-submit-prevent ckeckoutForm">
                    @csrf

                    <input type="hidden" name="color_id" value="{{$color->id ?? null}}">
                    <!-- Payment amout calculate -->
                    <div class="checkoutFormRight">
                        <div class="orderprocess">
                            <h3 class="orderproces">Your Order</h3>
                            <h4 class="checkoutProductTitle">{{$product->title}} @if ($color)  | {{$color->c_name }} @endif</h4>
                            <table class="w-100">
                                <tbody>
                                    <input type="hidden" name="slug" value="{{$product->slug}}">

                                    <tr>
                                        <td><b>Price</b></td>
                                        <td><b>৳ <span class="price">{{$product->price}}</span></b></td>
                                    </tr>

                                    <tr>
                                        <td>Discount</td>
                                        <td><b>৳ <span class="discount">{{$product->discount}}</span></b></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td>
                                            <div class="quantity">
                                                <input class="minusBtn" type="button" value="-">
                                                <input class="countShow" name="qty" type="number" min="1" value="{{$qty ?? 1}}">
                                                <input class="plusBtn" type="button" value="+">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Subtotal</b></td>
                                        <td><b>৳ <span class="subtotal"></span></b></td>
                                    </tr>
                                    @if($product->productShipping->count() > 0)
                                        <tr>
                                            <td><b>Shipping</b></td>
                                            <td class="checkradio">
                                                @foreach ($product->productShipping as $shipping)
                                                    <div>
                                                        <label for="{{$shipping->price}}">{{$shipping->type}}: <span>৳ <span class="shipping-price">{{$shipping->price}}</span></span></label>
                                                        <input type="radio" name="shipping_id" id="{{$shipping->price}}" class="shipping-option" value="{{$shipping->id}}"  checked>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><strong>৳ <span class="total"></span></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <!-- Billing info -->
                    <div class="checkoutFormLeft">
                        <div class="address">
                            <span class="numberCountBill">1.</span>
                            <h3 class="addressTitle">Billing Details</h3>
                        </div>

                        <label for="Cname">পুরো নাম *</label>
                        <input type="text" name="name" id="Cname" required>
                        @error('recipient_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror

                        <label for="Cmobile">মোবাইল নাম্বার *</label>
                        <input type="tel" name="phone" id="Cmobile" required>
                        @error('recipient_phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror


                        <label for="Caddress">পুর্ণ ঠিকানা *</label>
                        <input type="text" name="address" id="Caddress" required>
                        @error('recipient_address')
                            <span class="text-danger">{{$message}}</span>
                        @enderror


                        <label for="note">আপনার মতামত এখানে লিখুন </label>
                        <textarea name="note" id="note" class="form-control" cols="30" rows="6"></textarea>
                        @error('note')
                            <span class="text-danger">{{$message}}</span>
                        @enderror


                        <div class="pamentInfoMain">
                            <div class="address">
                                <span class="numberCountBill">2.</span>
                                <h3 class="addressTitle">Payment Information</h3>
                            </div>

                            <label for="cashDelidery">Cash on delivery</label>
                            <input class="disabledr" type="text" value="Pay with cash upon delivery." name="#" id="cashDelidery" disabled>
                            <p class="paragraph">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></p>
                            <button class="btn_primary w-100">Place Order</button>
                        </div>
                    </div>

                 </form>
            </div>
        </div>
    </section>
@endsection

