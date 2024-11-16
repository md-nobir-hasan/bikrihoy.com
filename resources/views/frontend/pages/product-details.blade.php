@extends('frontend.layouts.app')

@push('custom-js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

@push('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
       $(document).ready(function(){
         $('.smallSingle').each(function(){
            let id = $(this).attr('id');
            $('#color_id').val(id);
        })

         $('.smallSingle').on('click',function(){
            let id = $(this).attr('id');
            $('#color_id').val(id);
        })
       })
    </script>
@endpush

@section('page_conent')
 <section class="productdetailsSection">
        <form action="{{route('checkout',[$data->slug])}}" method="GET" class="orderForm">
        <div class="container">
            <div class="sectionDevider top">
            </div>
            <div class="productDetailsMain row">
                <div class="pdLeft col-lg-6">
                    <div class="leargeImage">
                        @foreach ($data->productGallery as $img)
                            <img class="leargeImgSingle @if($loop->first) active @endif" src="/{{$img->imageGallery->img}}" alt="{{$data->title}}">
                        @endforeach
                    </div>
                    <input type="hidden" name="color_id" id="color_id">
                    <div class="smallImgs">
                         @foreach ($data->productGallery as $simg)
                                <div class="smallSingle @if($loop->first) active @endif" id="{{$simg->color_id}}">
                                    <p class="pdsColor">{{$simg->color->c_name}}</p>
                                    <img src="/{{$simg->imageGallery->img}}" alt="{{$data->title}}">
                                </div>

                        @endforeach
                    </div>
                </div>

                <!-- product data -->
                <div class="pdRight col-lg-6">
                    <div class="pdrightInner">

                            <h2 class="sub_title">{{$data->title}}</h2>
                            <div class="priceDetails">
                                <del class="originalPrice" data-price="6500">&#2547;{{$data->price}}</del>
                                <span class="discountPrice" data-price="4600">&#2547;{{$data->price - $data->discount}}</span>
                            </div>

                            <div class="orderAndContity">
                                <div class="contity">

                                    <input class="minusBtn" type="button" value="-">
                                    <input class="countShow" name="qty" type="number" min="1" value="1">
                                    <input class="plusBtn" type="button" value="+">
                                </div>
                                <button class="btn_primary whatapp orderNow order-now-button-track">
                                    অর্ডার করুন
                                </button>
                                <button class="btn_primary orderNow order-now-button-track">
                                    buy now
                                </button>
                            </div>

                        <!-- Call btn -->
                        <div class="callBtns">
                            <a class="callBtn" href="tel:{{$site_info->phone}}">
                                <p class="callIndicate">কল করতে ক্লিক করুন</p>
                                <p>{{$site_info->phone}}</p>
                            </a>
                            <a class="callBtn whatsappbnt" href="https://wa.me/{{$site_info->whatsapp}}">
                                <p class="callIndicate">হোয়াটসঅ্যাপ করুন</p>
                                <p>{{$site_info->whatsapp}}</p>
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
    </form>
    </section>

    {{-- Review Section --}}
    <section class="reviewSection">
        <div class="container">
            <div class="reviewMain">
                <h2 class="sub_title">Customer Review</h2>

                <div class="reviewInner">
                    @forelse($data->reviews()->where('is_active', true)->get() as $review)
                        <div class="reviewSingle">
                            <div class="reviewHeader">
                                @if($review->reviewer_image)
                                    <img src="{{ asset('storage/'.$review->reviewer_image) }}" alt="{{ $review->reviewer_name }}">
                                @endif
                                <div class="reviewInfo">
                                    <h4>{{ $review->reviewer_name }}</h4>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fa fa-star text-warning"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="reviewContent">
                                <p>{{ $review->review_text }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p>No reviews yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
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
                                        <img class="pImgMain" src="/{{$rproduct->photo}}" alt="">
                                        <div class="pDiscount">{{round($rproduct->discount * 100 / $rproduct->price)}}% off</div>
                                    </div>
                                </a>
                                <div class="productData">
                                    <a href="{{route('product_details',[$rproduct->slug])}}" class="productTitle">{{$rproduct->title}}</a>
                                    <div class="productRating">
                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="productStockavility">
                                        @if ($data->stock>0)
                                            <div class="inStock stokcSingle">
                                                <i class="fa-solid fa-check"></i>
                                                <h4 class="inStock">In stock</h4>
                                            </div>
                                        @else
                                            <div class="outStock stokcSingle">
                                                <i class="fa-solid fa-xmark"></i>
                                                <h4 class="inStock">Out of stock</h4>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="productPrice">
                                        <del>&#2547; {{$rproduct->price}}</del>
                                        <span>&#2547 {{$rproduct->price - $rproduct->discount}}</span>
                                    </div>
                                    <a href="{{route('product_details',[$rproduct->slug])}}" class="btn_primary order-now-button-track">অর্ডার করুন </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

