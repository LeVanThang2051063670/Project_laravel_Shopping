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
                            <h2 class="title">Thông tin </h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
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
                                    <span class="sub-title">Trang cá nhân</span>
                                    <h2 class="title">Xin chào <span>bạn</span></h2>
                                </div>
                                <p></p>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input value="{{ $auth->name }}" name="name" type="text"
                                                placeholder="Your Name *" required>
                                            @error('name')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input value="{{ $auth->email }}" name="email" type="email"
                                                placeholder="Your Email *" required>
                                            @error('email')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input value="{{ $auth->phone }}" name="phone" type="text"
                                                placeholder="Your phone *" required>
                                        </div>
                                        <div class="form-grp">
                                            <input value="{{ $auth->address }}" name="address" type="text"
                                                placeholder="Your address *" required>

                                        </div>
                                        <div class="form-grp">
                                            <select name="gender" class="form-control">
                                                <option value="">Chọn</option>
                                                <option value="1" {{ $auth->gender == 1 ? 'selected' : '' }}>Nam
                                                </option>
                                                <option value="0" {{ $auth->gender == 0 ? 'selected' : '' }}>Nữ
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your Password *" required>
                                            @error('password')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <button type="submit">Cập nhật thông tin</button>
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
