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

@section('page_conent')
    <section class="sliderSection">
        <div class="sliderMain">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($sliders as $slider)
                        <div class="carousel-item @if($loop->index) active @endif">
                            <img src="{{$slider->image}}" class="d-block w-100" alt="{{$site_info->title}}" loading="eager">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </section>

    <!-- Product section -->
    <section class="production">
        <div class="container">
            <div class="productMain">
                <h2 class="sub_title">Our Products</h2>

                <div class="productBody">
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 row-cols-xl-8 g-4">
                        @foreach ($products as $product)
                            <div class="col">
                                <div class="card h-100">
                                    <a href="{{ route('product_details',[$product->slug]) }}">
                                        <img src="{{$product->photo}}" class="card-img-top" alt="{{$product->title}}" loading="lazy">
                                        <div class="position-absolute top-0 end-0 m-2 badge bg-danger">
                                            {{$product->discountPercent()}}% off
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <a href="{{route('product_details',[$product->slug])}}" class="text-decoration-none">
                                            <h5 class="card-title">{{$product->title}}</h5>
                                        </a>

                                        <div class="d-flex text-warning mb-2 justify-content-center rating-div">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg class="star-rating" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                                </svg>
                                            @endfor
                                        </div>

                                        <div class="mb-2">
                                            @if($product->stock>0)
                                                <div class="text-success d-flex align-items-center gap-1 justify-content-center">
                                                    <svg class="h25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span>In stock</span>
                                                </div>
                                            @else
                                                <div class="text-danger d-flex align-items-center gap-1 justify-content-center">
                                                    <svg class="h25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                        <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                                                    </svg>
                                                    <span>Out of stock</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-3 text-center">
                                            <del class="text-muted">&#2547; {{ $product->price}}</del>
                                            <span class="ms-2 fw-bold">&#2547; {{ $product->price - $product->discount}}</span>
                                        </div>


                                    </div>
                                    <div class="card-footer">
                                        <a href="{{route('product_details',[$product->slug])}}" class="btn btn-primary w-100">অর্ডার করুন</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class='text-center facebookDesign'>
        <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=61569026849619" data-tabs="timeline" data-width="300" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=61569026849619" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=61569026849619">Learn with learner</a></blockquote></div>
    </section> --}}




@endsection

