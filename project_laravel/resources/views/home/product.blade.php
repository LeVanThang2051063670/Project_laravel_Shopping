@extends('master.main')
@section('title', $product->name)
@section('main')
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">{{ $product->name }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chu</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- shop-details-area -->
        <section class="shop-details-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="shop-details-images-wrap">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane show active" id="itemOne-tab-pane" role="tabpanel"
                                    aria-labelledby="itemOne-tab" tabindex="0">
                                    <a href="uploads/product/{{ $product->image }}" class="popup-image">
                                        <img id="big-img" src="uploads/product/{{ $product->image }}"
                                            alt="{{ $product->name }}" width="100%">
                                    </a>
                                </div>

                            </div>
                            <ul class="nav nav-tabs">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link">
                                        <img class="thumb-image" src="uploads/product/{{ $product->image }}" alt=""
                                            width="125px">
                                    </button>
                                </li>
                                @foreach ($product->images as $img)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link ">
                                            <img class="thumb-image" src="uploads/product/{{ $img->image }}"
                                                alt="" width="125px">
                                        </button>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shop-details-content">
                            <h2 class="title">{{ $product->name }}</h2>
                            <div class="review-wrap" style="visibility: hidden;">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span>(4 customer reviews)</span>
                            </div>
                            <h3 class="price">{{ $product->sale_price }} Đ<span>Còn hàng</span></h3>
                            <div class="product-count-wrap">
                                <span class="title">Nhanh lên nào !khuyến mãi kết thúc sau</span>
                                <div class="coming-time" data-countdown="2024/12/12"></div>
                            </div>
                            <p>Thịt là một loại thức ăn vô cùng quan trong đối với con người !</p>
                            <div class="shop-details-qty">
                                <span class="title">Số lượng :</span>
                                <div class="shop-details-qty-inner">
                                    <form action="#" style="display: none">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1">
                                        </div>
                                    </form>
                                    @if (auth('cus')->check())
                                        <a title="thêm giỏ hàng" href="{{ route('cart.add', $product->id) }}"><button
                                                class="purchase-btn" style="width:100%">
                                                Thêm giỏ hàng</button></a>
                                    @else
                                        <a title="thêm giỏ hàng" href="{{ route('account.login', $product->id) }} "><button
                                                class="purchase-btn" style="width:100%">
                                                Thêm giỏ hàng</button></a>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('order.checkout') }}" class="buy-btn">Mua ngay</a>
                            <div class="payment-method-wrap">
                                <span class="title">Đảm bảo thanh toán khi nhận hàng</span>
                                <img src="assets/img/product/payment_method.png" alt="">
                            </div>
                            <div class="shop-add-Wishlist">
                                <a href="#"><i class="far fa-heart"></i>Yêu thích sản phẩm</a>
                            </div>
                            <div class="sd-sku">
                                <span class="title">Mã sản phẩm</span>
                                <a href="#">{{ $product->id }}</a>
                            </div>
                            <div class="sd-category">
                                <span class="title">Danh mục:</span>
                                <ul class="list-wrap">
                                    <li><a href="#">{{ $product->cat->name }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-desc-wrap">
                            <ul class="nav nav-tabs" id="descriptionTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description-tab-pane" type="button" role="tab"
                                        aria-controls="description-tab-pane" aria-selected="true">Thông tin chi
                                        tiết</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                        aria-controls="reviews-tab-pane" aria-selected="false">Đánh giá(0)</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="descriptionTabContent">
                                <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                                    aria-labelledby="description-tab" tabindex="0">
                                    <div class="product-description-content">
                                        {!! $product->description !!}
                                        {{-- !! để in được cả html trong description --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                    aria-labelledby="reviews-tab" tabindex="0">
                                    <div class="product-desc-review">
                                        <div class="product-desc-review-title mb-15">
                                            <h5 class="title">Khách hàng đánh giá (0)</h5>
                                        </div>
                                        <div class="left-rc">
                                            <p>Không có đánh giá</p>
                                        </div>
                                        <div class="right-rc">
                                            <a href="#">Viết đánh giá</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-details-area-end -->

        <!-- product-area -->
        {{-- <section class="related-product-area pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-50">
                            <span class="sub-title">Organic Shop</span>
                            <h2 class="title">Related Products</h2>
                            <div class="title-shape" data-background="assets/img/images/title_shape.png"></div>
                        </div>
                    </div>
                </div>
                <div class="product-item-wrap-three">
                    <div class="row justify-content-center rp-active">
                        <div class="col-xl-3">
                            <div class="product-item-three inner-product-item">
                                <div class="product-thumb-three">
                                    <a href="shop-details.html"><img src="assets/img/product/inner_product01.png"
                                            alt=""></a>
                                    <span class="batch">New<i class="fas fa-star"></i></span>
                                </div>
                                <div class="product-content-three">
                                    <a href="shop.html" class="tag">organic</a>
                                    <h2 class="title"><a href="shop-details.html">roast chicken</a></h2>
                                    <h2 class="price">$4.99</h2>
                                    <div class="product-cart-wrap">
                                        <form action="#">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-shape-two">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445"
                                        preserveAspectRatio="none">
                                        <path
                                            d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z"
                                            transform="translate(-309 -3802)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="product-item-three inner-product-item">
                                <div class="product-thumb-three">
                                    <a href="shop-details.html"><img src="assets/img/product/inner_product02.png"
                                            alt=""></a>
                                    <span class="batch">New<i class="fas fa-star"></i></span>
                                </div>
                                <div class="product-content-three">
                                    <a href="shop.html" class="tag">organic</a>
                                    <h2 class="title"><a href="shop-details.html">Venison meat</a></h2>
                                    <h2 class="price">$4.99</h2>
                                    <div class="product-cart-wrap">
                                        <form action="#">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-shape-two">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445"
                                        preserveAspectRatio="none">
                                        <path
                                            d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z"
                                            transform="translate(-309 -3802)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="product-item-three inner-product-item">
                                <div class="product-thumb-three">
                                    <a href="shop-details.html"><img src="assets/img/product/inner_product03.png"
                                            alt=""></a>
                                    <span class="batch">New<i class="fas fa-star"></i></span>
                                </div>
                                <div class="product-content-three">
                                    <a href="shop.html" class="tag">organic</a>
                                    <h2 class="title"><a href="shop-details.html">processed meat</a></h2>
                                    <h2 class="price">$4.99</h2>
                                    <div class="product-cart-wrap">
                                        <form action="#">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-shape-two">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445"
                                        preserveAspectRatio="none">
                                        <path
                                            d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z"
                                            transform="translate(-309 -3802)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="product-item-three inner-product-item">
                                <div class="product-thumb-three">
                                    <a href="shop-details.html"><img src="assets/img/product/inner_product04.png"
                                            alt=""></a>
                                    <span class="batch">New<i class="fas fa-star"></i></span>
                                </div>
                                <div class="product-content-three">
                                    <a href="shop.html" class="tag">organic</a>
                                    <h2 class="title"><a href="shop-details.html">roast chicken</a></h2>
                                    <h2 class="price">$4.99</h2>
                                    <div class="product-cart-wrap">
                                        <form action="#">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-shape-two">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445"
                                        preserveAspectRatio="none">
                                        <path
                                            d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z"
                                            transform="translate(-309 -3802)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="product-item-three inner-product-item">
                                <div class="product-thumb-three">
                                    <a href="shop-details.html"><img src="assets/img/product/inner_product05.png"
                                            alt=""></a>
                                    <span class="batch">New<i class="fas fa-star"></i></span>
                                </div>
                                <div class="product-content-three">
                                    <a href="shop.html" class="tag">organic</a>
                                    <h2 class="title"><a href="shop-details.html">Venison meat</a></h2>
                                    <h2 class="price">$4.99</h2>
                                    <div class="product-cart-wrap">
                                        <form action="#">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-shape-two">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445"
                                        preserveAspectRatio="none">
                                        <path
                                            d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z"
                                            transform="translate(-309 -3802)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- product-area-end -->

    </main>
@endsection

@section('js')
    <script>
        $('.thumb-image').click(function(e) {
            e.preventDefault();

            var _url = $(this).attr('src');

            $('#big-img').attr('src', _url)
        })
    </script>
@endsection
