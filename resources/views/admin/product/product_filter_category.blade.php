@extends('admin.master')
@section('header')
    {{ $cate }}
@endsection
@section('style')
    <style>




    </style>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success btnAdd">Thêm</button>
        </div>
        <div class="card-body">

            <div class="row text-center justify-content-center">

                @foreach($products as $product)

                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-body pt-0">
                            <div class="row mt-3">
                                <div class="col-7">
                                    <h3 class=""><b>{{ $product->name }}</b></h3>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="mb-2"><span class="fa-li"><i class="fa-lg fa-brands fa-invision"></i></span> Thương hiệu: <b>{{ $product->brand->name }}</b></li>
                                        <li class=""><span class="fa-li"><i class="fa-lg fa-solid fa-money-bill-wave"></i></span> Giá: <b>{{ number_format($product->price, 0 ,"," ,".") }} VNĐ</b></li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset($product->image) }}" alt="" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm btn-outline-danger btnDelete" data="{{ $product->id }}">
                                    <i class="fa-solid fa-trash mr-1"></i> Xóa
                                </a>
                                <a href="{{ action('App\Http\Controllers\productController@getViewUpdate', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye mr-1"></i> Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach





            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

        var DELETE_PRODUCT = '{{ action('App\Http\Controllers\productController@deleteProduct') }}'

        $(document).ready(function () {

            $('.btnAdd').click(function (){
                window.location = '{{ action('App\Http\Controllers\productController@getViewAdd') }}';
            })



            $(document).on('click','.btnDelete',function () {
                Swal.fire({
                    title: 'Chắc chắn xóa?',
                    text: "Sau khi xóa dữ liệu sẽ không thể khôi phục",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('data')
                        $.ajax({
                            url: DELETE_PRODUCT,
                            type: "DELETE",
                            data: {
                                'id': id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công',
                                        showConfirmButton: false,
                                        text: result.message,
                                    })
                                    setTimeout(function() {
                                        window.location.reload()
                                    }, 1500);
                                } else {
                                    Swal.fire(
                                        'Thất bại!',
                                        result.message,
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            })

        });


    </script>

@endsection


{{--@extends('admin.master')--}}
{{--@section('header')--}}
{{--    {{ $cate }}--}}
{{--@endsection--}}
{{--@section('style')--}}
{{--    <style>--}}

{{--        .my-card-product{--}}
{{--            transition: transform .2s;--}}
{{--        }--}}

{{--        .my-card-product:hover{--}}
{{--            transform: scale(1.05);--}}
{{--        }--}}


{{--    </style>--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    <div class="card">--}}
{{--        <div class="card-body">--}}

{{--            <div class="row text-center justify-content-center">--}}

{{--                @foreach($products as $product)--}}

{{--                    <div class="col-md-3 p-3" style="min-width: 300px">--}}
{{--                        <div class="my-card-product" style="border-radius: 10px; border: black solid 1px; box-shadow: 5px 10px #888888;">--}}
{{--                            <div class="text-center">--}}
{{--                                <img class="mt-2" src="{{ asset($product->image) }}" alt="" style="width: 80%">--}}
{{--                            </div>--}}
{{--                            <div class="text-center">--}}
{{--                                <p class="mt-2 h5"><strong>{{ $product->name }}</strong> </p>--}}
{{--                                @if($product->chip != '')--}}
{{--                                    <p style="">--}}
{{--                                        <i class="fa-solid fa-microchip"></i> {{ $product->chip }}--}}
{{--                                    </p>--}}
{{--                                @endif--}}
{{--                                <p>--}}
{{--                                    <i class="fa-brands fa-invision"></i> {{ $product->brand->name }}--}}
{{--                                    &ensp;--}}
{{--                                    @if($product->ram != '')--}}
{{--                                        <i class="fa-solid fa-memory"></i> {{ $product->ram }} GB--}}
{{--                                    @endif--}}
{{--                                </p>--}}
{{--                                <p style="font-size: 1.5rem;">--}}
{{--                                    <strong>--}}
{{--                                    <span style=" background-color: black; border-radius: 15px; color: white">--}}
{{--                                        &ensp; {{ number_format($product->price, 0 ,"," ,".") }} VND &ensp;--}}
{{--                                    </span>--}}
{{--                                    </strong>--}}
{{--                                </p>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <button type="button" class="btn btn-outline-danger float-left ml-4" style="border-radius: 50%"><i class="fa-solid fa-heart-circle-plus"></i></button>--}}
{{--                                    <button type="button" class="btn btn-outline-secondary float-none" style="border-radius: 100px">MUA NGAY</button>--}}
{{--                                    <button type="button" class="btn btn-outline-primary float-right mr-4" style="border-radius: 50%"><i class="fa-solid fa-eye"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                @endforeach--}}

{{--                --}}{{-- // --}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('script')--}}

{{--    <script>--}}

{{--        $(document).ready(function () {--}}


{{--        });--}}


{{--    </script>--}}

{{--@endsection--}}





