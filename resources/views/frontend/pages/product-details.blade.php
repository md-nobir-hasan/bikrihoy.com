@extends('frontend.layouts.app')

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
                            <h2 class="sub_title">NAVIFORCE 9188 Man’s Premium Watch Blue</h2>
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
                                    <a href="{{route('checkout')}}" class="orderNow">অর্ডার করুন</a>
                                </button>
                                <button class="btn_primary ">
                                    <a href="{{route('checkout')}}" class="orderNow ">buy now</a>
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
                                    <tr>
                                        <td>ঢাকার মধ্যে়</td>
                                        <td>&#2547;70.00</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকার বাইরে</td>
                                        <td>&#2547;130.00</td>
                                    </tr>
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
                <p class="dParagraph my-3 my-lg-4">নিজেকে এবং প্রিয়জনকে উপহার দেয়ার জন্য “Exclusive Gift Box” হতে পারে প্রিমিয়াম কোয়ালিটির OLEVS 1005 মডেলের ডায়মন্ড কাট ডিজাইনের 100% Authentic  হাত ঘড়ি।</p>
                <p class="dParagraph">⌚ 5 বছর মেশিন  Replacement Guaranty</p>
                <p class="dParagraph">⌚ সাথে ১ বছর Color গ্যারান্টি পাবেন।</p>
                <p class="dParagraph">⌚ ১০০% ওয়াটার প্রুফ, ওজু করতে পারবেন।</p>
                <p class="dParagraph">⌚ চেইন ছোট করার মেশিন ফ্রি পাবেন।</p>
                <p class="dParagraph">⌚ ছবিতে দেখানো ঘড়িটাই আপনি হাতে পাবেন।</p>
                <p class="dParagraph">⌚ পছন্দ না হলে, সাথে সাথে ফেরত দিতে পারবেন।</p>
                <p class="dParagraph">⌚ অরিজিনাল এই ঘড়িটি সংগ্রহে রাখতে,অর্ডার করুন।</p>
                <p class="dParagraph">⌚ একটি টাকাও আপনাকে অগ্রিম দিতে হচ্ছে না।</p>
                <p class="dParagraph">⌚ ডেলিভারি ম্যানের সামনে চেক করে টাকা দিবেন।</p>
                <p class="dParagraph">⌚ ৩ দিনের মধ্যে হোম-ডেলিভারি পাবেন।</p>
            </div>
        </div>
    </section>

    <!-- Product section -->
    <section class="production">
        <div class="container">
            <div class="productMain">
                <h2 class="sub_title">Our Products</h2>

                <div class="productBody">

                    <!-- Product Single -->
                    <div class="productSingleMain">
                        <a href="{{route('product_details'[$data->slug])}}">
                            <div class="productSingle">
                                <div class="productImg">
                                    <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                    <div class="pDiscount">20% off</div>
                                </div>
                                <div class="productData">
                                    <a href="{{route('product_details'[$data->slug])}}" class="productTitle">NAVIFORCE 9188 Man’s Premium Watch Blue</a>
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
                                        <del>&#2547; 6500</del>
                                        <span>&#2547 4600</span>
                                    </div>
                                    <a href="{{route('product_details'[$data->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product Single -->
                    <div class="productSingleMain">
                        <a href="{{route('product_details'[$data->slug])}}">
                            <div class="productSingle">
                                <div class="productImg">
                                    <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                    <div class="pDiscount">20% off</div>
                                </div>
                                <div class="productData">
                                    <a href="{{route('product_details'[$data->slug])}}" class="productTitle">NAVIFORCE 9188 Man’s Premium Watch Blue</a>
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
                                        <del>&#2547; 6500</del>
                                        <span>&#2547 4600</span>
                                    </div>
                                    <a href="{{route('product_details'[$data->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product Single -->
                    <div class="productSingleMain">
                        <a href="{{route('product_details'[$data->slug])}}">
                            <div class="productSingle">
                                <div class="productImg">
                                    <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                    <div class="pDiscount">20% off</div>
                                </div>
                                <div class="productData">
                                    <a href="{{route('product_details'[$data->slug])}}" class="productTitle">NAVIFORCE 9188 Man’s Premium Watch Blue</a>
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
                                        <del>&#2547; 6500</del>
                                        <span>&#2547 4600</span>
                                    </div>
                                    <a href="{{route('product_details'[$data->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product Single -->
                    <div class="productSingleMain">
                        <a href="{{route('product_details'[$data->slug])}}">
                            <div class="productSingle">
                                <div class="productImg">
                                    <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                    <div class="pDiscount">20% off</div>
                                </div>
                                <div class="productData">
                                    <a href="{{route('product_details'[$data->slug])}}" class="productTitle">NAVIFORCE 9188 Man’s Premium Watch Blue</a>
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
                                        <del>&#2547; 6500</del>
                                        <span>&#2547 4600</span>
                                    </div>
                                    <a href="{{route('product_details'[$data->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product Single -->
                    <div class="productSingleMain">
                        <a href="{{route('product_details'[$data->slug])}}">
                            <div class="productSingle">
                                <div class="productImg">
                                    <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                    <div class="pDiscount">20% off</div>
                                </div>
                                <div class="productData">
                                    <a href="{{route('product_details'[$data->slug])}}" class="productTitle">NAVIFORCE 9188 Man’s Premium Watch Blue</a>
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
                                        <del>&#2547; 6500</del>
                                        <span>&#2547 4600</span>
                                    </div>
                                    <a href="{{route('product_details'[$data->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product Single -->
                    <div class="productSingleMain">
                        <a href="{{route('product_details'[$data->slug])}}">
                            <div class="productSingle">
                                <div class="productImg">
                                    <img class="pImgMain" src="/images/ignore/1.1-564x600.jpg" alt="">
                                    <div class="pDiscount">20% off</div>
                                </div>
                                <div class="productData">
                                    <a href="{{route('product_details'[$data->slug])}}" class="productTitle">NAVIFORCE 9188 Man’s Premium Watch Blue</a>
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
                                        <del>&#2547; 6500</del>
                                        <span>&#2547 4600</span>
                                    </div>
                                    <a href="{{route('product_details'[$data->slug])}}" class="btn_primary">অর্ডার করুন </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

