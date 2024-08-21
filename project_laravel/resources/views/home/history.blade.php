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
                            <h2 class="title">Your Order History</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">History</li>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Order date</th>
                                <th>Status</th>
                                <th>Total Price</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($auth->orders as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span>Chua xac nhan qua email</span>
                                        @elseif($item->status == 1)
                                            <span>Đã xác nhận đơn hàng</span>
                                        @elseif($item->status == 2)
                                            <span>Đã thanh toán</span>
                                        @else
                                            <span>Đã Hủy</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->totalPrice) }}</td>


                                    <td>

                                        <a href="{{ route('order.detail', $item->id) }}"
                                            class="btn btn-sm btn-primary">Detail</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="text-center">
                        <a href="" class="btn btn-primary">continue shopping</a>
                        @if ($carts->count())
                            <a href="{{ route('cart.clear') }}" class="btn btn-danger"
                                onclick="confirm('ban muon xoa tat ca chu ?')"><i class="fa fa-trash"></i>Clear Shopping</a>
                            <a href="{{ route('order.checkout') }}" class="btn btn-success">Place Oder</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
