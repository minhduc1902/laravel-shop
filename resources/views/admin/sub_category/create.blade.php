@extends('admin.components.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tạo danh mục phụ</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('sub-categories.index') }}" class="btn btn-primary">Trở về</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" name="subCategoryForm" id="subCategoryForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="category">Danh mục</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Lựa chọn danh mục</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Tên</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Tên">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Mở</option>
                                        <option value="0">Đóng</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">Hiển thị ở trang chủ</label>
                                    <select name="showHome" id="showHome" class="form-control">
                                        <option value="Yes">Có</option>
                                        <option value="No">Không</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Tạo</button>
                    <a href="{{ route('sub-categories.index') }}" class="btn btn-outline-dark ml-3">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
<script>
    $('#subCategoryForm').submit(function(event) {
        event.preventDefault();
        var element = $("#subCategoryForm");
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("sub-categories.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {
                    window.location.href="{{ route('sub-categories.index') }}"

                    $('#name').removeClass('is-invalid').siblings('p').removeClass(
                        'invalid-feedback').html("");
                    $('#category').removeClass('is-invalid').siblings('p').removeClass(
                        'invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['name']) {
                        $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['category']) {
                        $('#category').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['category']);
                    } else {
                        $('#category').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log('Bug');
            }
        });
    });

    $("#name").change(function() {
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true) {
                    $("#slug").val(response["slug"]);
                }
            }
        });
    });
</script>
@endsection
