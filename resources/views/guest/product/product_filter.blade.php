@extends('guest.master')
@section('style')

    <style>

        .my-card-product{
            transition: transform .2s;
        }

        .my-card-product:hover{
            transform: scale(1.05);
        }

        .custom-control-label{
            font-weight: 100 !important;
        }

    </style>

@endsection
@section('content')

    <div style="background-color: black;">
        <div class="container" style="">

            <div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @if($slug == 'dien-thoai')
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/dien-thoai/1.png') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/dien-thoai/2.png') }}"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/dien-thoai/3.png') }}"
                                 alt="Third slide">
                        </div>
                    @elseif($slug == 'laptop')
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/laptop/1.png') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/laptop/2.png') }}"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/laptop/3.png') }}"
                                 alt="Third slide">
                        </div>
                    @elseif($slug == 'may-tinh-ban')
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/may-tinh-ban/1.png') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/may-tinh-ban/2.png') }}"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/may-tinh-ban/3.png') }}"
                                 alt="Third slide">
                        </div>
                    @elseif($slug == 'dong-ho-thong-minh')
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/dong-ho-thong-minh/1.png') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/dong-ho-thong-minh/2.png') }}"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/dong-ho-thong-minh/1.png') }}"
                                 alt="Third slide">
                        </div>
                    @elseif($slug == 'may-tinh-bang')
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/may-tinh-bang/1.png') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/may-tinh-bang/2.png') }}"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/may-tinh-bang/3.png') }}"
                                 alt="Third slide">
                        </div>
                    @elseif($slug == 'phu-kien')
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/phu-kien/1.png') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/phu-kien/2.png') }}"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('public/mySource/imgs/banner/phu-kien/3.png') }}"
                                 alt="Third slide">
                        </div>
                    @endif

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <hr style="background-color: white">

            <div class="row mt-2">

                <div class="col-md-3">
                    <div class="card  text-white" style="background-color: rgba(255,255,255,0.1)">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-12 mb-3">
                                    <strong>Hãng sản xuất</strong>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxBrand" type="checkbox" id="customCheckboxAll"
                                                   value=''>
                                            <label for="customCheckboxAll" class="custom-control-label">Tất cả</label>
                                        </div>
                                    </div>
                                </div>

                                @foreach($brands as $brand)

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxBrand" type="checkbox" id="customCheckbox.{{ $brand->id }}"
                                                   value='{"brand":"{{ $brand->id }}"}'>
                                            <label for="customCheckbox.{{ $brand->id }}" class="custom-control-label">{{ $brand->name }}</label>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                <div class="col-sm-12 mb-3">
                                    <strong>Mức giá</strong>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxPrice" type="checkbox" id="customCheckboxgiaAll"
                                                   value=''>
                                            <label for="customCheckboxgiaAll" class="custom-control-label">Tất cả</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxPrice" type="checkbox" id="customCheckboxgia1"
                                                   value='{"price":"5"}'>
                                            <label for="customCheckboxgia1" class="custom-control-label">Dưới 5 triệu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxPrice" type="checkbox" id="customCheckboxgia2"
                                                   value='{"price":"10"}'>
                                            <label for="customCheckboxgia2" class="custom-control-label">Từ 5 - 10 triệu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxPrice" type="checkbox" id="customCheckboxgia3"
                                                   value='{"price":"15"}'>
                                            <label for="customCheckboxgia3" class="custom-control-label">Từ 10 - 15 triệu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxPrice" type="checkbox" id="customCheckboxgia4"
                                                   value='{"price":"20"}'>
                                            <label for="customCheckboxgia4" class="custom-control-label">Từ 15 - 20 triệu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input checkboxPrice" type="checkbox" id="customCheckboxgia5"
                                                   value='{"price":"25"}'>
                                            <label for="customCheckboxgia5" class="custom-control-label">Trên 20 triệu</label>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="card text-white" style="background-color: rgba(255,255,255,0.1)">
                        <div class="card-header mt-3" style="background-color: rgba(0,0,0,0.2);">
                            <h2 class="">
                                @switch($slug)
                                    @case('dien-thoai')
                                    Điện thoại
                                    @break
                                    @case('laptop')
                                    Laptop
                                    @break
                                    @case('may-tinh-ban')
                                    Máy tính bàn (PC)
                                    @break
                                    @case('dong-ho-thong-minh')
                                    Đồng hồ thông minh
                                    @break
                                    @case('may-tinh-bang')
                                    Máy tính bảng
                                    @break
                                    @case('phu-kien')
                                    Phụ kiện
                                    @break
                                @endswitch

                            </h2>
                        </div>

                        <div class="card-body text-center">

                            <div class="row text-center justify-content-center boxProduct">

                                @foreach($products as $product)

                                <div class="col-sm-3 p-3" style="min-width: 300px">
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
                                                <button type="button" class="btn btn-outline-danger float-left ml-4 btnAddFav" data="{{ $product->id }}"
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

                        </div>

                    </div>
                </div>


            </div>

        </div>
    </div>



@endsection

@section('script')

    <script>

        var SEARCH_PRODUCT = '{{ action('App\Http\Controllers\productController@getBoxProduct', $slug) }}'

        $(document).ready(function () {

            $('.checkboxBrand').change(function() {
                if(this.checked) {
                    // alert($(this).val())
                    if($(this).attr('id') === 'customCheckboxAll'){
                        $('.checkboxBrand').prop("checked", false);
                        $(this).prop("checked", true);
                    }else{
                        $('#customCheckboxAll').prop("checked", false);
                    }
                }
            });

            $('.checkboxPrice').change(function() {
                if(this.checked) {
                    // alert($(this).val())
                    if($(this).attr('id') === 'customCheckboxgiaAll'){
                        $('.checkboxPrice').prop("checked", false);
                        $(this).prop("checked", true);
                    }else{
                        $('#customCheckboxgiaAll').prop("checked", false);
                    }
                }

            });

            $('.custom-control-input').change(function () {
                var arrayBrand = []
                var arrayPrice = []
                $('.checkboxBrand:checkbox:checked').each(function () {
                    var sThisVal = (this.checked ? $(this).val() : "");
                    if (sThisVal !== "") arrayBrand.push(sThisVal);
                });
                // if (arrayBrand.length === 0) arrayBrand[0] = '{"brand":"all"}'
                $('.checkboxPrice:checkbox:checked').each(function () {
                    var sThisVal = (this.checked ? $(this).val() : "");
                    if (sThisVal !== "") arrayPrice.push(sThisVal);
                });
                // if (arrayPrice.length === 0) arrayPrice[0] = '{"price":"all"}'
                $.ajax({
                    url: SEARCH_PRODUCT,
                    type: "GET",
                    data: {
                        'arrayBrand': arrayBrand,
                        'arrayPrice': arrayPrice,
                    },
                    success: function (result) {
                        $('.boxProduct').html(result)
                    }
                });
            })



        })

    </script>

@endsection
