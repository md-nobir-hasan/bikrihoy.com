@extends('frontend.layouts.app')

@section('page_conent')
    <section class="checkoutSection">
        <div class="container">
            <div class="checkoutMain">

                <div class="sectionDevider tCheckout">
                </div>
                <!-- Coupon code -->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header top">
                        <span class="cFirst">Have a coupon?</span>
                        <button class="checkout accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            here to enter your code
                        </button>
                      </h2>
                    </div>

                </div>

                <!-- main form -->
                 <form action="{{route('order.store')}}" method="POST" class="ckeckoutForm">
                    @csrf

                    <!-- Payment amout calculate -->
                    <div class="checkoutFormRight">
                        <div class="orderprocess">
                            <h3 class="orderproces">Your Order</h3>
                            <h4 class="checkoutProductTitle"></h4>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                e    @foreach ($cart_products as $product)
                                     <input type="hidden" name="slug" value="{{$product->slug}}">
                                     <input type="hidden" name="qty" value="1">
                                        <tr>
                                            <td>{{$product->title}}</td>
                                            <td>৳ <span>{{$product->price}}</span></td>
                                        </tr>
                                        {{-- <input type="hidden" name="order_item [{{$loop->index}}][product_id]" value="$product"> --}}
                                    @endforeach
                                    <tr>
                                        <td><b>Discount</b></td>
                                        <td><b>৳ <span>{{$product->discount}}</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Subtotal</b></td>
                                        <td><b>৳ <span>{{ $sub_total = $product->price - $product->discount}}</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Shipping</b></td>
                                        <td class="checkradio">
                                            @foreach ($shippings as $shipping)

                                            <div>
                                                <label for="outDhaka">{{$shipping->type}}: <span>৳ <span>{{$shipping->price}}</span></span></label>
                                                <input type="radio" name="shipping_id" value="{{$shipping->id}}" id="OutDhaka" checked>
                                            </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><strong>৳ <span>{{$sub_total + $shipping->price }}</span></strong></td>
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

                        <label for="Cmobile">মোবাইল নাম্বার *</label>
                        <input type="tel" name="phone" id="Cmobile" required>

                        <label for="Caddress">পুর্ণ ঠিকানা *</label>
                        <input type="text" name="address" id="Caddress" required>

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

