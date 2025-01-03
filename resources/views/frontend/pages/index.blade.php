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

        <!-- Product Selection -->
        <div class="product-selection">
            <h3>পণ্য নির্বাচন করুন</h3>
            <div class="product-option">
                <input type="radio" name="product" id="product1" value="650" class="product-radio" checked>
                <label for="product1" class="product-details">
                    <img src="/path-to-product-image-1.jpg" alt="Product 1" class="product-image">
                    <div class="product-info">
                        <div class="product-title">২টি ওয়াশেবল ডায়াপার প্যাক</div>
                        <div class="product-price">৳650.00</div>
                    </div>
                </label>
            </div>
            <div class="product-option">
                <input type="radio" name="product" id="product2" value="1150" class="product-radio">
                <label for="product2" class="product-details">
                    <img src="/path-to-product-image-2.jpg" alt="Product 2" class="product-image">
                    <div class="product-info">
                        <div class="product-title">৪টি ওয়াশেবল ডায়াপার প্যাক</div>
                        <div class="product-price">৳1,150.00</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Shipping Selection -->
        <div class="shipping-selection">
            <h3>ডেলিভারি চার্জ নির্বাচন করুন</h3>
            <div class="shipping-option">
                <input type="radio" name="shipping" id="shipping1" value="50" class="shipping-radio" checked>
                <label for="shipping1" class="shipping-details">
                    <div class="shipping-info">ঢাকার ভিতরে</div>
                    <div class="shipping-price">৳50</div>
                </label>
            </div>
            <div class="shipping-option">
                <input type="radio" name="shipping" id="shipping2" value="100" class="shipping-radio">
                <label for="shipping2" class="shipping-details">
                    <div class="shipping-info">ঢাকার বাহিরে</div>
                    <div class="shipping-price">৳100</div>
                </label>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3>অর্ডার সামারি</h3>
            <div class="summary-item">
                <span class="item-name">Selected Product:</span>
                <span class="item-value" id="selectedProductName">২টি ওয়াশেবল ডায়াপার প্যাক</span>
            </div>
            <div class="summary-item">
                <span>সাবটোটাল:</span>
                <span id="subtotal">৳650.00</span>
            </div>
            <div class="summary-item">
                <span>শিপিং:</span>
                <span id="shipping-cost">৳50.00</span>
            </div>
            <div class="summary-item summary-total">
                <span>টোটাল:</span>
                <span id="total">৳700.00</span>
            </div>
        </div>

        <!-- Order Form -->
        <div class="order-form">
            <h3>অর্ডার করতে নিচের ফরমটি পূরণ করুন</h3>
            <form id="orderForm">
                <div class="form-group">
                    <label class="form-label">আপনার নাম</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">মোবাইল নাম্বার</label>
                    <input type="tel" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">সম্পূর্ণ ঠিকানা</label>
                    <textarea class="form-control" rows="3" required></textarea>
                </div>
                <input type="hidden" id="productName" name="productName" value="২টি ওয়াশেবল ডায়াপার প্যাক">
                <input type="hidden" id="productPrice" name="productPrice" value="650">
                <input type="hidden" id="shippingCost" name="shippingCost" value="50">
                <button type="submit" class="cta-button">অর্ডার কনফার্ম করুন</button>
            </form>
        </div>

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
            e.preventDefault();
            // Add your form submission logic here
        });

        function updateTotal() {
            const selectedPrice = $('input[name="product"]:checked').val();
            const shippingCost = $('input[name="shipping"]:checked').val();
            const total = parseInt(selectedPrice) + parseInt(shippingCost);

            $('#subtotal').text('৳' + selectedPrice + '.00');
            $('#shipping-cost').text('৳' + shippingCost + '.00');
            $('#total').text('৳' + total + '.00');

            // Update hidden inputs
            $('#shippingCost').val(shippingCost);
        }

        // Handle product selection
        $('input[name="product"]').change(function() {
            const productName = $(this).siblings('label').find('.product-title').text();
            $('#selectedProductName').text(productName);
            $('#productName').val(productName);
            $('#productPrice').val($(this).val());
            updateTotal();
        });

        // Handle shipping selection
        $('input[name="shipping"]').change(function() {
            updateTotal();
        });
    });
</script>
@endpush

