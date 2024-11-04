@extends('frontend.layouts.app')

@section('page_conent')
 <section class="sliderSection">
        <div class="sliderMain">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/images/ignore/slider/template_120329-1093.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/images/ignore/slider/design_620665.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/images/ignore/slider/vector_866431-88.jpg" class="d-block w-100" alt="...">
                  </div>
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

                    <!-- Product Single -->
                    @foreach ($products as $product)
                        <div class="productSingleMain">
                            <a href="{{route('product_details')}}">
                                <div class="productSingle">
                                    <div class="productImg">
                                        <img class="pImgMain" src="/storage/{{$product->photo}}" alt="{{$product->title}}">
                                        <div class="pDiscount">{{$product->discount}}% off</div>
                                    </div>
                                    <div class="productData">
                                        <a href="{{route('product_details')}}" class="productTitle">{{$product->title}}</a>
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
                                        <a href="{{route('product_details')}}" class="btn_primary">অর্ডার করুন </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

