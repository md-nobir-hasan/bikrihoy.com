@extends('frontend.layouts.app')

@push('css')
    <style>
        /* Common Styles */
        .section-title {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 3rem;
        }

        /* Hero Section */
        .hero-section {
            background: #f8f9fa;
            padding: 4rem 0;
            text-align: center;
        }

        .hero-title {
            font-size: 2.2rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: #555;
            margin-bottom: 2rem;
        }

        /* Why Choose Us Section */
        .why-choose-section {
            padding: 4rem 0;
            background: #fff;
        }

        .choose-card {
            text-align: center;
            margin-bottom: 2rem;
        }

        .choose-icon {
            font-size: 3rem;
            color: #2ecc71;
            margin-bottom: 1rem;
        }

        /* Problem Solution Section */
        .problem-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }

        .problem-card {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        /* Features Section */
        .features-section {
            padding: 4rem 0;
            background: #fff;
        }

        .feature-box {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        /* Product Benefits */
        .benefits-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .benefit-icon {
            color: #2ecc71;
            margin-right: 1rem;
        }

        /* Products Section */
        .products-section {
            padding: 4rem 0;
            background: #fff;
        }

        .product-card {
            border: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: relative;
        }

        .discount-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        /* Usage Guide */
        .usage-guide {
            padding: 4rem 0;
            background: #f8f9fa;
        }

        .guide-step {
            text-align: center;
            margin-bottom: 2rem;
        }

        /* FAQ Section */
        .faq-section {
            padding: 4rem 0;
            background: #fff;
        }

        .accordion-button:not(.collapsed) {
            background-color: #2ecc71;
            color: white;
        }

        /* CTA Sections */
        .cta-section {
            background: #e74c3c;
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .btn-cta {
            background: #2ecc71;
            color: white;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            background: #27ae60;
            color: white;
            transform: translateY(-2px);
        }

        /* Customer Reviews */
        .reviews-section {
            padding: 4rem 0;
            background: #f8f9fa;
        }

        .review-card {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        /* Free Shipping Banner */
        .free-shipping {
            background: #f1c40f;
            color: #2c3e50;
            padding: 0.5rem;
            text-align: center;
            font-weight: bold;
        }
    </style>
@endpush

@section('page_conent')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">আপনার সিশুর জন্য সেরা ওয়াশেবল ডায়াপার</h1>
            <p class="hero-subtitle">নিরাপদ, আরামদায়ক এবং পরিবেশবান্ধব সমাধান</p>
            <a href="#products" class="btn-cta">এখনই অর্ডার করুন - ২০% ছাড়!</a>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-section">
        <div class="container">
            <h2 class="section-title">কেন আমাদের পণ্য বেছে নেবেন?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="choose-card">
                        <div class="choose-icon">🌿</div>
                        <h3>পরিবেশবান্ধব</h3>
                        <p>প্লাস্টিক ডায়াপার থেকে পরিবেশকে রক্ষা করুন</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="choose-card">
                        <div class="choose-icon">💰</div>
                        <h3>সাশ্রয়ী</h3>
                        <p>দীর্ঘমেয়াদী ব্যবহারে অর্থ সাশ্রয় করুন</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="choose-card">
                        <div class="choose-icon">👶</div>
                        <h3>শিশুর জন্য নিরাপদ</h3>
                        <p>১০০% নিরাপদ ও আরামদায়ক</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem Solution Section -->
    <section class="problem-section">
        <div class="container">
            <h2 class="section-title">আপনার সমস্যার সমাধান</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="problem-card">
                        <h3>সমস্যা</h3>
                        <ul class="list-unstyled">
                            <li>✗ ডিসপোজেবল ডায়াপারের উচ্চ খরচ</li>
                            <li>✗ ত্বকের সমস্যা</li>
                            <li>✗ পরিবেশ দূষণ</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="problem-card">
                        <h3>সমাধান</h3>
                        <ul class="list-unstyled">
                            <li>✓ একবার কিনুন, দীর্ঘদিন ব্যবহার করুন</li>
                            <li>✓ নরম কাপড়ের তৈরি, ত্বকের জন্য নিরাপদ</li>
                            <li>✓ পুনঃব্যবহারযোগ্য, পরিবেশবান্ধব</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">বিশেষ বৈশিষ্ট্য</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>উন্নত ফেব্রিক</h3>
                        <p>১০০% কটন ফেব্রিক, শিশুর ত্বকের জন্য নিরাপদ</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>৪-লেয়ার সিস্টেম</h3>
                        <p>লিকেজ প্রতিরোধী উন্নত লেয়ার সিস্টেম</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>ইলাস্টিক ফিটিং</h3>
                        <p>পারফেক্ট ফিটিং নিশ্চিত করে</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products-section">
        <div class="container">
            <h2 class="section-title">আমাদের প্যাকেজসমূহ</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <img src="{{$product->photo}}" class="card-img-top" alt="{{$product->title}}">
                            <div class="discount-badge">{{$product->discountPercent()}}% ছাড়!</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <div class="price-section mb-3">
                                    <del class="text-muted">৳{{$product->price}}</del>
                                    <span class="ms-2 fw-bold">৳{{$product->price - $product->discount}}</span>
                                </div>
                                <a href="{{route('product_details',[$product->slug])}}" class="btn-cta w-100">অর্ডার করুন</a>
                            </div>
                            <div class="free-shipping">
                                সারা বাংলাদেশে ফ্রি হোম ডেলিভারি 🚙
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Usage Guide -->
    <section class="usage-guide">
        <div class="container">
            <h2 class="section-title">ব্যবহার পদ্ধতি</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="guide-step">
                        <h3>১. ধোয়া</h3>
                        <p>সাবান দিয়ে ভালোভাবে ধুয়ে নিন</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="guide-step">
                        <h3>২. শুকানো</h3>
                        <p>রোদে ভালোভাবে শুকিয়ে নিন</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="guide-step">
                        <h3>৩. ব্যবহার</h3>
                        <p>পুনরায় ব্যবহার করুন</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">সাধারণ জিজ্ঞাসা</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            কতদিন ব্যবহার করা যাবে?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            সঠিকভাবে ব্যবহার করলে ৬-১২ মাস পর্যন্ত ব্যবহার করা যায়।
                        </div>
                    </div>
                </div>
                <!-- Add more FAQ items as needed -->
            </div>
        </div>
    </section>

    <!-- Customer Reviews -->
    <section class="reviews-section">
        <div class="container">
            <h2 class="section-title">গ্রাহকদের মতামত</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                        <p>"খুবই ভালো প্রোডাক্ট, আমার বাচ্চা খুব আরামে থাকে"</p>
                        <small>- সাবরিনা আক্তার</small>
                    </div>
                </div>
                <!-- Add more review cards -->
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="mb-4">এখনই অর্ডার করুন এবং পান ২০% ছাড়!</h2>
            <p class="mb-4">সীমিত সময়ের জন্য বিশেষ অফার</p>
            <a href="#products" class="btn-cta">অর্ডার করুন</a>
        </div>
    </section>
@endsection

@push('custom-js')
<script>
    $(document).ready(function() {
        // Smooth scroll
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $($(this).attr('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 70
                }, 1000);
            }
        });
    });
</script>
@endpush

