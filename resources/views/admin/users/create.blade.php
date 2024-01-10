@extends('admin.components.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tạo tài khoản</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Trở về</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" id="userForm" name="userForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Tên</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Tên">
                                </div>
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                           placeholder="Email">
                                </div>
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="Mật khẩu">
                                </div>
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                           placeholder="Số điện thoại">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Mở</option>
                                        <option value="0">Đóng</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Tạo</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $('#userForm').submit(function (event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route('users.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {

                        window.location.href = "{{ route('users.index') }}"

                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $('#email').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        if (errors['email']) {
                            $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['email']);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                    }
                },
                error: function (jqXHR, exception) {
                    console.log('Bug');
                }
            });
        });
    </script>
@endsection
