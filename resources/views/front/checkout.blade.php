@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form action="" id="orderForm" name="orderForm" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="sub-title">
                            <h2>Địa chỉ nhận hàng</h2>
                        </div>
                        <div class="card shadow-lg border-0">
                            <div class="card-body checkout-form">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="first_name" id="first_name" class="form-control"
                                                   placeholder="Họ" value="{{ (!empty($customerAddress)) ? $customerAddress->first_name : '' }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="last_name" id="last_name" class="form-control"
                                                   placeholder="Tên" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : '' }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="email" id="email" class="form-control"
                                                   placeholder="Email" value="{{ (!empty($customerAddress)) ? $customerAddress->email : '' }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input name="country" id="country" placeholder="Thành phố"
                                                   class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->country : '' }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="address" id="address" cols="30" rows="3"
                                                      placeholder="Địa chỉ" class="form-control">{{ (!empty($customerAddress)) ? $customerAddress->address : '' }}</textarea>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                   placeholder="Số điên thoại" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : '' }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="order_notes" id="order_notes" cols="30" rows="2"
                                                      placeholder="Ghi chú" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sub-title">
                            <h2>Đơn hàng</h2>
                        </div>
                        <div class="card cart-summery">
                            <div class="card-body">
                                @foreach(Cart::content() as $item)
                                    <div class="d-flex justify-content-between pb-2">
                                        <div class="h6">{{ $item->name }} X {{ $item->qty }}</div>
                                        <div class="h6">{{ number_format($item->price*$item->qty) }} VNĐ</div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between mt-2 summery-end">
                                    <div class="h5"><strong>Tổng cộng</strong></div>
                                    <div class="h5"><strong>{{ Cart::subtotal() }} VNĐ</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="card payment-form ">
                            <h3 class="card-title h5 mb-3">Phương thức thanh toán</h3>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="cod" checked id="payment_method_one">
                                <label for="payment_method_one" class="form_check_label">Tiền mặt</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="bank" id="payment_method_two">
                                <label for="payment_method_two" class="form_check_label">Chuyển khoản</label>
                            </div>
                            <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                <img src="{{ asset('front-assets/images/qr.jpg') }}" alt="">
                            </div>
                            <div class="pt-4">
                                <button type="submit">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $("#payment_method_one").click(function () {
            if ($(this).is(":checked") == true) {
                $("#card-payment-form").addClass('d-none');
            }
        });
        $("#payment_method_two").click(function () {
            if ($(this).is(":checked") == true) {
                $("#card-payment-form").removeClass('d-none');
            }
        });

        $("#orderForm").submit(function(event) {
            event.preventDefault();
            $('button[type="submit]').prop('disabled', true);
            $.ajax({
                url: '{{ route("front.processCheckout") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;
                    $('button[type="submit]').prop('disabled', false);

                    if(response.status == false) {
                        if(errors.first_name) {
                            $("#first_name").addClass('is-invalid')
                                .siblings("p")
                                .addClass('invalid-feedback')
                                .html(errors.first_name);
                        } else {
                            $("#first_name").removeClass('is-invalid')
                                .siblings("p")
                                .removeClass('invalid-feedback')
                                .html(errors.first_name);
                        }

                        if(errors.last_name) {
                            $("#last_name").addClass('is-invalid')
                                .siblings("p")
                                .addClass('invalid-feedback')
                                .html(errors.last_name);
                        } else {
                            $("#last_name").removeClass('is-invalid')
                                .siblings("p")
                                .removeClass('invalid-feedback')
                                .html(errors.last_name);
                        }

                        if(errors.email) {
                            $("#email").addClass('is-invalid')
                                .siblings("p")
                                .addClass('invalid-feedback')
                                .html(errors.email);
                        } else {
                            $("#email").removeClass('is-invalid')
                                .siblings("p")
                                .removeClass('invalid-feedback')
                                .html(errors.email);
                        }

                        if(errors.country) {
                            $("#country").addClass('is-invalid')
                                .siblings("p")
                                .addClass('invalid-feedback')
                                .html(errors.country);
                        } else {
                            $("#country").removeClass('is-invalid')
                                .siblings("p")
                                .removeClass('invalid-feedback')
                                .html(errors.country);
                        }

                        if(errors.address) {
                            $("#address").addClass('is-invalid')
                                .siblings("p")
                                .addClass('invalid-feedback')
                                .html(errors.address);
                        } else {
                            $("#address").removeClass('is-invalid')
                                .siblings("p")
                                .removeClass('invalid-feedback')
                                .html(errors.address);
                        }

                        if(errors.mobile) {
                            $("#mobile").addClass('is-invalid')
                                .siblings("p")
                                .addClass('invalid-feedback')
                                .html(errors.mobile);
                        } else {
                            $("#mobile").removeClass('is-invalid')
                                .siblings("p")
                                .removeClass('invalid-feedback')
                                .html(errors.mobile);
                        }
                    } else {
                        window.location.href="{{ url('/thanks/') }}/"+response.orderId;
                    }
                }, error: function() {

                }
            });
        })
    </script>
@endsection
