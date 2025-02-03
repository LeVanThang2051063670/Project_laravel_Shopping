@extends('master.admin')

@section('main')
    @if ($order->status != 2)
        @if ($order->status != 3)
            <a href="{{ route('order.update', $order->id) }}?status=2" class="btn btn-danger"
                onclick="return confirm('Ban co chac chua ?')">Đã giao hàng</a>
            <a href="{{ route('order.update', $order->id) }}?status=3" class="btn btn-warning"
                onclick="return confirm('Ban co chac chua ?')">Hủy</a>
        @else
            <a href="{{ route('order.update', $order->id) }}?status=1" class="btn btn-warning"
                onclick="return confirm('Ban co chac chua ?')">Khôi Phục</a>
        @endif
    @endif
    <div class="row">
        <div class="col-md-6">
            <h3>Thông tin khách hàng</h3>
            @if (isset($auth))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <td>{{ $auth->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $auth->phone }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{ $auth->address }}</td>
                        </tr>

                    </thead>

                </table>
            @else
                <p>Khách ngoài.</p>
            @endif
        </div>
        <div class="col-md-6">
            <h3>Thông tin </h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <th>Ngày đặt</th>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                </thead>

            </table>

        </div>
    </div>
    <hr>
    <h3>Thông tin sản phẩm</h3>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach ($order->details as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td><img src="uploads/product/{{ $item->product->image }}" width="40" alt="">
                    <td>
                        {{ $item->product->name }}
                    </td>
                    <td>{{ $item->quantity }}</td>

                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }}</td>



                    <?php
                    $total += $item->price * $item->quantity;
                    ?>

                </tr>
            @endforeach
            <th colspan="5" style="text-align: center">Sum</th>
            <th>{{ number_format($total) }}</th>

        </tbody>
    </table>
@endsection
