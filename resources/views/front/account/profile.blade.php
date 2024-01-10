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
                <div class="col-md-12">
                    @include('front.account.common.message')
                </div>
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Thông tin cá nhân</h2>
                        </div>
                        <form action="" name="profileForm" id="profileForm">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="name">Tên</label>
                                        <input value="{{ $user->name }}" type="text" name="name" id="name" placeholder="Nhập tên của bạn"
                                               class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input readonly value="{{ $user->email }}" type="text" name="email" id="email" placeholder="Nhập email của bạn"
                                               class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Số điện thoại</label>
                                        <input value="{{ $user->phone }}" type="text" name="phone" id="phone" placeholder="Nhập số điện thoại của bạn"
                                               class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-dark">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $("#profileForm").submit(function(event) {
           event.preventDefault();
           $.ajax({
              url: '{{ route("account.updateProfile") }}',
              type: 'post',
              data: $(this).serializeArray(),
               dataType: 'json',
               success: function (response) {
                    if(response.status == true) {
                        window.location.href = '{{ route("account.profile") }}'

                        $("#name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("#email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("#phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    } else {
                        var errors = response.errors;
                        if(errors.name) {
                            $("#name").addClass('is-invalid').siblings('p').html(errors.name).addClass('invalid-feedback');
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }

                        if(errors.phone) {
                            $("#phone").addClass('is-invalid').siblings('p').html(errors.phone).addClass('invalid-feedback');
                        } else {
                            $("#phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }
                    }
               }
           });
        });
    </script>
@endsection
