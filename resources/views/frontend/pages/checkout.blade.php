@extends('frontend.layouts.app')

@push('css')
    <style>
        .payment-methods {
            margin: 25px 0;
        }

        .payment-method {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .payment-header {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
        }

        .payment-label {
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            flex: 1;
        }

        .payment-logo {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .payment-title {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .payment-details {
            padding: 20px;
        }

        .payment-info-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .info-header i {
            color: #2196F3;
        }

        .send-money-text {
            font-size: 18px;
            color: #2196F3;
            margin: 0;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding: 10px;
            background: #fff;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }

        .info-label {
            color: #666;
            min-width: 120px;
        }

        .info-value {
            font-weight: 500;
            color: #333;
            flex: 1;
        }

        .info-value.amount {
            color: #2196F3;
            font-size: 18px;
        }

        .copy-btn {
            padding: 5px 10px;
            border: none;
            background: #e3f2fd;
            color: #2196F3;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .copy-btn:hover {
            background: #2196F3;
            color: #fff;
        }

        .transaction-input {
            margin-top: 20px;
        }

        .transaction-input label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .hint {
            display: block;
            color: #666;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #2196F3;
            outline: none;
        }

        .payment-steps {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .payment-steps h5 {
            color: #333;
            margin-bottom: 15px;
        }

        .payment-steps ol {
            padding-left: 20px;
        }

        .payment-steps li {
            color: #666;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .required {
            color: #f44336;
            margin-left: 4px;
        }

        .payment-section {
            margin: 30px 0;
        }

        .payment-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .header-number {
            width: 30px;
            height: 30px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .payment-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .method-selection {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
            gap: 15px;
        }

        .radio-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .radio-wrapper input[type="radio"] {
            width: 20px;
            height: 20px;
            margin: 0;
            cursor: pointer;
        }

        .method-logo {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex: 1;
        }

        .method-logo img {
            height: 40px;
            width: auto;
        }

        .method-name {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .send-money-title {
            color: #0d6efd;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .payment-info-row {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 12px 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .payment-info-row label {
            color: #666;
            font-size: 14px;
        }

        .info-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-content span {
            font-weight: 500;
            color: #333;
        }

        .copy-btn {
            background: #e3f2fd;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            color: #0d6efd;
            cursor: pointer;
        }

        .copy-btn:hover {
            background: #0d6efd;
            color: white;
        }

        .transaction-input {
            margin-top: 25px;
        }

        .transaction-input label {
            display: block;
            color: #333;
            margin-bottom: 5px;
        }

        .required {
            color: red;
        }

        .hint {
            display: block;
            color: #666;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .shipping-options-container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border: 1px solid #e0e0e0;
        }

        .shipping-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .shipping-header i {
            color: #0d6efd;
            font-size: 20px;
        }

        .shipping-header h4 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .shipping-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .shipping-method-card {
            position: relative;
        }

        .shipping-method-card input[type="radio"] {
            display: none;
        }

        .shipping-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .shipping-method-card input[type="radio"]:checked + .shipping-label {
            border-color: #0d6efd;
            background: #f8f9ff;
        }

        .shipping-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .shipping-type {
            font-weight: 500;
            color: #333;
            font-size: 15px;
        }

        .shipping-price {
            color: #0d6efd;
            font-weight: 600;
            font-size: 16px;
        }

        .shipping-radio-mark {
            width: 20px;
            height: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            transition: all 0.3s ease;
        }

        .shipping-method-card input[type="radio"]:checked + .shipping-label .shipping-radio-mark {
            border-color: #0d6efd;
        }

        .shipping-method-card input[type="radio"]:checked + .shipping-label .shipping-radio-mark::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background: #0d6efd;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .verification-options {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
        }

        .verification-options h5 {
            margin-bottom: 15px;
            color: #333;
            font-size: 16px;
        }

        .verification-option {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .verification-option:hover {
            border-color: #0d6efd;
            background: #f8f9ff;
        }

        .verification-option input[type="radio"] {
            display: none;
        }

        .option-label {
            display: block;
            cursor: pointer;
            width: 100%;
        }

        .option-title {
            display: block;
            font-weight: 500;
            color: #333;
            margin-bottom: 10px;
        }

        .file-upload-wrapper,
        .number-input-wrapper {
            margin-top: 10px;
        }

        .verification-option input[type="radio"]:checked + .option-label {
            color: #0d6efd;
        }

        .verification-option input[type="radio"]:checked + .option-label .form-control {
            border-color: #0d6efd;
        }

        .verification-option input[type="file"] {
            padding: 8px;
            border: 2px dashed #e0e0e0;
            background: #f8f9fa;
        }

        .verification-option input[type="file"]:hover {
            border-color: #0d6efd;
        }

        .hint {
            display: block;
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }

        #image-preview {
            position: relative;
            display: inline-block;
            margin-top: 10px;
        }

        #image-preview img {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .remove-preview {
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .d-none {
            display: none !important;
        }
    </style>
@endpush

@push('custom-js')
    <script>
        $(document).ready(function () {

            // $('.payment-details').hide();

            // $('input[name="payment_method"]').on('change', function() {
            //     $('.payment-details').hide();
            //     $('#' + $(this).val() + '-details').show();
            // });

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

        // Handle verification method change



        // Handle file input change and image preview
        $('#payment_screenshot').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').removeClass('d-none');
                    $('#image-preview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                $('#bKash_nagad_number').prop('required', false);
            }
        });

        // Handle remove preview button
        $('.remove-preview').on('click', function() {
            $('#payment_screenshot').val('');
            $('#image-preview').addClass('d-none');
            $('#image-preview img').attr('src', '');
        });

        // Initial state setup
        $('#payment_screenshot').prop('required', false);
        $('#bKash_nagad_number').prop('required', true);
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
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="checkoutMain">
                <!-- main form -->
                 <form action="{{route('order.store')}}" method="POST" class="multiple-submit-prevent ckeckoutForm" enctype="multipart/form-data">
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

                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><strong>৳ <span class="total"></span></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        @if($product->productShipping->count() > 0)
                            <div class="shipping-options-container">
                                <div class="shipping-header">
                                    <i class="fas fa-truck"></i>
                                    <h4>Shipping Method</h4>
                                </div>
                                <div class="shipping-methods">
                                    @foreach ($product->productShipping as $shipping)
                                        <div class="shipping-method-card">
                                            <input type="radio"
                                                   name="shipping_id"
                                                   id="{{$shipping->shipping->price}}"
                                                   class="shipping-option"
                                                   value="{{$shipping->shipping_id}}"
                                                   checked>
                                            <label for="{{$shipping->shipping->price}}" class="shipping-label">
                                                <div class="shipping-info">
                                                    <span class="shipping-type">{{$shipping->shipping->type}}</span>
                                                    <span class="shipping-price">৳ {{$shipping->shipping->price}}</span>
                                                </div>
                                                <div class="shipping-radio-mark"></div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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


                        <div class="pamentInfoMain mt-5">
                            <div class="address">
                                <span class="numberCountBill">2.</span>
                                <h3 class="addressTitle">Payment Information</h3>
                            </div>

                            <!-- Make Payment -->
                            <div class="payment-section">
                                <!-- Payment Method Card -->
                                <div class="payment-card">
                                    <!-- Payment Method Selection -->
                                    <div class="method-selection">
                                        <div class="radio-wrapper">
                                            <input type="radio" checked name="payment_method" id="mobile_banking" value="mobile_banking">
                                            <span class="radio-circle"></span>
                                        </div>
                                        <div class="method-logo">
                                            <img src="{{ asset('images/default/bkash-nagad.jpg') }}" alt="bKash Nagad">
                                            <span class="method-name">Mobile Banking</span>
                                        </div>
                                    </div>

                                    <!-- Payment Details -->
                                    <div class="payment-details" id="mobile_banking-details">
                                        <h4 class="send-money-title">Pay via Send Money</h4>

                                        <!-- Payment Number -->
                                        <div class="payment-info-row">
                                            <label>Payment Number:</label>
                                            <div class="info-content">
                                                <span>01781666859</span>
                                                <button class="copy-btn" onclick="copyToClipboard('01781666859')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Amount -->
                                        <div class="payment-info-row">
                                            <label>Amount to Pay:</label>
                                            <div class="info-content">
                                                <span>৳ <span class="total"></span></span>
                                                <button class="copy-btn" onclick="copyToClipboard(document.querySelector('.total').textContent)">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>

                                         <!-- Payment Verification -->
                                         <div class="transaction-input">
                                            <div class="verification-options">
                                                <h5>Payment Verification (Choose one option)</h5>

                                                <!-- Option 1: Upload Screenshot -->
                                                <div class="verification-option">
                                                    <input type="radio" name="verification_method" id="upload_screenshot" value="screenshot">
                                                    <label for="upload_screenshot" class="option-label">
                                                        <span class="option-title">Upload Payment Screenshot</span>
                                                        <div class="file-upload-wrapper">
                                                            <input type="file"
                                                                   name="payment_screenshot"
                                                                   id="payment_screenshot"
                                                                   class="form-control"
                                                                   accept="image/*">
                                                            <div id="image-preview" class="mt-2 d-none">
                                                                <img src="" alt="Preview" style="max-width: 200px; max-height: 200px;">
                                                                <button type="button" class="btn btn-sm btn-danger remove-preview">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                            <small class="hint">Upload your bKash/Nagad payment screenshot (Recommended)</small>
                                                        </div>
                                                    </label>
                                                </div>

                                                <!-- Option 2: Enter Number -->
                                                <div class="verification-option">
                                                    <input type="radio" name="verification_method" id="enter_number" value="number" checked>
                                                    <label for="enter_number" class="option-label">
                                                        <span class="option-title">Enter Payment Number</span>
                                                        <div class="number-input-wrapper">
                                                            <input type="text"
                                                                   name="payment_number"
                                                                   id="bKash_nagad_number"
                                                                   class="form-control"
                                                                   placeholder="Example: 01518460933">
                                                            <small class="hint">Enter your bKash/Nagad number from which payment has been done</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <p class="paragraph">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></p>
                            <button class="btn_primary w-100">Place Order</button>
                        </div>
                    </div>

                 </form>
            </div>
        </div>
    </section>
@endsection

