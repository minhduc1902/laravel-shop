@extends('admin.components.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn hàng: #{{ $order->id }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">Trở về</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    @include('admin.message')
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <h1 class="h5 mb-3">Địa chỉ giao hàng</h1>
                                    <address>
                                        <strong>{{ $order->first_name.' '.$order->last_name }}</strong><br>
                                        {{ $order->address }}<br>
                                        {{ $order->country }}<br>
                                        <b>Số điện thoại:</b> {{ $order->mobile }}<br>
                                        <b>Email:</b> {{ $order->email }}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <b>Mã đơn hàng:</b> {{ $order->id }}<br>
                                    <b>Tổng cộng:</b> {{ number_format($order->grand_total) }} VNĐ<br>
                                    <b>Trạng thái:</b>
                                    @if($order->status == 'pending')
                                        <span class="text-danger">Chưa giải quyết</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="text-info">Đang giao</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="text-success">Đã giao</span>
                                    @else
                                        <span class="text-warning">Đã hủy</span>
                                    @endif
                                    <br>
                                    <b>Ghi chú: </b>{{ $order->notes }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <form action="" method="post" id="changeOrderStatusForm" name="changeOrderStatusForm">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Trạng thái đơn hàng</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ ($order->status == 'pending') ? 'selected' : '' }}>
                                            Chưa giải quyết
                                        </option>
                                        <option value="shipped" {{ ($order->status == 'shipped') ? 'selected' : '' }}>
                                            Đang giao
                                        </option>
                                        <option
                                            value="delivered" {{ ($order->status == 'delivered') ? 'selected' : '' }}>
                                            Đã giao
                                        </option>
                                        <option
                                            value="cancelled" {{ ($order->status == 'cancelled') ? 'selected' : '' }}>
                                            Đã hủy
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
        $("#changeOrderStatusForm").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route('orders.changeOrderStatus', $order->id) }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                    window.location.href='{{ route('orders.detail', $order->id) }}';
                }
            });
        });
    </script>
@endsection
