@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
            <div class="login-form">
                <form action="{{ route('account.authenticate') }}" method="post">
                    @csrf
                    <h4 class="modal-title">Đăng nhập</h4>
                    <div class="form-group">
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" value="{{ old('email') }}" required="required">
                        @error('email')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                               required="required">
                        @error('password')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Đăng nhập">
                </form>
                <div class="text-center small">Bạn chưa có tài khoản? <a href="{{ route('account.register') }}">Đăng ký</a></div>
            </div>
        </div>
    </section>
@endsection
