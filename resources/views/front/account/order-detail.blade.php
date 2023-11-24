@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Đơn hàng: {{ $order->id }}</h2>
                        </div>

                        <div class="card-body pb-0">
                            <!-- Info -->
                            <div class="card card-sm">
                                <div class="card-body bg-light mb-3">
                                    <div class="row">
                                        <div class="col-6 col-lg-4">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Mã đơn hàng:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                {{ $order->id }}
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-4">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Trạng thái:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                @if($order->status == 'pending')
                                                    <span class="badge bg-danger">Chưa giải quyết</span>
                                                @elseif($order->status == 'shipped')
                                                    <span class="badge bg-info">Đang giao hàng</span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge bg-success">Đã giao hàng</span>
                                                @else
                                                    <span class="badge bg-warning">Đã hủy</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-4">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Tổng tiền:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                {{ number_format($order->grand_total) }} VNĐ
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-3">

                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Các mặt hàng đã đặt ({{ $orderItemsCount }})</h6>

                            <!-- Divider -->
                            <hr class="my-3">

                            <!-- List group -->
                            <ul>
                                @foreach($orderItems as $item)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-md-3 col-xl-2">
                                            <!-- Image -->
{{--                                            <a href="product.html"><img src="images/product-1.jpg" alt="..." class="img-fluid"></a>--}}
                                            @php
                                                $productImage = getProductImage($item->product_id);
                                            @endphp

                                            @if (!empty($productImage->image))
                                                <img class="img-fluid"
                                                     src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                            @else
                                                <img class="img-fluid"
                                                     src="{{ asset('admin-assets/img/default-150x150.png') }}">
                                            @endif
                                        </div>
                                        <div class="col">
                                            <!-- Title -->
                                            <p class="mb-4 fs-sm fw-bold">
                                                <a class="text-body" href="product.html">{{ $item->name }} x {{ $item->qty }}</a> <br>
                                                <span class="text-muted">{{ number_format($item->total) }} VNĐ</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card card-lg mb-5 mt-3">
                        <div class="card-body">
                            <!-- Heading -->
                            <h6 class="mt-0 mb-3 h5">Tổng đơn hàng</h6>

                            <!-- List group -->
                            <ul>
                                <li class="list-group-item d-flex fs-lg fw-bold">
                                    <span>Total</span>
                                    <span class="ms-auto">{{ number_format($order->grand_total) }} VNĐ</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
