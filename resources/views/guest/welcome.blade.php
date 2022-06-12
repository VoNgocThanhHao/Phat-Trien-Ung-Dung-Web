@extends('guest.master')
@section('style')

    <style>

        .showcase {
            width: 100%;
            min-height: 100vh;
            padding: 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #111;
            transition: 0.5s;
            z-index: 2;
        }

        .background-home-guest {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: linear-gradient(180deg, #777676, #000000, #000000), url({{ asset('public/mySource/imgs/background/iPhone-14.png') }});
            background-blend-mode: screen;
            background-repeat: no-repeat;
            background-position: right;
        }


        .background-home-guest .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: #fff; */
            /* mix-blend-mode: overlay; */
        }

        .background-home-guest .text {
            position: relative;
            z-index: 10;
        }

        .background-home-guest .text h2 {
            font-size: 5em;
            font-weight: 800;
            color: #fff;
            line-height: 1em;
            text-transform: uppercase;
        }

        .background-home-guest .text h3 {
            font-size: 4em;
            font-weight: 700;
            color: #fff;
            line-height: 1em;
            text-transform: uppercase;
        }

        .background-home-guest .text p {
            font-size: 1.1em;
            color: #fff;
            margin: 20px 0;
            font-weight: 400;
            max-width: 700px;
        }

        .background-home-guest .text a {
            display: inline-block;
            font-size: 1em;
            background: #fff;
            padding: 10px 30px;
            text-transform: uppercase;
            text-decoration: none;
            font-weight: 500;
            margin-top: 10px;
            color: #111;
            letter-spacing: 2px;
            transition: 0.2s;
        }

        .background-home-guest .text a:hover {
            letter-spacing: 6px;
        }


        @media (max-width: 991px) {
            .background-home-guest .showcase,
            .background-home-guest .showcase header {
                padding: 40px;
            }

            .background-home-guest .text h2 {
                font-size: 3em;
            }

            .background-home-guest .text h3 {
                font-size: 2em;
            }
        }

        /*    ascasc*/

        .child {
            transition: all .5s;
            height: 100%;
            width: 100%;
            background-position: center;
            background-size: cover;
            cursor: pointer;
            border-radius: 15px;
        }

        .parent:hover .child,
        .parent:focus .child {
            transform: scale(1.2);
        }


        .my-card-product {
            transition: transform .5s;
        }

        .my-card-product:hover {
            transform: scale(1.05);
            background-color: rgba(255, 255, 255, 0.1)
        }


        /*NhiNHi*/


        .bg-red {
            background-color: var(--red);
        }

        .bg-white {
            background-color: var(--white);
        }

        .bg-black {
            background-color: var(--black);
        }

        .bg-blue {
            background-color: var(--blue-one);
        }

        .bg-green {
            background-color: var(--green-one);
        }

        .slider {
            overflow: hidden;
            height: 500%;
        }


        .fullheight {
            height: 100vh;
        }

        .product-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .img-wrapper img {
            height: auto;
            width: 80%;
            transform: rotate(-35deg);
        }

        .more-images {
            position: absolute;
            right: 90px;
            top: 50%;
        }

        .more-images-item {
            height: fit-content;
            border-radius: 15px;
            overflow: hidden;
            margin: 5px 0;
        }

        .more-images-item img {
            height: auto;
            width: 80px;
            border-radius: 15px;
            transition: 1s;
        }

        .more-images-item:hover img {
            transform: scale(1.5);
        }

        .more-images-item:hover {
            cursor: pointer;
        }

        .product-info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            padding: 0 10%;
            color: var(--silver);
        }

        .info-wrapper {
            margin: auto;
            position: relative;
            text-align: right;
        }

        .product-name h2 {
            font-weight: 900;
            font-size: xxx-large;
            color: var(--black);
        }

        .product-size {
            margin: 20px 0;
        }

        .product-description {
            margin: 60px 0;
            text-align: justify;
            font-weight: 600;
        }

        .button > button {
            font-weight: 900;
            font-size: x-large;
            padding: 15px 60px;
            border-radius: 30px;
            border: 2px solid var(--black);
            background-color: var(--white);
            color: var(--black);
            transition: .5s;
        }

        .button > button:hover {
            cursor: pointer;
            transform: scale(1.1);
        }

        .img-col {
            border-bottom-left-radius: 100%;
        }

        .slide-control {
            display: flex;
            padding: 5px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .slide-control div {
            height: 50px;
            width: 50px;
            margin: 10px;
            transition: .5s;
        }

        .slide-control div:hover {
            cursor: pointer;
            transform: translateY(-30px);
            border-bottom: 2px solid var(--black);
        }

        .slide-control div img {
            height: auto;
            width: 100%;
            filter: grayscale(100%);
            transform: rotate(-45deg);
        }

        .slide-control div:hover img {
            filter: unset;
        }

        .slide-control div.active img {
            filter: unset;
        }

        .slide-control div.active {
            border-bottom: 2px solid var(--black);
        }

        @keyframes zoom {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        /*  ANIMATION */

        .right-to-left {
            transition: 1s;
            transform: translateX(100%);
        }

        .active .right-to-left {
            transform: translateX(0);
        }

        .bottom-up {
            transition: 1s;
            transform: translateY(100vh);
        }

        .active .bottom-up {
            transform: translateY(0);
        }

        .left-to-right {
            transition: 1s;
            transform: translateX(-150%);
        }

        .active .left-to-right {
            transition: 1s;
            transform: translateX(0);
        }

        .more-images-item:nth-child(1) {
            transition-delay: .2s;
        }

        .more-images-item:nth-child(2) {
            transition-delay: .4s;
        }

        .more-images-item:nth-child(3) {
            transition-delay: .6s;
        }

        .more-images-item:nth-child(4) {
            transition-delay: .8s;
        }

        .info-wrapper > div:nth-child(1) {
            transition-delay: .2s;
        }

        .info-wrapper > div:nth-child(2) {
            transition-delay: .4s;
        }

        .info-wrapper > div:nth-child(3) {
            transition-delay: .6s;
        }

        .info-wrapper > div:nth-child(4) {
            transition-delay: .8s;
        }

        .info-wrapper > div:nth-child(5) {
            transition-delay: 1s;
        }

        .info-wrapper > div:nth-child(6) {
            transition-delay: 1.2s;
        }

        .bounce {
            animation-name: bounce;
            animation-timing-function: ease;
            animation-iteration-count: infinite;
            animation-duration: 3s;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-50px);
            }
            100% {
                transform: translateY(0);
            }
        }

        .btnCateBox {
            padding-top: 20px;
            border: white solid 1px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            transition: transform .5s;
        }

        .btnCateBox:hover {
            transform: scale(1.1);
        }

        .rowCate {
            padding-right: 20px;
            padding-left: 20px;
        }


    </style>

@endsection
@section('content')


    <section class="showcase background-home-guest">
        <div class="overlay">
        </div>
        <div class="text">
            <h3>Không bao giờ dừng lại</h3>
            <h4 class="text-white">Phong cách không có giới hạn</h4>
            <p>Không ai có thể quyết định được phong cách của riêng bạn.
            Phong cách của mỗi người là duy nhất. Hãy khiến bản thân mình hài lòng
            với sự giúp đỡ của chúng tôi. <br><br> <h4 class="text-white"> RẤT HÂN HẠNH ĐƯỢC LÀ MỘT PHẦN CỦA BẠN!</h4></p>
        </div>
    </section>

    <div style=" background-color: black">

        <div class="container">
            <div class="text-center" style="color: white; padding-top: 5rem;">
                <h3 style="font-size: 4rem; font-weight: bold">QUYẾT ĐỊNH PHONG CÁCH CỦA BẠN</h3>
            </div>
            <div class="mt-5">
                <div class="row text-center">
                    <div class="col-md-6 linkGalaxy">
                        <div class="parent p-5" style="">
                            <img class="child"
                                 src="{{ asset('public/mySource/test/bce7f60cae394fed667769087723a49a.jpg') }}" alt="">
                        </div>
                    </div>

                    <div class="col-md-6 row">

                        <div class="col-md-12 linkIphone13">
                            <div class="parent p-5" style="">
                                <img class="child" src="{{ asset('public/mySource/test/iPhone-13-Pro-2.png') }}" alt="">
                            </div>
                        </div>

                        <div class="col-md-12 linkS22Ultra">
                            <div class="parent p-5" style="">
                                <img class="child"
                                     src="{{ asset('public/mySource/test/Samsung-Galaxy-S22-Ultra-3.jpg') }}"
                                     alt="">
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="text-center mb-xl-5" style="color: white; padding-top: 5rem">
                <h3 style="font-size: 4rem; font-weight: bold">THỊNH HÀNH NHẤT HIỆN NAY</h3>
            </div>


            <div class="row text-center justify-content-center">

                @foreach($products_most_view as $product)

                <div class="col-md-3 p-3" style="min-width: 300px; height: 100%">
                    <div class="my-card-product text-white" style="border-radius: 10px;border: white solid 1px;">
                        <div class="text-center">
                            <img class="mt-2" src="{{ asset($product->image) }}" alt=""
                                 style="width: 80%">
                        </div>
                        <div class="text-center">
                            <p class="mt-2 h5"><strong>{{ $product->name }}</strong></p>
                            @if($product->chip != '')
                                <p style="">
                                    <i class="fa-solid fa-microchip"></i> {{ $product->chip }}
                                </p>
                            @else
                                <p style="visibility: hidden">
                                    <i class="fa-solid fa-microchip"></i>
                                </p>
                            @endif
                            <p>
                                <i class="fa-brands fa-invision"></i> {{ $product->brand->name }}
                                &ensp;
                                @if($product->ram != '')
                                    <i class="fa-solid fa-memory"></i> {{ $product->ram }} GB
                                @endif
                            </p>
                            <p style="font-size: 1.5rem;">
                                <strong>
                                    <span style=" background-color: black; border-radius: 15px; color: white">
                                        &ensp; {{ number_format($product->price, 0 ,"," ,".") }} VND &ensp;
                                    </span>
                                </strong>
                            </p>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-danger float-left ml-4 btnAddFav"  data="{{ $product->id }}"
                                        style="border-radius: 50%"><i class="fa-solid fa-heart-circle-plus"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary float-none text-white btnBuy" data="{{ $product }}"
                                        style="border-radius: 100px">MUA NGAY
                                </button>
                                <a href="{{ action('App\Http\Controllers\productController@getViewProductDetail', $product->id) }}" type="button" class="btn btn-outline-primary float-right mr-4"
                                        style="border-radius: 50%"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


                {{-- // --}}




            </div>


            <div class="text-center mb-xl-5" style="color: white; padding-top: 5rem">
                <h3 style="font-size: 4rem; font-weight: bold">MỚI NHẤT</h3>
            </div>

            <!-- MAIN -->
            <div id="slider" class="slider text-white">

                <!-- SLIDE 1 -->
                <div class="row fullheight slide">
                    <div class="col-6 fullheight">
                        <!-- PRODUCT INFO -->
                        <div class="product-info">
                            <div class="info-wrapper">
                                <div class="product-name left-to-right">
                                    <h2>
                                        iPhone 13 Pro Max
                                    </h2>
                                </div>
                                <div class="product-size left-to-right">
                                    <h3><span style="font-size: 17px">Một sản phẩm của</span> <strong>Apple</strong>
                                    </h3>
                                </div>
                                <div class="product-color left-to-right">
                                    <h3>Thông số cơ bản</h3>
                                    <div class="color-wrapper">
                                        <p>
                                            <i class="fa-solid fa-microchip"></i> Apple M1
                                            &ensp;
                                            <i class="fa-solid fa-memory"></i> 6 GB
                                        </p>
                                    </div>
                                </div>
                                <div class="product-description left-to-right">
                                    <p>
                                        iPhone 13 Pro Max là chiếc điện thoại hiếm hoi nhận được đánh giá 5
                                        sao từ Toms Guide. Thiết bị có được khả năng chụp ảnh và quay video vượt trội -
                                        bao gồm cả chế độ Cinematic rất hấp dẫn và chế độ chụp ảnh macro. Không chỉ vậy
                                        , iPhone 13 Pro Max còn có hiệu suất đỉnh cao cùng màn hình 120 Hz cho trải
                                        nghiệm mượt mà. Thêm vào đó, thời lượng pin siêu khủng cũng là một trong những
                                        điểm mạnh nhất của iPhone thế hệ mới.
                                    </p>
                                </div>
                                <div class="button left-to-right linkIphone13">
                                    <button style="color: black !important;">
                                        Xem chi tiết
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- END PRODUCT INFO -->
                    </div>
                    <div class="col-6 fullheight img-col"
                         style="background-image: linear-gradient(to top right, #ffffff, #000000)">
                        <!-- PRODUCT IMAGE -->
                        <div class="product-img">
                            <div class="img-wrapper right-to-left">
                                <div class="bounce">
                                    <img src="{{ asset('public/mySource/test/test.png') }}" alt="placeholder+image">
                                </div>
                            </div>
                        </div>
                        <!-- END PRODUCT IMAGE -->

                    </div>

                </div>
                <!-- END SLIDE 1 -->


                <!-- SLIDE CONTROL -->
                <div id="slide-control" class="slide-control" style="display: none;">
                    <div class="slide-control-item">
                    </div>
                </div>
                <!-- END SLIDE CONTROL -->
            </div>
            <!-- END MAIN -->


            {{--            CATEGORY--}}
            <div style="padding-top: 5rem;padding-bottom: 5rem">
                <div class="row" style="margin-top: 5rem;">
                    <div class="col-md-4 rowCate">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'dien-thoai') }}">
                            <div class="btnCateBox text-white text-center">
                                <i class="fa-solid fa-mobile-button mb-4" style="font-size: 5rem"></i>
                                <p style="font-size: 1.5rem">Điện thoại</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 rowCate">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'laptop') }}">
                            <div class="btnCateBox text-white text-center">
                                <i class="fa-solid fa-laptop mb-4" style="font-size: 5rem"></i>
                                <p style="font-size: 1.5rem">Laptop</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 rowCate">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'may-tinh-ban') }}">
                            <div class="btnCateBox text-white text-center">
                                <i class="fa-solid fa-computer mb-4" style="font-size: 5rem"></i>
                                <p style="font-size: 1.5rem">Máy tính bàn (PC)</p>
                            </div>
                        </a>
                    </div>


                </div>

                <div class="row mt-5">

                    <div class="col-md-4 rowCate">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'dong-ho-thong-minh') }}">
                            <div class="btnCateBox text-white text-center">
                                <i class="fa-solid fa-clock mb-4" style="font-size: 5rem"></i>
                                <p style="font-size: 1.5rem">Đồng hồ thông minh</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 rowCate">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'may-tinh-bang') }}">
                            <div class="btnCateBox text-white text-center">
                                <i class="fa-solid fa-tablet mb-4" style="font-size: 5rem"></i>
                                <p style="font-size: 1.5rem">Máy tính bảng</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 rowCate">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'phu-kien') }}">
                            <div class="btnCateBox text-white text-center">
                                <i class="fa-solid fa-headphones-simple mb-4" style="font-size: 5rem"></i>
                                <p style="font-size: 1.5rem">Phụ kiện</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>


        </div>
    </div>



@endsection

@section('script')

    <script>

        let slideIndex = 0;

        let slider = document.getElementById('slider')

        let slides = slider.getElementsByClassName('slide')

        let slideControl = document.getElementById('slide-control')

        let slideControlItems = slideControl.getElementsByClassName('slide-control-item')


        slider.style.marginTop = '-' + slideIndex + '00vh'

        var start_anim = function () {
            var scroll = $(window).scrollTop();
            // console.log(scroll)
            if (scroll >= 1400) {
                slideControlItems[slideIndex].classList.add('active')
                slides[slideIndex].classList.add('active')
            }
        }

        $(document).ready(function () {

            start_anim()

            $(window).scroll(function () {
                start_anim()
            });


            $('.linkGalaxy').click(function () {
                window.location.href = '{{ action('App\Http\Controllers\productController@getViewProductDetail', 1) }}'
            })

            $('.linkIphone13').click(function () {
                window.location.href = '{{ action('App\Http\Controllers\productController@getViewProductDetail', 2) }}'
            })

            $('.linkS22Ultra').click(function () {
                window.location.href = '{{ action('App\Http\Controllers\productController@getViewProductDetail', 3) }}'
            })

        })

    </script>

@endsection
