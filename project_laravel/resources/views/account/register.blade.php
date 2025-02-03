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
                            <h2 class="title">Đăng ký</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
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
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="contact-content">
                                <div class="section-title mb-15">
                                    <span class="sub-title">Tạo tài khoản</span>
                                    <h2 class="title">Chào mừng đến với <span>ThangFood</span></h2>
                                </div>
                                <p></p>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="name" type="text" placeholder="Your Name *" required>
                                            @error('name')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="email" type="email" placeholder="Your Email *" required>
                                            @error('email')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="phone" type="text" placeholder="Your phone *" required>
                                        </div>
                                        <div class="form-grp">
                                            <input name="address" type="text" placeholder="Your address *" required>
                                        </div>
                                        <div class="form-grp">
                                            <select name="gender" class="form-control">
                                                <option value="">Chọn</option>
                                                <option value="1">Nam</option>
                                                <option value="0">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your Password *" required>
                                            @error('password')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="confirm_password" type="password"
                                                placeholder="Your Confirm Password *" required>
                                            @error('confirm_password')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <button type="submit">Tạo tài khoản</button>
                                    </div>
                                </form>
                                <p class="ajax-response mb-0"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-map">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
