@extends('admin.components.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route('orders.index') }}'"
                                    class="btn btn-default btn-sm">Reset
                            </button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                       class="form-control float-right" placeholder="Tìm kiếm">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Số lượng</th>
                            <th>Ngày mua</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($orders->isNotEmpty())
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge bg-danger">Chưa giải quyết</span>
                                        @elseif($order->status == 'shipped')
                                            <span class="badge bg-info">Đang giao hàng</span>
                                        @elseif($order->status == 'delivered')
                                            <span class="badge bg-success">Đã giao hàng</span>
                                        @else
                                            <span class="badge bg-warning">Đã hủy</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($order->grand_total) }} VNĐ</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('orders.detail', [$order->id]) }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">Không tìm thấy bản ghi</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
