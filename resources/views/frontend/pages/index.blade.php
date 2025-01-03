@extends('frontend.layouts.app')

@push('css')
    <style>
        /* Main Container */
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
        }

        /* Hero Section */
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
            margin: 20px 0;
        }

        .faq-section .accordion-item {
            border: none;
            background: transparent;
            margin-bottom: 10px;
        }

        .faq-section .accordion-button {
            background: linear-gradient(135deg, #e7b3f3 0%, #8a4fff 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px 20px;
            font-size: 16px;
            font-weight: 500;
        }

        .faq-section .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #8a4fff 0%, #e7b3f3 100%);
            color: white;
            box-shadow: none;
        }

        .faq-section .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .faq-section .accordion-body {
            background: white;
            border-radius: 0 0 8px 8px;
            padding: 20px;
            margin-top: -1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .additional-faq {
            background: #ff69b4;
            padding: 15px;
            margin: 20px 0;
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

        /* Form Styles */
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

        /* Product Selection Styles */
        .product-selection, .shipping-selection {
            margin: 20px 0;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .product-option, .shipping-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .product-radio, .shipping-radio {
            margin-right: 15px;
        }

        .product-details, .shipping-details {
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

        .product-price, .shipping-price {
            color: #ff69b4;
            font-weight: bold;
        }

        /* Order Summary */
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
    </style>
@endpush

@section('page_content')
    <div class="main-container">
        @php
            $product = $products->first();
            $shipping = $shippings->first();
        @endphp

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
        <div class="faq-section additional-faq">
            <div class="accordion" id="mainFaqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            শার্টিক ডায়াপার কি আপনার সন্তানের আরাম বেড়ে দিবে?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            উচ্চ মানের ওয়াশেবল ডায়াপার এখনই কিনুন
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            কেন আমাদের এখানের ডায়াপার নেবে?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            উচ্চ মানের সার্টিফিকেট বিশিষ্ট নরম হাতের কাজ করা সামগ্রী।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            লেয়ার সিস্টেম: কোনো লিকেজ নয়।
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            ডাবল সেলাই: পেশাব লিক হওয়ার ঝুঁকি নেই। প্যাড চেঞ্জ সিস্টেম: পুরো ডায়াপার চেঞ্জ করার দরকার নেই। কাস্টমাইজড বাটন: শিশুর মাপ অনুযায়ী সহজে সেট করুন।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4  -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            এটা কি সব বয়সের শিশুদের জন্য উপযোগী?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            হ্যাঁ, ০-৩ বছর বয়সের শিশুর জন্য সহজে মানানসই।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            কতদিন ব্যবহার করা যাবে?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            সঠিক যত্ন নিলে ৬-১২ মাস পর্যন্ত।
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Additional FAQ Section -->
        {{-- <div class="additional-faq">
            <div class="faq-item">এটি কি এক বারের জন্য ব্যবহারযোগ্য?</div>
            <div class="faq-item">কতদিন টিকে থাকে?</div>
        </div> --}}

        <!-- Video Section -->
        <div class="video-section">
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/92jIukxdaBo" allowfullscreen></iframe>
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

        <!-- Order Form -->
        <form action="{{route('order.store')}}" method="POST" id="orderForm">
            @csrf

            <!-- Product Selection -->
            @if($products->count() > 0)
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
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->title }}" class="product-image">
                                <div class="product-info">
                                    <div class="product-title">{{ $product->title }}</div>
                                    <div class="product-price">৳{{ number_format($product->price, 2) }}</div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Shipping Selection -->
            @if($shippings->count() > 0)
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
            @endif


            <!-- Order Summary -->
            <div class="order-summary">
                <h3>অর্ডার সামারি</h3>
                <div class="summary-item">
                    <span class="item-name">Selected Product:</span>
                    <span class="item-value" id="selectedProductName">{{ $product ? $product->title : '' }}</span>
                </div>
                <div class="summary-item">
                    <span>সাবটোটাল:</span>
                    <span id="subtotal">৳{{ number_format($product ? $product->price : 0, 2) }}</span>
                </div>
                <div class="summary-item">
                    <span>শিপিং:</span>
                    <span id="shipping-cost">{{ $shipping ? '৳ ' . number_format($shipping->price, 2) : 'Free' }}</span>
                </div>
                <div class="summary-item summary-total">
                    <span>টোটাল:</span>
                    <span id="total">৳{{ number_format(($product ? $product->price : 0) + ($shipping ? $shipping->price : 0), 2) }}</span>
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

                    <input type="hidden" id="productName" name="productName" value="{{ $product ? $product->title : '' }}">
                    <input type="hidden" id="productPrice" name="productPrice" value="{{ $product ? $product->price : 0 }}">
                    <input type="hidden" id="shippingCost" name="shippingCost" value="{{ $shipping ? $shipping->price : 0 }}">
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
            const selectedProduct = $('input[name="slug"]:checked');
            const selectedShipping = $('input[name="shipping_id"]:checked');

            // Get prices from the product-price and shipping-price divs
            let productPrice = 0;
            let shippingPrice = 0;

            if (selectedProduct.length) {
                productPrice = parseFloat(selectedProduct.closest('.product-option')
                    .find('.product-price').text().replace('৳', '').replace(',', '')) || 0;
            }

            if (selectedShipping.length) {
                shippingPrice = parseFloat(selectedShipping.closest('.shipping-option')
                    .find('.shipping-price').text().replace('৳', '').replace(',', '')) || 0;
            }

            if (isNaN(productPrice) || isNaN(shippingPrice)) {
                console.error('Invalid price values detected');
                return;
            }

            console.log('Product Price:', productPrice, 'Shipping Price:', shippingPrice);
            const total = productPrice + shippingPrice;

            $('#subtotal').text('৳' + productPrice.toFixed(2));
            $('#shipping-cost').text(shippingPrice === 0 ? 'Free' : '৳' + shippingPrice.toFixed(2));
            $('#total').text('৳' + total.toFixed(2));

            // Update hidden inputs
            $('#productPrice').val(productPrice);
            $('#shippingCost').val(shippingPrice);
        }

        // Handle product selection
        $('input[name="slug"]').change(function() {
            const productName = $(this).closest('.product-option').find('.product-title').text();
            $('#selectedProductName').text(productName);
            $('#productName').val(productName);
            updateTotal();
        });

        // Handle shipping selection
        $('input[name="shipping_id"]').change(function() {
            updateTotal();
        });

        $('.faq-question').click(function() {
            // Toggle active class on question
            $(this).toggleClass('active');

            // Toggle show class on answer
            $(this).next('.faq-answer').toggleClass('show');

            // Close other open FAQs (optional)
            $('.faq-question').not(this).removeClass('active');
            $('.faq-answer').not($(this).next()).removeClass('show');
        });
    });
</script>
@endpush

