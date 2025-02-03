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
                            <h2 class="title">Hóa đơn thanh toán</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Hóa đơn</li>
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
                        <div class="col-md-4">
                            <form action="" method="post">
                                @csrf
                                <div class="contact-form-wrap">
                                    <div class="form-grp">
                                        <label for="name">Tên Người Đặt</label>
                                        <input name="name" value="{{ $auth->name }}" type="text"
                                            placeholder="Your Name *" required>
                                        @error('name')
                                            <small class="help-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-grp">
                                        <label for="email">Email</label>
                                        <input name="email" type="email" value="{{ $auth->email }}"
                                            placeholder="Your Email *" required>
                                        @error('email')
                                            <small class="help-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-grp">
                                        <label for="phone">SDT</label>
                                        <input name="phone" type="text" value="{{ $auth->phone }}"
                                            placeholder="Your phone *" required>
                                    </div>
                                    <div class="form-grp">
                                        <label for="address">Địa chỉ</label>
                                        <input name="address" type="text" value="{{ $auth->address }}"
                                            placeholder="Your address *" required>
                                    </div>



                                    <button type="submit">Đặt hàng</button>
                                </div>


                            </form>

                        </div>
                        <div class="col-md-8">
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
                                                {{ $item->quantity }}
                                            </td>
                                            <td><img src="uploads/product/{{ $item->prod->image }}" width="40"
                                                    alt="">
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
