@extends('frontend.layouts.app')


@push('custom-js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

@push('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush

@section('page_conent')
 <section class="productdetailsSection">
        <div class="container">
            <div class="sectionDevider top">
            </div>
            <div class="productDetailsMain row">

                <!-- product photo -->
                <div class="pdLeft col-lg-6">
                    <div class="leargeImage">
                        <img class="leargeImgSingle active" src="/images/ignore/33348dd258bd20590a1884dc713d3c4c-qtw2tf5q08k1x4rr2acgr3i9g8e4rzb3yv8wsiq126.jpg" alt="">
                        <img class="leargeImgSingle" src="/images/ignore/NAVIFORCE-NF9189-Stainless-Watch-2-1-qtw1pd9asdq77ay6xz2ri7d675t2saav4mi2m23y72.jpg" alt="">
                        <img class="leargeImgSingle" src="/images/ignore/613-qtw2wh4u7uqlnic083vtctr6ybc2skfpdzkpxw6yu6.png" alt="">
                        <img class="leargeImgSingle" src="/images/ignore/6c675298dca25a1d6afd88aa6e505405-qtw1pv48e8enbw891osobkuxhhd1uj9rj2waqbdgwu.jpg" alt="">
                        <img class="leargeImgSingle" src="/images/ignore/org-1-qpf44q91lezfs4j9b16atrvclm2yhj9flphjlkwr8e.jpg" alt="">
                        <img class="leargeImgSingle" src="/images/ignore/org-10-qpf45bvbylt175nussipx4ey9h4eekn9cohpmy0p9a.jpg" alt="">
                    </div>
                    <div class="smallImgs">
                       <div class="smallSingle active">
                        <p class="pdsColor">Black</p>
                        <img src="/images/ignore/33348dd258bd20590a1884dc713d3c4c-qtw2tf5q08k1x4rr2acgr3i9g8e4rzb3yv8wsiq126.jpg" alt="">
                       </div>
                       <div class="smallSingle">
                        <p class="pdsColor">Black</p>
                        <img src="/images/ignore/NAVIFORCE-NF9189-Stainless-Watch-2-1-qtw1pd9asdq77ay6xz2ri7d675t2saav4mi2m23y72.jpg" alt="">
                       </div>
                       <div class="smallSingle">
                        <p class="pdsColor">Black</p>
                        <img src="/images/ignore/613-qtw2wh4u7uqlnic083vtctr6ybc2skfpdzkpxw6yu6.png" alt="">
                       </div>
                       <div class="smallSingle">
                        <p class="pdsColor">Black</p>
                        <img src="/images/ignore/6c675298dca25a1d6afd88aa6e505405-qtw1pv48e8enbw891osobkuxhhd1uj9rj2waqbdgwu.jpg" alt="">
                       </div>
                       <div class="smallSingle">
                        <p class="pdsColor">Black</p>
                        <img src="/images/ignore/org-1-qpf44q91lezfs4j9b16atrvclm2yhj9flphjlkwr8e.jpg" alt="">
                       </div>
                       <div class="smallSingle">
                        <p class="pdsColor">Black</p>
                        <img src="/images/ignore/org-10-qpf45bvbylt175nussipx4ey9h4eekn9cohpmy0p9a.jpg" alt="">
                       </div>

                    </div>
                </div>

                <!-- product data -->
                <div class="pdRight col-lg-6">
                    <div class="pdrightInner">
                        <form action="#" class="orderForm">
                            <h2 class="sub_title">{{$data->title}}</h2>
                            <div class="priceDetails">
                                <del>&#2547;6500</del>
                                <span>&#2547;4600</span>
                            </div>

                            <div class="orderAndContity">
                                <div class="contity">

                                    <input class="minusBtn" type="button" value="-">
                                    <input class="countShow" type="number" min="1" value="1">
                                    <input class="plusBtn" type="button" value="+">
                                </div>
                                <button class="btn_primary whatapp">
                                    <a href="{{route('checkout',[$data->slug])}}" class="orderNow">অর্ডার করুন</a>
                                </button>
                                <button class="btn_primary ">
                                    <a href="{{route('checkout',[$data->slug])}}" class="orderNow ">buy now</a>
                                </button>
                            </div>
                        </form>

                        <!-- Call btn -->
                        <div class="callBtns">
                            <a class="callBtn" href="tel: +880 1518-460933">
                                <p class="callIndicate">কল করতে ক্লিক করুন</p>
                                <p>+880 1518-460933</p>
                            </a>
                            <a class="whatsappbnt" href="tel: +880 1518-460933">
                                <p class="callIndicate">হোয়াটসঅ্যাপ করুন</p>
                                <p>+880 1518-460933</p>
                            </a>
                        </div>

                        <div class="deliveryCharge">
                            <table class="table table-responsive table-bordered bg-light">
                                <thead>
                                    <tr>
                                        <th>লোকেশন</th>
                                        <th>ডেলিভারি চার্জ (৳)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shippings as $shipping)
                                        <tr>
                                        <td>{{$shipping->type}}</td>
                                        <td>&#2547;<span>{{$shipping->price}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sectionDevider">
                <div class="deviderBlue"></div>
            </div>


            <!-- Description  -->
            <div class="descriptionMain">
                <h3 class="descTitle">Description</h3>
                <p class="dParagraph my-3 my-lg-4">{!! $data->description !!}</div>
        </div>
    </section>

    <!-- Product section -->
    <section class="production">
        <div class="container">
            <div class="productMain">
                <h2 class="sub_title">Our Products</h2>

                <div class="productBody">

                    @foreach ($related_products as $rproduct)

                        <div class="productSingleMain">
                            <div class="productSingle">
                                <a href="{{route('product_details',[$rproduct->slug])}}">
                                    <div class="productImg">
                                        <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                        <div class="pDiscount">{{$rproduct->discount}}% off</div>
                                    </div>
                                </a>
                                <div class="productData">
                                    <a href="{{route('product_details',[$rproduct->slug])}}" class="productTitle">{{$rproduct->title}}</a>
                                    <div class="productRating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="productStockavility">
                                        <div class="inStock stokcSingle">
                                            <i class="fa-solid fa-check"></i>
                                            <h4 class="inStock">In stock</h4>
                                        </div>
                                        <div class="outStock stokcSingle">
                                            <i class="fa-solid fa-xmark"></i>
                                            <h4 class="inStock">Out of stock</h4>
                                        </div>
                                    </div>
                                    <div class="productPrice">
                                        <del>&#2547; {{$rproduct->price}}</del>
                                        <span>&#2547 {{$rproduct->price - $rproduct->discount}}</span>
                                    </div>
                                    <a href="{{route('product_details',[$rproduct->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

