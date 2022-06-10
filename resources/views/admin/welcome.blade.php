@extends('admin.master')
@section('header') Welcome @endsection

@section('content')

    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Tổng quan
            </h3>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>4.2</h3>
                            <p>Trên 3000 lượt đánh giá</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>



                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Báo lỗi</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 class="textMessNoti">-1</h3>
                            <p>tin nhắn mới</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <a href="{{ action('App\Http\Controllers\messageController@getView') }}" class="small-box-footer">
                            Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>



                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 class="textOrderNoti">-1</h3>
                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ action('App\Http\Controllers\billController@getViewAdmin') }}" class="small-box-footer">
                            Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </div>

    </div>

{{-------------------------------------------------    thẻ 2 ----------------------------------------------------------}}

    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-solid fa-share mr-1"></i>
                Lối tắt
            </h3>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-3 col-sm-6 col-12 btnHome" style="cursor: pointer">
                    <div class="info-box shadow bg-light">
                        <span class="info-box-icon bg-success"><i class="nav-icon fa-solid fa-house-chimney"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Trang người dùng</span>
                        </div>
                    </div>
                </div>



                <div class="col-md-3 col-sm-6 col-12 btnProducts" style="cursor: pointer">
                    <div class="info-box shadow bg-light">
                        <span class="info-box-icon bg-primary"><i class="nav-icon fa-solid fa-computer"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Tất cả sản phẩm</span>
                        </div>
                    </div>
                </div>



        </div>

    </div>


@endsection

@section('script')

<script>

    $(document).ready(function (){
        $('.btnProducts').click(function (){
            window.location = '{{ action('App\Http\Controllers\productController@getView') }}';
        })

        $('.btnHome').click(function (){
            window.location = '{{ route('home') }}';
        })

    })

</script>

@endsection
