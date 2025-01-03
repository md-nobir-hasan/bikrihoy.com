@extends('frontend.layouts.app')

@push('css')
    <style>
        /* Main Container */
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
        }

        /* Top Banner Section */
        .hero-section {
            background: linear-gradient(180deg, #fff 0%, #e7b3f3 100%);
            padding: 20px;
            text-align: center;
            border-bottom-left-radius: 50% 10%;
            border-bottom-right-radius: 50% 10%;
        }

        .hero-title {
            color: #000;
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        .hero-subtitle {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .discount-banner {
            background: #ff69b4;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            display: inline-block;
            margin: 15px 0;
            font-weight: bold;
        }

        .cta-button {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            margin: 15px 0;
            border: none;
            transition: all 0.3s ease;
        }

        /* FAQ Section */
        .faq-section {
            background: #4a148c;
            padding: 15px;
            margin: 20px 0;
        }

        .faq-item {
            color: white;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 16px;
        }

        /* Additional FAQ Section */
        .additional-faq {
            background: #ff69b4;
            padding: 15px;
            margin: 20px 0;
        }

        .additional-faq .faq-item {
            color: white;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Video Section */
        .video-section {
            margin: 20px 0;
            padding: 15px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Benefits Section */
        .benefits-section {
            background: #ff69b4;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .benefits-title {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .benefits-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefits-list li {
            color: white;
            padding: 10px 0;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .benefits-list li:before {
            content: "✓";
            margin-right: 10px;
            font-weight: bold;
        }

        /* Order Form Section */
        .order-form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Product Summary */
        .product-summary {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        /* Footer CTA */
        .footer-cta {
            background: #ff5722;
            color: white;
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        /* Messenger Button */
        .messenger-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1001;
            background: #6E45E2;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Product Selection Styles */
        .product-selection {
            margin: 20px 0;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .product-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .product-option:last-child {
            border-bottom: none;
        }

        .product-radio {
            margin-right: 15px;
        }

        .product-details {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 5px;
        }

        .product-info {
            flex-grow: 1;
        }

        .product-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-price {
            color: #ff69b4;
            font-weight: bold;
        }

        /* Order Summary Styles */
        .order-summary {
            background: #f8f9fa;
            padding: 15px;
            margin: 20px 0;
            border-radius: 10px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .summary-total {
            font-weight: bold;
            color: #ff69b4;
        }

        /* Shipping Selection Styles */
        .shipping-selection {
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .shipping-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .shipping-option:last-child {
            border-bottom: none;
        }

        .shipping-radio {
            margin-right: 15px;
        }

        .shipping-details {
            display: flex;
            justify-content: space-between;
            flex-grow: 1;
        }

        .shipping-info {
            font-size: 14px;
        }

        .shipping-price {
            color: #ff69b4;
            font-weight: bold;
        }
    </style>
@endpush

@section('page_content')
    <div class="main-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">আপনার সন্তানের আরাম ও সুরক্ষায় নিশ্চিত থাকুন,সাশ্রয় করুন আপনার কষ্টের টাকায় এবং থাকুন সেরাটা</h1>
            <p class="hero-subtitle">আপনার সন্তানের জন্য সেরা খুঁজে, এখন মাত্রের দাগজালে সাশ্রয়ী মূল্যে উন্নত মানের ওয়াশেবল ডায়াপার এখনই কিনুন</p>
            <div class="discount-banner">
                এখনই অর্ডার করুন এবং ২০% ছাড় পান। সীমিত সময়ের জন্য!
            </div>
            <button class="cta-button">অর্ডার করতে ক্লিক করুন</button>
        </div>

        <!-- Main FAQ Section -->
        <div class="faq-section">
            <div class="faq-item">শার্টিক ডায়াপার কি আপনার সন্তানের আরাম বেড়ে দিবে?</div>
            <div class="faq-item">কেন আমাদের এখানের ডায়াপার নেবে?</div>
            <div class="faq-item">সেরার সিক্রেট: কোনো সিক্রেট নয়া</div>
        </div>

        <!-- Additional FAQ Section -->
        <div class="additional-faq">
            <div class="faq-item">এটি কি এক বারের জন্য ব্যবহারযোগ্য?</div>
            <div class="faq-item">কতদিন টিকে থাকে?</div>
        </div>

        <!-- Video Section -->
        <div class="video-section">
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/your-video-id" allowfullscreen></iframe>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="benefits-section">
            <h3 class="benefits-title">শুধু ডায়াপার নয়, এটি একটি বিনিয়োগ:</h3>
            <ul class="benefits-list">
                <li>সাশ্রয়ী: বারবার ব্যবহারের মাধ্যমে খরচ কমায়।</li>
                <li>পরিবেশবান্ধব: রাষ্ট্রিক খরচা কমায়।</li>
                <li>স্বাস্থ্যকর: শিশুর ত্বকে কোনো ক্ষতিকারক রাসায়নিক নেই।</li>
                <li>সহজ পরিচর্যা: মাত্র কয়েক ধাপেই ধুয়ে পুনরায় ব্যবহার করুন।</li>
                <li>দীর্ঘস্থায়ী: একবার কিনলে মাসের পর মাস ব্যবহার করুন।</li>
            </ul>
        </div>
        <form action="{{route('order.store')}}" method="POST" id="orderForm">
            @csrf
            <!-- Product Selection -->
            <div class="product-selection">
                <h3>পণ্য নির্বাচন করুন</h3>
                @foreach($products as $product)
                    <div class="product-option">
                        <input
                            type="radio"
                            name="slug"
                            id="product{{ $product->id }}"
                            value="{{ $product->slug }}"
                            class="product-radio"
                            {{ $loop->first ? 'checked' : '' }}
                        >
                        <label for="product{{ $product->id }}" class="product-details">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="product-image">
                            <div class="product-info">
                                <div class="product-title">{{ $product->title }}</div>
                                <div class="product-price">৳{{ number_format($product->price, 2) }}</div>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- Shipping Selection -->
            <div class="shipping-selection">
                <h3>ডেলিভারি চার্জ নির্বাচন করুন</h3>
                @foreach($shippings as $shipping)
                    <div class="shipping-option">
                        <input
                            type="radio"
                            name="shipping_id"
                            id="shipping{{ $shipping->id }}"
                            value="{{ $shipping->id }}"
                            class="shipping-radio"
                            {{ $loop->first ? 'checked' : '' }}
                        >
                        <label for="shipping{{ $shipping->id }}" class="shipping-details">
                            <div class="shipping-info">{{ $shipping->type }}</div>
                            <div class="shipping-price">৳{{ number_format($shipping->price, 2) }}</div>
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3>অর্ডার সামারি</h3>
                <div class="summary-item">
                    <span class="item-name">Selected Product:</span>
                    <span class="item-value" id="selectedProductName">{{ $products->first()->title }}</span>
                </div>
                <div class="summary-item">
                    <span>সাবটোটাল:</span>
                    <span id="subtotal">৳{{ number_format($products->first()->price, 2) }}</span>
                </div>
                <div class="summary-item">
                    <span>শিপিং:</span>
                    <span id="shipping-cost">৳{{ number_format($shippings->first()->price, 2) }}</span>
                </div>
                <div class="summary-item summary-total">
                    <span>টোটাল:</span>
                    <span id="total">৳{{ number_format($products->first()->price + $shippings->first()->price, 2) }}</span>
                </div>
            </div>

            <!-- Order Form -->
            <div class="order-form">
                <h3>অর্ডার করতে নিচের ফরমটি পূরণ করুন</h3>
                @if(session('success'))
                    <div class="alert alert-danger">
                        আপনি ইতিপূর্বেই {{ session('success') }} নাম্বার দিয়ে অর্ডার সম্পূর্ণ করেছেন।
                        অর্ডার সম্পর্কে বিস্তারিত জানতে - <br>
                        Call: <a href="tel:{{$site_contact_info->phone}}"> {{$site_contact_info->phone}}</a> <br>
                        Whatsapp: <a href="https://wa.me/{{$site_contact_info->whatsapp}}"> {{$site_contact_info->whatsapp}}</a>
                    </div>
                @endif
                    <div class="form-group">
                        <label class="form-label" for="name">আপনার নাম <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">মোবাইল নাম্বার <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">সম্পূর্ণ ঠিকানা <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="note">আপনার মতামত এখানে লিখুন</label>
                        <textarea class="form-control" id="note" rows="3" name="note" ></textarea>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" id="productName" name="productName" value="{{ $products->first()->title }}">
                    <input type="hidden" id="productPrice" name="productPrice" value="{{ $products->first()->price }}">
                    <input type="hidden" id="shippingCost" name="shippingCost" value="{{ $shippings->first()->price }}">
                    <button type="submit" class="cta-button">অর্ডার কনফার্ম করুন</button>

            </div>
        </form>
        <!-- Messenger Button -->
        <div class="messenger-button">
            <i class="fab fa-facebook-messenger"></i>
        </div>
    </div>
@endsection

@push('custom-js')
<script>
    $(document).ready(function() {
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.hash);
            $('html, body').animate({
                scrollTop: target.offset().top - 20
            }, 800);
        });

        // Form submission handling
        $('#orderForm').on('submit', function(e) {
            const submitButton = $(this).find('button[type="submit"]');

            // If the button is already disabled, stop here
            if (submitButton.prop('disabled')) {
                return false;
            }

            const name = $('#name').val();
            const phone = $('#phone').val();
            const address = $('#address').val();

            if (!name || !phone || !address) {
                alert('Please fill in all required fields');
                return false;
            }

            // Disable the submit button and change text
            submitButton.prop('disabled', true)
                        .html('<i class="fas fa-spinner fa-spin"></i> Processing...');

            // Enable the button after 30 seconds (failsafe in case of network issues)
            setTimeout(function() {
                submitButton.prop('disabled', false)
                           .html('অর্ডার কনফার্ম করুন');
            }, 30000);

            return true;
        });

        function updateTotal() {
            const selectedProduct = $('input[name="product"]:checked');
            const selectedShipping = $('input[name="shipping_id"]:checked');

            // Get prices from the product-price and shipping-price divs
            const productPrice = parseFloat(selectedProduct.closest('.product-option')
                .find('.product-price').text().replace('৳', '').replace(',', ''));
            const shippingPrice = parseFloat(selectedShipping.closest('.shipping-option')
                .find('.shipping-price').text().replace('৳', '').replace(',', ''));

            const total = productPrice + shippingPrice;

            $('#subtotal').text('৳' + productPrice.toFixed(2));
            $('#shipping-cost').text('৳' + shippingPrice.toFixed(2));
            $('#total').text('৳' + total.toFixed(2));

            // Update hidden inputs
            $('#productPrice').val(productPrice);
            $('#shippingCost').val(shippingPrice);
        }

        // Handle product selection
        $('input[name="product"]').change(function() {
            const productName = $(this).closest('.product-option').find('.product-title').text();
            $('#selectedProductName').text(productName);
            $('#productName').val(productName);
            updateTotal();
        });

        // Handle shipping selection
        $('input[name="shipping_id"]').change(function() {
            updateTotal();
        });
    });
</script>
@endpush

