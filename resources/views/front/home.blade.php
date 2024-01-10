@extends('front.layouts.app')

@section('content')
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
             data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <picture>
                        <source media="(max-width: 799px)"
                                srcset="{{ asset('front-assets/images/page1.jpg') }}"/>
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/page1.jpg') }}"/>
                        <img src="{{ asset('front-assets/images/carousel-1.jpg') }}" alt=""/>
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet
                                amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(max-width: 799px)"
                                srcset="{{ asset('front-assets/images/carousel-2-m.jpg') }}"/>
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-2.jpg') }}"/>
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt=""/>
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet
                                amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2" >
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Sản phẩm chất lượng</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-truck text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Miễn phí Ship</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14 Ngày trả hàng</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Thể loại</h2>
            </div>
            <div class="row pb-3">
                @if (getCategories()->isNotEmpty())
                    @foreach (getCategories() as $category)
                        <div class="col-lg-3 ">
                            <a href="{{ route('front.shop', $category->slug) }}">
                                <div class="box bg-white text-center">
                                    <h2 class="font-weight-semi-bold m-0 btn-outline-dark">{{ $category->name }}</h2>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Sản phẩm nổi bật</h2>
            </div>
            <div class="row pb-3">
                @if ($featuredProducts->isNotEmpty())
                    @foreach ($featuredProducts as $product)
                        @php
                            $productImage = $product->product_images->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                        @if (!empty($productImage->image))
                                            <img class="card-img-top"
                                                 src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                        @else
                                            <img class="card-img-top"
                                                 src="{{ asset('admin-assets/img/default-150x150.png') }}">
                                        @endif
                                    </a>
                                    <div class="product-action">
                                        @if($product->track_qty == 'Yes')
                                            @if($product->qty > 0)
                                                <a class="btn btn-dark" href="javascript:void(0);"
                                                   onclick="addToCart({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                </a>
                                            @else
                                                <a class="btn btn-dark" href="javascript:void(0);">
                                                    Hết hàng
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-dark" href="javascript:void(0);">
                                                Cửa hàng chưa nhập sản phẩm này
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route('front.product', $product->slug) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span
                                            class="h5"><strong>{{ number_format($product->price) }} VNĐ</strong></span>
                                        @if ($product->compare_price > 0)
                                            <span
                                                class="h6 text-underline"><del>{{ number_format($product->compare_price) }} VNĐ</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                    <div class="d-flex flex-column align-items-center justify-content-center"><a class="btn btn-outline-dark py-2 px-4 mt-3" href="{{ route('front.shop') }}">Xem Thêm</a></div>
            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Sản phẩm mới nhất</h2>
            </div>
            <div class="row pb-3">
                @if ($latestProducts->isNotEmpty())
                    @foreach ($latestProducts as $product)
                        @php
                            $productImage = $product->product_images->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                        @if (!empty($productImage->image))
                                            <img class="card-img-top"
                                                 src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                        @else
                                            <img class="card-img-top"
                                                 src="{{ asset('admin-assets/img/default-150x150.png') }}">
                                        @endif
                                    </a>
                                    <div class="product-action">
                                        @if($product->track_qty == 'Yes')
                                            @if($product->qty > 0)
                                                <a class="btn btn-dark" href="javascript:void(0);"
                                                   onclick="addToCart({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                </a>
                                            @else
                                                <a class="btn btn-dark" href="javascript:void(0);">
                                                    Hết hàng
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-dark" href="javascript:void(0);">
                                                Cửa hàng chưa nhập sản phẩm này
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route('front.product', $product->slug) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span
                                            class="h5"><strong>{{ number_format($product->price) }} VNĐ</strong></span>
                                        @if ($product->compare_price > 0)
                                            <span
                                                class="h6 text-underline"><del>{{ number_format($product->compare_price) }} VNĐ</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                    <div class="d-flex flex-column align-items-center justify-content-center"><a class="btn btn-outline-dark py-2 px-4 mt-3" href="{{ route('front.shop') }}">Xem Thêm</a></div>
            </div>
        </div>
    </section>
@endsection
