<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <meta content="width=device-width, initial-scale=0.47, maximum-scale=1.0, user-scalable=1" name="viewport">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <title>Điện máy Đen Admin</title>
    <link rel="icon" href="{{ asset('public/mySource/imgs/logo/logo_v2.png') }}"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

{{--    <link rel="stylesheet" href="{{asset("public/plugins/fontawesome-free/css/all.min.css")}}">--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/sl-1.3.4/sr-1.1.0/datatables.min.css"/>

    <link rel="stylesheet" href="{{asset("public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">

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
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .btnEdit {
            color: black;
        }

        .btnDelete {
            color: red;
        }


    </style>

    @yield('style')

</head>
<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link">Trang người dùng</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{action('App\Http\Controllers\productController@getView') }}" class="nav-link">Sản phẩm</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge totalNoti" >0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-md-left dropdown-menu-right">
                    <a href="{{ action('App\Http\Controllers\messageController@getView') }}" class="dropdown-item">
                        <i class="fa-solid fa-comments mr-2"></i> <span class="qtyMess">0</span> tin nhắn mới
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ action('App\Http\Controllers\billController@getViewAdmin') }}" class="dropdown-item">
                        <i class="fa-solid fa-cart-shopping mr-2"></i> <span class="qtyOrder">0</span> đơn hàng mới
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin-logout') }}" role="button">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </li>

        </ul>

    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link">
            <img src="{{ asset("public/mySource/imgs/logo/logo_v2.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Điện máy Đen</span>
        </a>

        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 322px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">

                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="{{ asset( Auth::user()->profile['image'] ) }}" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                            </div>
                        </div>


                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                                <li class="nav-item">
                                    <a href="{{ route('home-admin') }}" class="nav-link">
                                        <i class="nav-icon fa-solid fa-house"></i>
                                        <p>
                                            Trang chủ
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ action('App\Http\Controllers\brandController@getView') }}" class="nav-link">
                                        <i class="nav-icon fa-brands fa-invision"></i>
                                        <p>
                                            Thương hiệu
                                        </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-bars"></i>
                                        <p>
                                            Danh mục
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ action('App\Http\Controllers\categoryController@getView','dien-thoai') }}" class="nav-link">
                                                <i class="fa-solid fa-mobile-screen-button nav-icon ml-4"></i>
                                                <p>Điện thoại</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ action('App\Http\Controllers\categoryController@getView', 'laptop') }}" class="nav-link">
                                                <i class="fa-solid fa-laptop nav-icon ml-4"></i>
                                                <p>Laptop</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ action('App\Http\Controllers\categoryController@getView', 'may-tinh-ban') }}" class="nav-link">
                                                <i class="fa-solid fa-computer nav-icon ml-4"></i>
                                                <p>Máy tính bàn (PC)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ action('App\Http\Controllers\categoryController@getView', 'dong-ho-thong-minh') }}" class="nav-link">
                                                <i class="fa-solid fa-clock nav-icon ml-4"></i>
                                                <p>Đồng hồ thông minh</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ action('App\Http\Controllers\categoryController@getView', 'may-tinh-bang') }}" class="nav-link">
                                                <i class="fa-solid fa-tablet nav-icon ml-4"></i>
                                                <p>Máy tính bảng</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ action('App\Http\Controllers\categoryController@getView', 'phu-kien') }}" class="nav-link">
                                                <i class="fa-solid fa-headphones nav-icon ml-4"></i>
                                                <p>Phụ kiện</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                @if(Auth::user()->permission == 3)

                                <li class="nav-item">
                                    <a href="{{ action('App\Http\Controllers\userController@getView') }}" class="nav-link">
                                        <i class="nav-icon fa-solid fa-user"></i>
                                        <p>
                                            Tài khoản
                                        </p>
                                    </a>
                                </li>

                                @endif


                            </ul>
                        </nav>

                    </div>
                </div>
            </div>

            <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="height: 23.7675%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>

    </aside>

    <div class="content-wrapper" style="min-height: 266px;">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @yield('header')
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">


            @yield('content')


        </section>


    </div>

    <footer class="main-footer">
        <strong>Copyright ©  <a href="https://www.facebook.com/nhynhyy2302/">Võ Ngọc Thanh Hào</a> & <a href="https://www.facebook.com/tuyetnhi2302">Nguyễn Thị Tuyết Nhi</a></strong>
    </footer>

    <aside class="control-sidebar control-sidebar-dark" style="display: none; top: 57px; height: 323px;">

        <div class="p-3 control-sidebar-content os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition" style="height: 323px;"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: -16px; width: 0px; height: 0px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible"><div class="os-content" style="padding: 16px; height: 100%; width: 100%;"><h5>Customize AdminLTE</h5><hr class="mb-2"><div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Dark Mode</span></div><h6>Header Options</h6><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Dropdown Legacy Offset</span></div><div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>No border</span></div><h6>Sidebar Options</h6><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Collapsed</span></div><div class="mb-1"><input type="checkbox" value="1" checked="checked" class="mr-1"><span>Fixed</span></div><div class="mb-1"><input type="checkbox" value="1" checked="checked" class="mr-1"><span>Sidebar Mini</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Mini MD</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Mini XS</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Flat Style</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Legacy Style</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Compact</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Child Indent</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Child Hide on Collapse</span></div><div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Disable Hover/Focus Auto-Expand</span></div><h6>Footer Options</h6><div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div><h6>Small Text Options</h6><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Body</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Navbar</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Brand</span></div><div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Nav</span></div><div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Footer</span></div><h6>Navbar Variants</h6><div class="d-flex"><select class="custom-select mb-3 text-light border-0 bg-white"><option class="bg-primary">Primary</option><option class="bg-secondary">Secondary</option><option class="bg-info">Info</option><option class="bg-success">Success</option><option class="bg-danger">Danger</option><option class="bg-indigo">Indigo</option><option class="bg-purple">Purple</option><option class="bg-pink">Pink</option><option class="bg-navy">Navy</option><option class="bg-lightblue">Lightblue</option><option class="bg-teal">Teal</option><option class="bg-cyan">Cyan</option><option class="bg-dark">Dark</option><option class="bg-gray-dark">Gray dark</option><option class="bg-gray">Gray</option><option class="bg-light">Light</option><option class="bg-warning">Warning</option><option class="bg-white">White</option><option class="bg-orange">Orange</option></select></div><h6>Accent Color Variants</h6><div class="d-flex"></div><select class="custom-select mb-3 border-0"><option>None Selected</option><option class="bg-primary">Primary</option><option class="bg-warning">Warning</option><option class="bg-info">Info</option><option class="bg-danger">Danger</option><option class="bg-success">Success</option><option class="bg-indigo">Indigo</option><option class="bg-lightblue">Lightblue</option><option class="bg-navy">Navy</option><option class="bg-purple">Purple</option><option class="bg-fuchsia">Fuchsia</option><option class="bg-pink">Pink</option><option class="bg-maroon">Maroon</option><option class="bg-orange">Orange</option><option class="bg-lime">Lime</option><option class="bg-teal">Teal</option><option class="bg-olive">Olive</option></select><h6>Dark Sidebar Variants</h6><div class="d-flex"></div><select class="custom-select mb-3 text-light border-0 bg-primary"><option>None Selected</option><option class="bg-primary">Primary</option><option class="bg-warning">Warning</option><option class="bg-info">Info</option><option class="bg-danger">Danger</option><option class="bg-success">Success</option><option class="bg-indigo">Indigo</option><option class="bg-lightblue">Lightblue</option><option class="bg-navy">Navy</option><option class="bg-purple">Purple</option><option class="bg-fuchsia">Fuchsia</option><option class="bg-pink">Pink</option><option class="bg-maroon">Maroon</option><option class="bg-orange">Orange</option><option class="bg-lime">Lime</option><option class="bg-teal">Teal</option><option class="bg-olive">Olive</option></select><h6>Light Sidebar Variants</h6><div class="d-flex"></div><select class="custom-select mb-3 border-0"><option>None Selected</option><option class="bg-primary">Primary</option><option class="bg-warning">Warning</option><option class="bg-info">Info</option><option class="bg-danger">Danger</option><option class="bg-success">Success</option><option class="bg-indigo">Indigo</option><option class="bg-lightblue">Lightblue</option><option class="bg-navy">Navy</option><option class="bg-purple">Purple</option><option class="bg-fuchsia">Fuchsia</option><option class="bg-pink">Pink</option><option class="bg-maroon">Maroon</option><option class="bg-orange">Orange</option><option class="bg-lime">Lime</option><option class="bg-teal">Teal</option><option class="bg-olive">Olive</option></select><h6>Brand Logo Variants</h6><div class="d-flex"></div><select class="custom-select mb-3 border-0"><option>None Selected</option><option class="bg-primary">Primary</option><option class="bg-secondary">Secondary</option><option class="bg-info">Info</option><option class="bg-success">Success</option><option class="bg-danger">Danger</option><option class="bg-indigo">Indigo</option><option class="bg-purple">Purple</option><option class="bg-pink">Pink</option><option class="bg-navy">Navy</option><option class="bg-lightblue">Lightblue</option><option class="bg-teal">Teal</option><option class="bg-cyan">Cyan</option><option class="bg-dark">Dark</option><option class="bg-gray-dark">Gray dark</option><option class="bg-gray">Gray</option><option class="bg-light">Light</option><option class="bg-warning">Warning</option><option class="bg-white">White</option><option class="bg-orange">Orange</option><a href="#">clear</a></select></div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div></aside>

    <div id="sidebar-overlay"></div></div>


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

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/sl-1.3.4/sr-1.1.0/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

<script src="{{ asset("public/plugins/inputmask/jquery.inputmask.min.js") }}"></script>

<script src="{{ asset('public/mySource/js/jquery.maskMoney.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.common.min.js"></script>

<script>

    const ToastBottom = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    var get_count = function (type = 0) {
        var mess = 0
        var order = 0

        $.ajax({
            url: '{{ action('App\Http\Controllers\messageController@getCountMess') }}',
            type: "GET",
            data: {
            },
            success: function (result) {
                $('.qtyMess').html(result)
                $('.textMessNoti').html(result)
                mess = result
                $.ajax({
                    url: '{{ action('App\Http\Controllers\billController@getCountBill') }}',
                    type: "GET",
                    data: {
                    },
                    success: function (result) {
                        $('.qtyOrder').html(result)
                        $('.textOrderNoti').html(result)
                        order = result
                        var total = parseInt(mess) + parseInt(order)
                        $('.totalNoti').html(total)
                        if(type === 0 && total !== 0){
                            ToastBottom.fire({
                                icon: 'info',
                                title: 'Bạn có 1 thông báo mới',
                            })
                        }

                    }
                });
            }
        });



    }



    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        get_count()


        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: `${window.location.hostname}:6001`,
        });


        window.Echo.channel('chat')
            .listen('.notification', (e) => {
                get_count()
            });



    })
</script>

@yield('script')
</body>
</html>

