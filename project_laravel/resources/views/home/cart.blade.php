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
                            <h2 class="title">Giỏ hàng </h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
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
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Ảnh</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($carts as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->prod->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->product_id) }}" method="get">
                                            <input type="number" value="{{ $item->quantity }}"
                                                style="width:60px;text-align:center" name="quantity">
                                            <button><i class="fa fa-save"></i></button>
                                        </form>
                                    </td>
                                    <td><img src="uploads/product/{{ $item->prod->image }}" width="40" alt="">
                                    </td>

                                    <td>

                                        <a title="Xóa"
                                            onclick="return confirm('Ban co muon xóa sản phẩm khỏi giỏ hàng không')"
                                            href="{{ route('cart.delete', $item->product_id) }}"><i
                                                class="fas fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="text-center">
                        <a href="" class="btn btn-primary">Tiếp tục mua</a>
                        @if ($carts->count())
                            <a href="{{ route('cart.clear') }}" class="btn btn-danger"
                                onclick="confirm('ban muon xoa tat ca chu ?')"><i class="fa fa-trash"></i>Xóa giỏ hàng</a>
                            <a href="{{ route('order.checkout') }}" class="btn btn-success">Thanh toán</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
