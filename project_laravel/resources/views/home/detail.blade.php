@extends('master.main')

@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Chi tiết đơn hàng</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area">

            <div class="contact-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Thông tin khách hàng</h3>
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
                        </div>
                        <div class="col-md-6">
                            <h3>Thông tin giao hàng</h3>
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
                                <th>Tổng giá</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($order->details as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="uploads/product/{{ $item->product->image }}" width="40"
                                            alt="">
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
                            <th colspan="5" style="text-align: center">Tổng</th>
                            <th>{{ number_format($total) }}</th>

                        </tbody>
                    </table>


                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
