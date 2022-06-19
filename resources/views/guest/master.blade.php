<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <meta content="width=device-width, initial-scale=0.5, maximum-scale=1.0, user-scalable=1" name="viewport">
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <title>Điện máy Đen</title>
    <link rel="icon" href="{{ asset('public/mySource/imgs/logo/logo_v2.png') }}"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{--    <link rel="stylesheet" href="{{asset("public/plugins/fontawesome-free/css/all.min.css")}}">--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.11.5/sl-1.3.4/sr-1.1.0/datatables.min.css"/>

    <link rel="stylesheet"
          href="{{asset("public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">

    <link rel="stylesheet" href="{{asset("public/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">

    <link rel="stylesheet" href="{{asset("public/plugins/jqvmap/jqvmap.min.css")}}">

    <link rel="stylesheet" href="{{asset("public/dist/css/adminlte.min.css?v=3.2.0")}}">

    <link rel="stylesheet" href="{{asset("public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">

    <link rel="stylesheet" href="{{asset("public/plugins/daterangepicker/daterangepicker.css")}}">

    <link rel="stylesheet" href="{{asset("public/plugins/summernote/summernote-bs4.min.css")}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


    <style>

        a {
            color: inherit;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            cursor: pointer;
        }

        .container {
            max-width: 1300px !important;
        }

        .itemFav {
            transition: 0.5s;
            /*background-color: rgba(0,0,0,0.5);*/
        }

        .itemFav:hover {
            transform: scale(1.1);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
        }

        .btnItemFav:hover {
            color: white;
        }

        .rbtnTran {
            border: #C5C5C5 solid 2px;
            cursor: pointer;
            transition: 0.5s;
        }

        .iconTran {
            transition: 0.5s;
            background-color: rgba(197, 197, 197, 0.45);
        }

        .rbtnTran:hover .iconTran {
            background-color: rgba(0, 0, 0, 1);
            color: white;
        }

        .rbtnTran:hover {
            border: black solid 2px;
        }

    </style>

    @yield('style')

</head>


<body class="layout-top-nav" style="height: auto;">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand-xl navbar-dark bg-gradient fixed-top">
        <div class="container" style="max-width: 1300px;">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('public/mySource/imgs/logo/logo_v2.png') }}" alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Điện máy <strong>ĐEN</strong></span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                <ul class="navbar-nav mt-1" style="font-size: small">
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'dien-thoai') }}"
                           class="nav-link">
                            <i class="fa-solid fa-mobile-button mr-1"></i> ĐIỆN THOẠI</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'laptop') }}"
                           class="nav-link">
                            <i class="fa-solid fa-laptop mr-1"></i>LAPTOP</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'may-tinh-ban') }}"
                           class="nav-link">
                            <i class="fa-solid fa-computer mr-1"></i>MÁY TÍNH BÀN (PC)</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'dong-ho-thong-minh') }}"
                           class="nav-link">
                            <i class="fa-solid fa-clock mr-1"></i>ĐỒNG HỒ THÔNG MINH</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'may-tinh-bang') }}"
                           class="nav-link">
                            <i class="fa-solid fa-tablet mr-1"></i>MÁY TÍNH BẢNG</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'phu-kien') }}"
                           class="nav-link">
                            <i class="fa-solid fa-headphones-simple mr-1"></i>PHỤ KIỆN</a>
                    </li>

                </ul>

                <div class="form-inline ml-0 ml-md-3">
                    <div class="input-group input-group-sm" style="position: relative">
                        <input class="form-control form-control-navbar inputSearch" type="search" placeholder="Tìm kiếm"
                               aria-label="Search" style="background-color: black !important; max-width: 170px">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" style="background-color: black !important;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="text-white boxSearch"
                             style="position: absolute; top: 100%; left:0; background-color: rgba(0,0,0,1); display: none; z-index: -1">

                            {{--                            <a href="#">--}}
                            {{--                            <div class="row p-2">--}}
                            {{--                                <div class="col-sm-3" style="padding-right: 0 !important;">--}}
                            {{--                                    <img src="{{ asset('public/mySource/imgs/products/1652696195.png') }}" alt=""--}}
                            {{--                                         style="width: 100%; border-radius: 5px">--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-sm-9">--}}
                            {{--                                    <div class="row " style="padding-left: 10px;">--}}
                            {{--                                        <strong>iPhone 13 Pro Max</strong>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row" style="padding-left: 10px;">--}}
                            {{--                                        32.000.000 VND--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            </a>--}}


                        </div>
                    </div>


                </div>
            </div>

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                @if(!Auth::user())
                    <button type="button" class="btn btn-block btn-outline-primary btnLoginModal">Đăng nhập</button>
                @else

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" style="margin-top: -5px;">
                            <img class="direct-chat-img" src="{{ asset(Auth::user()->profile->image) }}"
                                 alt="message user image">
                            @if(Auth::user()->email_verified_at == null)
                                <span class="badge badge-danger navbar-badge">!</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 0">
                            <span class="dropdown-item text-center" style="font-weight: bolder">{{ Auth::user()->name }}</span>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item btnInfo">
                                <i class="fa-solid fa-circle-info mr-2"></i> Thông tin cá nhân
                            </button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item btnFavModal">
                                <i class="fa-solid fa-heart mr-2"></i> Yêu thích
                                <span class="float-right text-white text-sm badge badge-danger countFav"> 0 </span>
                            </button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item btnHistory">
                                <i class="fa-solid fa-clock-rotate-left mr-2"></i> Lịch sử mua hàng
                            </button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item btnChangePass">
                                <i class="fa-solid fa-key mr-2"></i> Đổi mật khẩu
                            </button>
                            @if(Auth::user()->email_verified_at == null)
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item btnVerifyEmail">
                                    <i class="fa-solid fa-envelope mr-2"></i> Xác thực email
                                    <span class="float-right text-white text-sm badge badge-danger"> ! </span>
                                </button>
                            @else
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-item text-primary">
                                    <i class="fa-solid fa-envelope-circle-check mr-2"></i> Đã xác thực
                                </span>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer">Đăng xuất</a>
                        </div>
                    </li>

                @endif
            </ul>


        </div>
    </nav>


    <div class="content-wrapper" style="min-height: 374px; background-color: black">

        @yield('content')

    </div>


    <!-- FOOTER -->
    <footer class="w-100 py-4 flex-shrink-0 bg-dark no-print" style="padding-bottom: 0 !important;">
        <div class="container py-4" style="max-width: 1500px">
            <div class="row gy-4 gx-5">
                <div class="col-lg-4 col-md-6 text-center">
                    <img src="{{ asset('public/mySource/imgs/logo/logo_v2.png') }}" alt="" style="height: 150px">
                    <h5 class="h1 text-black">Điện máy <strong>ĐEN</strong></h5>

                    <p class="small text-muted"> 88 Phạm Thái Bường Phường 4, Vĩnh Long, Việt Nam</p>
                    <p class="small  mb-0">&copy; Copyrights <a class="text-primary" href="{{ route('home') }}">dienmayden.com</a>
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <ul class="list-unstyled  mt-3">
                        <li class="mb-3"><a
                                href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'dien-thoai') }}"
                                style="color: whitesmoke"><i class="fa-solid fa-mobile-button mr-2"></i>Điện thoại</a>
                        </li>
                        <li class="mb-3"><a
                                href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'laptop') }}"
                                style="color: whitesmoke"><i class="fa-solid fa-laptop mr-2"></i>Laptop</a></li>
                        <li class="mb-3"><a
                                href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'may-tinh-ban') }}"
                                style="color: whitesmoke"><i class="fa-solid fa-computer mr-2"></i>Máy tính bàn (PC)</a>
                        </li>
                        <li class="mb-3"><a
                                href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'dong-ho-thong-minh') }}"
                                style="color: whitesmoke"><i class="fa-solid fa-clock mr-2"></i>Đồng hồ thông minh</a>
                        </li>
                        <li class="mb-3"><a
                                href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'may-tinh-bang') }}"
                                style="color: whitesmoke"><i class="fa-solid fa-tablet mr-2"></i>Máy tính bảng</a></li>
                        <li class="mb-3"><a
                                href="{{ action('App\Http\Controllers\categoryController@getViewGuest', 'phu-kien') }}"
                                style="color: whitesmoke"><i class="fa-solid fa-headphones-simple mr-2"></i>Phụ kiện</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <ul class="list-unstyled  mt-3">
                        <li class="mb-3"><a href="#" style="color: whitesmoke">Tuyển dụng</a></li>
                        <li class="mb-3"><a href="#" style="color: whitesmoke">Gửi báo lỗi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <h5 class="mb-3">Liên hệ với chúng tôi</h5>
                    <p class="small "><i class="fas fa-envelope mr-1"></i>Email: dienmayden@gmail.com</p>
                    <p class="small "><i class="fas fa-phone mr-1"></i>Tư vấn mua hàng: 0849 211 557</p>
                    <p class="small "><i class="fas fa-phone mr-1"></i>Hỗ trợ kỹ thuật: 0849 211 557</p>
                    <p class="small "><i class="fas fa-phone mr-1"></i>Báo lỗi: 0849 211 557</p>
                </div>
            </div>
        </div>
    </footer>

</div>
<!-- ./wrapper -->

</div>

<div class="no-print" style="position: fixed; bottom: 5%; right: 2%; width: 350px;">

    <div class="card direct-chat direct-chat-primary boxChat" style="height: 400px">
        <div class="card-header">
            <img class="direct-chat-img" src="{{ asset('public/mySource/imgs/logo/logo_v2.png') }}"
                 alt="message user image">
            <div class="mt-2">
                <span class="ml-2"> Chào mừng đến <b>Điện máy Đen</b></span>
            </div>
        </div>
        <div class="card-body ">
            <div class="direct-chat-messages boxMessage">
                {{--            <div class="direct-chat-messages">--}}
                {{--                <div class="direct-chat-msg">--}}
                {{--                    <img class="direct-chat-img" src="{{ asset('public/mySource/imgs/logo/logo_v2.png') }}"--}}
                {{--                         alt="message user image">--}}

                {{--                    <div class="direct-chat-text"--}}
                {{--                         style="display: inline-block; float: left; margin-left: 10px !important;">--}}
                {{--                        Is this template really for free? That's unbelievable!--}}
                {{--                    </div>--}}

                {{--                </div>--}}


                {{--                <div class="direct-chat-msg right">--}}

                {{--                    <img class="direct-chat-img" src="{{ asset('public/mySource/imgs/avatars/unknow.jpg') }}"--}}
                {{--                         alt="message user image">--}}

                {{--                    <div class="direct-chat-text"--}}
                {{--                         style="display: inline-block; float: right; margin-right: 10px !important;">--}}
                {{--                        You better believe it!--}}
                {{--                    </div>--}}

                {{--                </div>--}}
                {{--            </div>--}}

            </div>

        </div>
        <div class="card-footer">
            <div class="input-group">
                <input type="text" name="" placeholder="Aa..."
                       class="form-control writeMess">
                <span class="input-group-append">
<button type="button" class="btn btn-primary btnSentMess">Gửi</button>
</span>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-outline-secondary btn-lg btnMess"
            style="border-radius: 50%; font-size: 1.7rem; float: right; position: relative">
        <i class="fa-solid fa-comments"></i>
        <span class="badge badge-danger navbar-badge textAlert"
              style="position: absolute; top: 0; right: 0; font-size: 15px">!</span>

    </button>

</div>

@if(!Auth::user())
    <div class="modal fade" id="modalLogin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng nhập</h4>
                    <button type="button" class="close btnCloseLogin" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control nameLogin" placeholder="Tên đăng nhập">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control passLogin" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <p class="ml-3">
                        Bạn chưa có tài khoản? <a href="#" class="text-primary text-center btnRegisShow" style="">Đăng
                            ký</a>
                    </p>
                    <p class="ml-3">
                        <a href="#" class="text-primary text-center btnForgetPass" style="">Quên mật khẩu</a>
                    </p>


                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnCloseLogin">Đóng</button>
                    <button type="button" class="btn btn-primary btnLogin">Đăng nhập</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <div class="modal fade" id="modalReset">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đổi mật khẩu</h4>
                    <button type="button" class="close btnCloseReset" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Mã xác nhận:</label>
                        <input type="text" class="form-control codeReset">
                    </div>

                    <div class="form-group">
                        <label for="">Mật khẩu mới:</label>
                        <input type="password" class="form-control passUserNew">
                    </div>

                    <div class="form-group">
                        <label for="">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control passUserNew2">
                    </div>


                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnCloseReset">Đóng</button>
                    <button type="button" class="btn btn-primary btnReset">Đổi mật khẩu</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <div class="modal fade" id="modalRegis">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng ký tài khoản</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tên người dùng:</label>
                        <input type="text" class="form-control nameUser">
                    </div>

                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="text" class="form-control emailUser">
                        <span class="text-danger sttEmail"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Mật khẩu:</label>
                        <input type="password" class="form-control passUser">
                        <span class="text-danger sttPass"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control passUser">
                        <span class="text-danger sttPass2"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btnCloseRegis">Đóng</button>
                    <button type="button" class="btn btn-outline-primary btnRegis">Đăng ký</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@else

    <div class="modal fade" id="modalInfo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin cá nhân</h4>
                    <button type="button" class="close btnCloseInfo" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" id="image" hidden>
                        <div class="col-md-4 text-center">
                            <img class="avatarInfo" src="{{ asset(Auth::user()->profile->image) }}" alt=""
                                 style="border-radius: 50%; width: 100%">
                            <button type="button" class="btn btn-outline-secondary btn-xs btnUpload">
                                <i class="fa-solid fa-camera mr-1"></i> Chọn ảnh
                            </button>
                        </div>
                        <div class="col-md-8 mt-4">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Tên người dùng:</label>
                                    <input type="text" class="form-control nameInFo" value="{{ Auth::user()->name }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="phoneInfo" class="">Số điện thoại</label>
                                    <input type="text" class="form-control phoneInfo" id="phoneInfo"
                                           data-inputmask="'mask': ['9999-999-999']"
                                           data-mask="" inputmode="text"
                                           value="{{ Auth::user()->profile->phone_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label for="">Địa chỉ:</label>
                                <input type="text" class="form-control addInfo"
                                       value="{{ Auth::user()->profile->address }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label for="">Ghi chú:</label>
                                <textarea
                                    class="form-control desInfo">{{ Auth::user()->profile->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnCloseInfo">Đóng</button>
                    <button type="button" class="btn btn-primary btnUpdate">Cập nhật</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cắt ảnh</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" style="margin-top:30px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btnCloseUpload">Đóng</button>
                    <button type="button" class="btn btn-outline-primary btnReChoose">Chọn lại</button>
                    <button type="button" class="btn btn-outline-primary crop_image">Cắt và lưu</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalFavourite">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sản phẩm yêu thích</h4>
                    <a href="{{ action('App\Http\Controllers\orderController@getView') }}"
                       class="btn btn-outline-success mr-5">
                        <i class="fa-solid fa-cart-shopping"></i> Thanh toán hết
                    </a>
                </div>
                <div class="modal-body p-5 listFav" style="overflow-y: scroll; max-height: 500px;">

                    {{--                    <div class="row itemFav mb-3"  style="border: black solid 1px; border-radius: 5px">--}}
                    {{--                        <div class="col-md-4 text-center">--}}
                    {{--                            <img src="{{ asset('public/mySource/imgs/products/1653034968.png') }}" alt="" style="">--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-md-8 row align-items-center">--}}
                    {{--                            <a href="#" class="col-sm-7 btnItemFav">--}}
                    {{--                                <h4>Macbook Pro 2021</h4>--}}
                    {{--                                <p>--}}
                    {{--                                    <i class="fa-brands fa-invision"></i> Apple--}}
                    {{--                                    <i class="fa-solid fa-memory ml-2"></i> 8 GB--}}
                    {{--                                </p>--}}
                    {{--                                <span>--}}
                    {{--                                        <i class="fa-solid fa-microchip"></i> M1--}}
                    {{--                                    </span>--}}
                    {{--                            </a>--}}
                    {{--                            <div class="col-sm-5">--}}
                    {{--                                <button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-cart-shopping"></i> Mua ngay</button>--}}
                    {{--                                <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-x"></i></button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger float-right btnCloseFavModal">Đóng</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="modalChangePass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thay đổi mật khẩu</h4>
                    <button type="button" class="close btnCloseChangePass" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Mật khẩu hiện tại:</label>
                        <input type="password" class="form-control oldPass">
                    </div>

                    <div class="form-group">
                        <label for="">Mật khẩu mới:</label>
                        <input type="password" class="form-control newPass">
                        <span class="text-danger sttPassNew"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Nhập lại mật khẩu mới:</label>
                        <input type="password" class="form-control newPass2">
                    </div>


                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnCloseChangePass">Đóng</button>
                    <button type="button" class="btn btn-primary btnChangePassSave">Thay đổi</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalBuy">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formTran" action="{{ action('App\Http\Controllers\billController@addBill') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xác nhận đơn hàng</h4>
                        <button type="button" class="close btnCloseBuy" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-2 row align-items-center">


                        <div class="col-md-6 align-items-center " style="padding-right: 0;padding-left: 10px;">
                            <div class="row align-items-center pl-2">
                                <div class="col-md-4 text-center">
                                    <img class="imgProduct" src="" alt=""
                                         style="width: 100%">
                                </div>
                                <div class="col-md-8 ">
                                    <h3 class="mr-2"><b class="nameProduct"></b></h3>
                                    <h4 class="mr-2">Giá: <b class="priceProduct"></b> VND</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="pl-5 mb-3">
                                <b>Chọn phương thức thanh toán:</b>
                            </div>

                            <div class="row">

                                <div class="col-sm-12  pl-5 pr-5 mb-3">
                                    <input class="radioTienMat" type="radio" name="radioTran" value="0" hidden
                                           checked>
                                    <div class="row rbtnTran rbtnTienMat" style="border-radius: 5px; ">
                                        <div class="col-sm-3 text-center iconTran"
                                             style="border-right: #C5C5C5 solid 2px; border-bottom-left-radius: 5px; border-top-left-radius: 5px;">
                                            <i class="fa-solid fa-money-bill-wave col-12"
                                               style="font-size: 30px; margin-top: 10px; padding-left: 0; padding-right: 0"></i>
                                        </div>
                                        <div class="col-sm-9 pl-3">
                                            <span style="font-size: 1.2rem"><b>Tiền mặt</b></span><br>
                                            <span class="small">Thanh toán khi nhận hàng</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 pl-5 pr-5">
                                    <input class="radioVNPay" type="radio" name="radioTran" value="1" hidden>
                                    <div class="row rbtnTran rbtnVNpay" style="border-radius: 5px; ">
                                        <div class="col-sm-3 text-center iconTran"
                                             style="border-right: #C5C5C5 solid 2px; border-bottom-left-radius: 5px; border-top-left-radius: 5px;">
                                            <i class="fa-solid fa-credit-card col-12"
                                               style="font-size: 30px; margin-top: 10px; padding-left: 0; padding-right: 0"></i>
                                        </div>
                                        <div class="col-sm-9 pl-3">
                                            <span style="font-size: 1.2rem"><b>VNPay</b></span><br>
                                            <span class="small">Giảm 5%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="form-group col-md-6 p-3 mb-0">
                            <label for="">Họ tên người người nhận:</label>
                            <input type="text" class="form-control nameTran" name="name"
                                   value="{{ Auth::user()->name }}">
                        </div>

                        <div class="form-group col-md-6 p-3 mb-0">
                            <label for="">Số điện thoại:</label>
                            <input type="text" class="form-control phoneTran" name="phone_number"
                                   data-inputmask="'mask': ['9999-999-999']"
                                   data-mask="" inputmode="text" value="{{ Auth::user()->profile->phone_number }}">
                        </div>

                        <div class="form-group col-md-12 p-3 mb-0">
                            <label for="">Địa chỉ:</label>
                            <input type="text" class="form-control addTran" name="address"
                                   value="{{ Auth::user()->profile->address }}">
                        </div>

                        <div class="form-group col-md-12 p-3 mb-0">
                            <label for="">Ghi chú:</label>
                            <textarea class="form-control desTran"
                                      name="description">{{ Auth::user()->profile->description }}</textarea>
                        </div>


                    </div>

                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default btnCloseBuy">Đóng</button>
                        <button type="submit" name="redirect" class="btn btn-primary btnBuyConfirm">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <!-- /.modal -->





    <div class="modal fade" id="modalHistory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lịch sử mua hàng</h4>
                    <button type="button" class="close btnCloseHistory" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <table id="historyTable"
                           class="table table-hover dataTable dtr-inline projects"
                           role="grid"
                           aria-describedby="example1_info" style="text-align: center">
                        <thead>
                        <tr role="row">
                            <th style="width:10px">#</th>
                            <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                                colspan="1" aria-sort="ascending"
                                style=""> Mã hóa đơn
                            </th>
                            <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 300px"> Thời gian
                            </th>
                            <th style="width:100px">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default btnCloseHistory float-right">Đóng</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <!-- /.modal -->

@endif


<script src="{{asset("public/plugins/jquery/jquery.min.js")}}"></script>

<script src="{{asset("public/plugins/jquery-ui/jquery-ui.min.js")}}"></script>

<script src="{{asset("public/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<script src="{{asset("public/plugins/sparklines/sparkline.js")}}"></script>

<script src="{{asset("public/plugins/jquery-knob/jquery.knob.min.js")}}"></script>

<script src="{{asset("public/plugins/moment/moment.min.js")}}"></script>

<script src="{{asset("public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>

<script src="{{asset("public/plugins/summernote/summernote-bs4.min.js")}}"></script>

<script src="{{asset("public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>

<script src="{{asset("public/dist/js/adminlte.js?v=3.2.0")}}"></script>

<script src="{{asset("public/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/dt-1.11.5/sl-1.3.4/sr-1.1.0/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

<script src="{{ asset("public/plugins/inputmask/jquery.inputmask.min.js") }}"></script>

<script src="{{ asset('public/mySource/js/jquery.maskMoney.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.common.min.js"></script>

@yield('script')

<script>

    var image_avatar = '';
    var timeout = null;
    var check_email = false;
    var check_pass = false;
    var check_pass_new = false;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const formatToCurrency = amount => {
        return "" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&.");
    };

    var isFocus = false;

    var BOXSEARCH = '{{ action('App\Http\Controllers\productController@getBoxSearch') }}'


    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: `${window.location.hostname}:6001`,
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.boxChat').hide()

        $('.btnMess').click(function () {

            @if(Auth::user())

            getListChat()

            $('.textAlert').html('');
            $('.boxChat').toggle();
            @else
            $('.btnLoginModal').click()
            @endif
        })

        @if(Auth::user())

            $(document).on('click','.btnDetailHis', function () {

            var url = '{{ action('App\Http\Controllers\billController@getViewBill',1) }}'
            url = url.substring(0, url.length-1)
            window.location = url + $(this).attr('data');

        })

        $('.btnHistory').click(function () {
            $('#modalHistory').modal('show')
        })

        $('.btnCloseHistory').click(function () {
            $('#modalHistory').modal('hide')
        })

        $('#historyTable').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "serverSide": true,
            "ajax": '{{ action('App\Http\Controllers\billController@getDataTable') }}',
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ]
        });

        var getListChat = function () {
            $.ajax({
                url: '{{ action('App\Http\Controllers\messageController@getList') }}',
                type: "GET",
                data: {},
                success: function (result) {
                    $('.boxMessage').html(result)
                    $('.boxMessage').scrollTop($('.boxMessage').height() + 9999);
                }
            });
        }

        var sentMess = function () {
            if ($('.writeMess').val() === '') return

            $.post("{{ action('App\Http\Controllers\messageController@sentMess') }}", {"message": $('.writeMess').val()})
            $('.writeMess').val('')
        }


        window.Echo.channel('chat')
            .listen('.chat-{{ Auth::user()->id }}', (e) => {

                if ($('.boxChat').is(":hidden")) $('.textAlert').html('!');
                getListChat()
            });

        $('.writeMess').focusin(function () {
            $('.textAlert').html('');
        })

        $('.writeMess').on('keypress', function (e) {
            if (e.which == 13) {
                sentMess()
            }
        });

        $('.btnSentMess').click(function () {
            sentMess()
        })

        @endif



        $(document).on('click', '.btnBuy', function () {
            @if(Auth::user())

            @if(Auth::user()->email_verified_at == null)
            Swal.fire(
                'Không đủ điều kiện!',
                'Hãy xác thực tài khoản của bạn trước khi tiến hành giao dịch',
                'warning'
            )
            @else

            var data = jQuery.parseJSON($(this).attr('data'))
            var img_link = data.image

            if (data.status === 0){
                Swal.fire({
                    title: 'Sản phẩm đã hết?',
                    text: "Nếu bạn vẫn muốn mua, có thể sẽ mất vài ngày để chúng tôi chuẩn bị. BẠN VẪN MUỐN?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.imgProduct').attr('src', 'http://' + document.domain + '/' + img_link)
                        $('.nameProduct').html(data.name)

                        var price = formatToCurrency(data.price).toString()
                        price = price.slice(0, price.length - 3)
                        $('.priceProduct').html(price)


                        $('.btnBuyConfirm').attr('data', data.id)
                        $('#modalBuy').modal('show')

                    }
                })
            }

            @endif
            @else

            $('.btnLoginModal').click()

            @endif
        })

        $('.btnCloseBuy').click(function () {
            $('#modalBuy').modal('hide')
        })


        $(document).on('click', '.btnAddFav', function () {
            @if(Auth::user())

            var product_id = $(this).attr('data')

            $.ajax({
                url: '{{ action('App\Http\Controllers\favouriteController@addFavourite') }}',
                type: "PUT",
                data: {
                    'product_id': product_id,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        Toast.fire({
                            icon: 'success',
                            title: result.message
                        })
                        getCountFav()
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: result.message
                        })
                    }
                }
            });

            @else

            $('.btnLoginModal').click()

            @endif
        })


        $('.btnInfo').click(function () {
            $('#modalInfo').modal('show');
        })

        $('.btnCloseInfo').click(function () {
            $('#modalInfo').modal('hide');
        })

        @if(!Auth::user())

        $('.btnLoginModal').click(function () {
            $('.nameLogin').val('')
            $('.passLogin').val('')
            $('#modalLogin').modal('show')
        })

        $(".nameLogin, .passLogin").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                $('.btnLogin').click()
            }
        });


        $('.btnCloseLogin').click(function () {
            $('#modalLogin').modal('hide')
        })

        $('.btnRegisShow').click(function () {
            $('#modalLogin').modal('hide')
            $('#modalRegis').modal('show')
        })

        $('.btnCloseRegis').click(function () {
            $('#modalRegis').modal('hide')
        })

        $('.passUser').keyup(function () {

            if ($(this).val().length === 0) {
                $('.sttPass').html('');
                check_pass = false;
                return
            }

            if ($(this).val().length < 6) {
                $('.sttPass').html('Mật khẩu phải từ 6 ký tự trở lên!');
                check_pass = false;
            } else {
                $('.sttPass').html('');
                check_pass = true;
            }

        })

        $('.emailUser').keyup(function () {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ($(this).val().length === 0) {
                $('.sttEmail').html('');
                check_email = false;
                return;
            }

            if (!regex.test($(this).val())) {
                $('.sttEmail').html('Email không hợp lệ!');
                check_email = false;
                return;
            } else {
                $('.sttEmail').html('');
                check_email = true;
            }

            var _this = $(this);

            clearTimeout(timeout);
            timeout = setTimeout(function () {
                $.ajax({
                    url: '{{ action('App\Http\Controllers\userController@checkEmail') }}',
                    type: "POST",
                    data: {
                        'email': $('.emailUser').val(),
                    },
                    success: function (result) {
                        if (result) {
                            check_email = false;
                            $('.sttEmail').html('Email đã có người sử dụng!');
                        } else {
                            check_email = true;
                            $('.sttEmail').html('');
                        }

                    }
                });

            }, 500);

        })

        $('.btnRegis').click(function () {
            if ($('.nameUser').val() === '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Tên người dùng không được bỏ trống!'
                })
                return
            }

            if (!check_email) {
                Toast.fire({
                    icon: 'error',
                    title: 'Email không hợp lệ!'
                })
                return;
            }

            if (!check_pass) {
                Toast.fire({
                    icon: 'error',
                    title: 'Mật khẩu không hợp lệ!'
                })
                return;
            }

            if ($('.sttPass').val() !== $('.sttPass2').val()){
                Toast.fire({
                    icon: 'error',
                    title: 'Mật khẩu không thông nhất!'
                })
                return;
            }

            $.ajax({
                url: '{{ action('App\Http\Controllers\userController@regis') }}',
                type: "PUT",
                data: {
                    'name': $('.nameUser').val(),
                    'email': $('.emailUser').val(),
                    'password': $('.passUser').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        Swal.fire(
                            'Đăng ký thành công!',
                            result.message,
                            'success'
                        )
                        $('.nameUser').val('')
                        $('.emailUser').val('')
                        $('.passUser').val('')
                        $('#modalRegis').modal('hide')
                    } else {
                        Swal.fire(
                            'Đăng ký thất bại!',
                            result.message,
                            'error'
                        )
                    }
                }
            });
        })

        $('.btnLogin').click(function () {
            $.ajax({
                url: '{{ action('App\Http\Controllers\loginController@login') }}',
                type: "POST",
                data: {
                    'email': $('.nameLogin').val(),
                    'password': $('.passLogin').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thao tác thất bại',
                            text: result.message,
                        })
                    }
                }
            });
        });

        @else

        $('[data-mask]').inputmask();

        $('.btnUpload').click(function () {
            $('#image').click();
        });
        $('.btnReChoose').click(function () {
            $('#image').click();
        });
        $('.btnCloseUpload').click(function () {
            $('#uploadimageModal').modal('hide');
        });

        var image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#image').change(function () {

            let reader = new FileReader();

            reader.onload = (e) => {
                image_crop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    // console.log('jQuery bind complete');
                });

                // $('#image_preview_container').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function (event) {
            image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                // console.log(response);
                image_avatar = response;
                $('.avatarInfo').attr('src', response);
            })
            $('#uploadimageModal').modal('hide');
        });

        $('.btnUpdate').click(function () {

            var fd = new FormData();
            fd.append('image', image_avatar);
            fd.append('name', $('.nameInFo').val());
            fd.append('phone_number', $('.phoneInfo').val());
            fd.append('address', $('.addInfo').val());
            fd.append('description', $('.desInfo').val());


            $.ajax({
                url: '{{ action('App\Http\Controllers\profileController@updateGuest') }}',
                type: "POST",
                processData: false,
                contentType: false,
                data: fd,
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thao tác thành công',
                            showConfirmButton: false,
                            text: result.message,
                        })
                        setTimeout(function () {
                            window.location.reload();
                        }, 1200);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thao tác thất bại',
                            text: result.message,
                        })
                    }

                }
            });
        })

        var getListFav = function () {
            $.ajax({
                url: '{{ action('App\Http\Controllers\favouriteController@getList') }}',
                type: "GET",
                data: {},
                success: function (result) {
                    $('.listFav').html(result);
                }
            });
        }

        var getCountFav = function () {
            $.ajax({
                url: '{{ action('App\Http\Controllers\favouriteController@getCount') }}',
                type: "GET",
                data: {},
                success: function (result) {
                    $('.countFav').html(result);
                }
            });
        }

        getCountFav()

        $('.btnFavModal').click(function () {
            getListFav()
            $('#modalFavourite').modal('show')
        })

        $('.btnCloseFavModal').click(function () {
            $('#modalFavourite').modal('hide')
        })

        $(document).on('click', '.btnDelFav', function () {
            var name = $(this).attr('name')
            Swal.fire({
                title: 'Xóa ' + name + ' khỏi danh sách yêu thích?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    var fav_id = $(this).attr('data')

                    $.ajax({
                        url: '{{ action('App\Http\Controllers\favouriteController@deleteFavourite') }}',
                        type: "GET",
                        data: {
                            'id': {{ Auth::user()->id }},
                            'fav_id': fav_id,
                        },
                        success: function (result) {
                            result = JSON.parse(result);
                            if (result.status === 200) {
                                Toast.fire({
                                    icon: 'success',
                                    title: result.message
                                })
                                getListFav()
                                getCountFav()
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: result.message
                                })
                            }
                        }
                    });
                }
            })
        })

        $('.btnChangePass').click(function () {
            $('.oldPass').val('')
            $('.newPass').val('')
            $('.newPass2').val('')
            $('#modalChangePass').modal('show')
        })
        $('.btnCloseChangePass').click(function () {
            $('#modalChangePass').modal('hide')
        })
        $('.newPass').keyup(function () {

            if ($(this).val().length === 0) {
                $('.sttPassNew').html('');
                check_pass_new = false;
                return
            }

            if ($(this).val().length < 6) {
                $('.sttPassNew').html('Mật khẩu phải từ 6 ký tự trở lên!');
                check_pass_new = false;
            } else {
                $('.sttPassNew').html('');
                check_pass_new = true;
            }

        })
        $('.btnChangePassSave').click(function () {
            if (!check_pass_new) {
                Toast.fire({
                    icon: 'error',
                    title: 'Mật khẩu không hợp lệ!'
                })
                return;
            }

            if ($('.newPass').val() !== $('.newPass2').val()) {
                Toast.fire({
                    icon: 'error',
                    title: 'Mật khẩu không thống nhất!'
                })
                return;
            }

            $.ajax({
                url: '{{ action('App\Http\Controllers\userController@changePass') }}',
                type: "POST",
                data: {
                    'old_password': $('.oldPass').val(),
                    'new_password': $('.newPass').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        Swal.fire(
                            'Thay đổi thành công!',
                            result.message,
                            'success'
                        )
                        $('.oldPass').val('')
                        $('.newPass').val('')
                        $('.newPass2').val('')
                        $('#modalChangePass').modal('hide')
                    } else {
                        Swal.fire(
                            'Thay đổi thất bại!',
                            result.message,
                            'error'
                        )
                    }
                }
            });
        })


        $('#formTran').submit(function (eventObj) {

            if ($('.nameTran').val() === '' || $('.phoneTran').val() === '' || $('.addTran').val() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'Vui lòng cung cấp đầy đủ thông tin liên hệ!'
                })
                eventObj.preventDefault();
            }

            var product_id = $('.btnBuyConfirm').attr('data')
            var arr = []
            arr.push("{\"product_id\":" + product_id + ", \"quantity\":1}")
            // arr = JSON.stringify(arr)

            console.log(arr)
            $(this).append('<input type="hidden" id="arrTran" name="products" value="" /> ');
            $('#arrTran').val(JSON.stringify(arr))

            return true;
        })

        $('.btnBuyConfirm').click(function () {
        })

        $('[data-mask]').inputmask();

        $('.rbtnTienMat').click(function () {
            $('.radioTienMat').prop("checked", true);
        })

        $('.rbtnVNpay').click(function () {
            $('.radioVNPay').prop("checked", true);
        })

        // border: #C5C5C5 solid 2px
        // background-color: rgba(197, 197, 197, 0.45);
        $('.rbtnTienMat').css('border', 'black solid 2px')
        $('.rbtnTienMat').children('.iconTran').css('background-color', 'rgba(100, 100, 100, 1)')

        $('.rbtnTran').click(function () {
            $('.rbtnTran').css('border', '#C5C5C5 solid 2px')
            $(this).css('border', 'black solid 2px')

            $('.iconTran').css('background-color', 'rgba(197, 197, 197, 0.45)')
            $(this).children('.iconTran').css('background-color', 'rgba(100, 100, 100, 1)')
        })


        @endif




        $(".inputSearch").focusin(function () {
            $('.boxSearch').show()
        });

        $(document).mouseup(function(e)
        {
            if (!$('.itemSearch').is(e.target) && $('.itemSearch').has(e.target).length === 0)
            {
                if (!$('.inputSearch').is(e.target) && $('.inputSearch').has(e.target).length === 0)
                {
                    $('.boxSearch').hide()
                }
            }
        });



        $('.boxSearch').hide()

        var timeout = null;
        $('.inputSearch').keyup(function () {
            if ($(this).val() === '') {
                $('.boxSearch').hide()
            } else {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    $.ajax({
                        url: BOXSEARCH,
                        type: "GET",
                        data: {
                            'slug': $('.inputSearch').val(),
                        },
                        success: function (result) {
                            $('.boxSearch').html(result)
                            $('.boxSearch').show()
                        }
                    });

                }, 500)
            }

        });


        @if(Auth::user())

        $('.btnVerifyEmail').click(function () {

            Swal.showLoading();

            Swal.fire({
                title: 'Xác nhận?',
                text: "Email xác thực sẽ được gửi đến email của bạn!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    let timerInterval
                    Swal.fire({
                        title: 'Đang xử lý ...',
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {})

                    $.ajax({
                        url: '{{ action('App\Http\Controllers\userController@sendVerifyEmail') }}',
                        type: "POST",
                        data: {
                        },
                        success: function (result) {
                            Swal.hideLoading();
                            result = JSON.parse(result);
                            if (result.status === 200) {
                                Swal.fire(
                                    'Email đã được gửi!',
                                    result.message,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Hãy thử lại sau!',
                                    result.message,
                                    'error'
                                )
                            }
                        }
                    });
                }
            })

        })
        @endif


        $('.btnForgetPass').click(async function () {

            $('#modalLogin').modal('hide')

            Swal.showLoading();


            const {value: email} = await Swal.fire({
                title: 'Quên mật khẩu',
                input: 'text',
                inputLabel: 'Hãy nhập email của bạn',
                showCancelButton: true,
                cancelButtonText: 'Hủy',
                reverseButtons: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Email không được bỏ trống!'
                    }
                }
            })


            if (email) {
                $('.btnReset').attr('data',email)

                let timerInterval
                Swal.fire({
                    title: 'Đang xử lý ...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                })

                $.ajax({
                    url: '{{ action('App\Http\Controllers\userController@sendCodeResetPass') }}',
                    type: "POST",
                    data: {
                        'email': `${email}`,
                    },
                    success: function (result) {
                        Swal.hideLoading();
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao tác thành công',
                                text: result.message,
                            })
                            $('#modalReset').modal('show')
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao tác thất bại',
                                text: result.message,
                                showConfirmButton: true,
                            })
                        }
                    }
                });

            }

        })


        $('.btnCloseReset').click(function () {
            $('#modalReset').modal('hide')
            $('.codeReset').val('')
            $('.passUserNew').val('')
            $('.passUserNew2').val('')
        })


        $('.btnReset').click(function () {
            if ($('.passUserNew').val().length < 6){
                Toast.fire({
                    icon: 'warning',
                    title: 'Mật khẩu phải từ 6 ký tự trở lên!'
                })
                return;
            }

            if ($('.passUserNew').val() !== $('.passUserNew2').val()){
                Toast.fire({
                    icon: 'warning',
                    title: 'Mật khẩu không thống nhất!'
                })
                return;
            }

            var uEmail = $(this).attr('data')

            $.ajax({
                url: '{{ action('App\Http\Controllers\userController@resetPass') }}',
                type: "POST",
                data: {
                    'token': $('.codeReset').val(),
                    'password': $('.passUserNew').val(),
                    'email': uEmail,
                },
                success: function (result) {
                    Swal.hideLoading();
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thao tác thành công',
                            text: result.message,
                            showConfirmButton: true,
                        })
                        $('.btnCloseReset').click()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thao tác thất bại',
                            text: result.message,
                            showConfirmButton: true,
                        })
                    }
                }
            });
        })

    })
</script>
</body>
</html>

