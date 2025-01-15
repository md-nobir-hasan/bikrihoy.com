@extends('frontend.layouts.app')
@push('css')
    <style>
        .h25px{
            height: 25px;
        }
        .star-rating{
            color: #f39c12;
            width: 1.2rem;
        }
        .rating-div{
            column-gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
@endpush
@push('custom-js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

@push('custom-js')
    
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

        fbq('track', 'ViewContent', {
            content_name: '{{$data->title}}',
            content_ids: ['{{$data->id}}'],
            content_type: 'product',
            value: {{$data->price - $data->discount}},
            currency: 'BDT'
        });

        // Contact event for phone and WhatsApp
        $('.callBtn').on('click', function() {
                fbq('track', 'Contact', {
                    contact_type: $(this).hasClass('whatsappbnt') ? 'WhatsApp' : 'Phone'
                });
            });

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
                            <img class="leargeImgSingle @if($loop->first) active @endif" src="/{{$img->imageGallery->img}}" alt="{{$data->title}}" loading="eager">
                        @endforeach
                    </div>
                    <input type="hidden" name="color_id" id="color_id">
                    <div class="smallImgs">
                         @foreach ($data->productGallery as $simg)
                                <div class="smallSingle @if($loop->first) active @endif" id="{{$simg->color_id}}">
                                    <p class="pdsColor">{{$simg->color->c_name}}</p>
                                    <img src="/{{$simg->imageGallery->img}}" alt="{{$data->title}}" loading="eager">
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
                            <a class="callBtn" href="tel:{{$site_contact_info->phone}}">
                                <p class="callIndicate">কল করতে ক্লিক করুন</p>
                                <p>{{$site_info->phone}}</p>
                            </a>
                            <a class="callBtn whatsappbnt" href="https://wa.me/{{$site_contact_info->whatsapp}}">
                                <p class="callIndicate">হোয়াটসঅ্যাপ করুন</p>
                                <p>{{$site_info->whatsapp}}</p>
                            </a>
                        </div>

                        @if($data->productShipping->count()>0)
                        <div class="deliveryCharge">
                            <table class="table table-responsive table-bordered bg-light">
                                <thead>
                                    <tr>
                                        <th>লোকেশন</th>
                                        <th>ডেলিভারি চার্জ (৳)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->productShipping as $shipping)
                                        <tr>
                                            <td>{{$shipping->shipping->type}}</td>
                                            <td>&#2547;<span>{{$shipping->shipping->price}}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="sectionDevider">
                <div class="deviderBlue"></div>
            </div>


            <!-- Description  -->
            <div class="descriptionMain">
                <h3 class="descTitle">Description</h3>
                <p class="dParagraph my-3 my-lg-4">{!! $data->summary !!}</p>
            </div>
        </div>
    </form>
    </section>


    {{-- Review Section --}}
    @if ($specific_review || $global_review)
        <section class="reviewSection">
            <div class="container">
                <div class="reviewMain">
                    <h2 class="sub_title">Customer Review</h2>

                    <div class="reviewInner">

                        @if ($specific_review)
                            @foreach ( $specific_review->images as $image)
                                {{-- review Single --}}
                                <div class="reviewSingle">
                                    <img src="/storage/{{$image->image_path}}" alt="" loading="lazy">
                                </div>
                            @endforeach
                        @endif

                        @if ($global_review)
                            @foreach ( $global_review->images as $image)
                                {{-- review Single --}}
                                <div class="reviewSingle">
                                    <img src="/storage/{{$image->image_path}}" alt="" loading="lazy">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Product section -->
    <section class="production">
        <div class="container">
            <div class="productMain">
                <h2 class="sub_title">Related Products</h2>

                <div class="productBody">

                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 row-cols-xl-8 g-4">
                        @foreach ($related_products as $rproduct)
                            <div class="col">
                                <div class="card h-100">
                                    <a href="{{ route('product_details',[$rproduct->slug]) }}">
                                        <img src="/{{$rproduct->photo}}" class="card-img-top" alt="{{$rproduct->title}}" loading="lazy" >
                                        <div class="position-absolute top-0 end-0 m-2 badge bg-danger">
                                            {{round($rproduct->discount * 100 / $rproduct->price)}}% off
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <a href="{{route('product_details',[$rproduct->slug])}}" class="text-decoration-none">
                                            <h5 class="card-title">{{$rproduct->title}}</h5>
                                        </a>

                                        <div class="d-flex justify-content-center text-warning rating-div mb-2">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg class="star-rating" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                                </svg>
                                            @endfor
                                        </div>

                                        <div class="mb-2">
                                            @if($rproduct->stock>0)
                                                <div class="text-success d-flex align-items-center justify-content-center gap-1">
                                                    <svg class="h25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span>In stock</span>
                                                </div>
                                            @else
                                                <div class="text-danger d-flex align-items-center justify-content-center gap-1">
                                                    <svg class="h25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                        <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                                                    </svg>
                                                    <span>Out of stock</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-3 text-center">
                                            <del class="text-muted">&#2547; {{ $rproduct->price}}</del>
                                            <span class="ms-2 fw-bold">&#2547; {{ $rproduct->price - $rproduct->discount}}</span>
                                        </div>


                                    </div>
                                    <div class="card-footer">
                                        <a href="{{route('product_details',[$rproduct->slug])}}" class="btn btn-primary w-100">অর্ডার করুন</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>



@endsection

