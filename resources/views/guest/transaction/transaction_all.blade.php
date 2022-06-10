@extends('guest.master')
@section('style')

    <style>

        input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .rbtnTranAll {
            border: #C5C5C5 solid 2px;
            cursor: pointer;
            transition: 0.5s;
        }

        .iconTranAll {
            transition: 0.5s;
        }

        .rbtnTranAll:hover .iconTranAll {
            background-color: rgba(0, 0, 0, 1);
            color: white;
        }

        .rbtnTranAll:hover {
            border: black solid 2px;
            background-color: rgb(176, 176, 176);

        }

    </style>

@endsection
@section('content')

    <div class="container" style=" color: white !important;">

        <div class="" style="padding: 70px">

            <section class="content-header mb-3" style="background-color: rgba(255,255,255,0.1); border-radius: 10px">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Thông tin đơn hàng</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" class="btn btn-outline-danger btnTran" style="width: 150px">Thanh toán</button>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="card" style="background-color: rgba(255,255,255,0.1); border-radius: 10px">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-7">
                        @foreach($favourites as $favourite)
                            <!-- Default box -->
                                <div class="card itemOrder" data="{{ $favourite->product->id }}" style="background-color: rgba(255,255,255,0.1);">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ asset($favourite->product->image) }}" alt=""
                                                     style=" width: 100%">
                                            </div>
                                            <div class="col-md-7">
                                                <h3><strong>{{ $favourite->product->name }}</strong></h3>
                                                <p>Giá: <i><b class="priceProduct" data="{{ $favourite->product->price }}">{{ number_format($favourite->product->price, 0 ,"," ,".") }} VND</b> </i></p>
                                            </div>
                                            <div class="col-md-3">

                                                <div class="input-group mt-4">
                                                    <div class="input-group-prepend btnUpdateQty btnSub" data="" style="cursor: pointer">
                    <span class="input-group-text " >
                      <i class="fas fa-minus"></i>
                    </span>
                                                    </div>
                                                    <input type="number" class="form-control qtyTran text-center" value="1" disabled>
                                                    <div class="input-group-append btnUpdateQty btnAdd" style="cursor: pointer" data="">
                                                        <div class="input-group-text"><i class="fas fa-plus"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <!-- /.card -->
                            @endforeach


                        </div>

                        <div class="col-md-5 row">

                            <!-- Default box -->
                            <div class="card col-md-12" style="background-color: rgba(255,255,255,0.1);">
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Thông tin đơn hàng</strong></h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <span>Tạm tính:</span> <span style="float: right" id="amountTran">60.000 VND</span>
                                    </p>
                                    <span>Phí vận chuyển:</span> <span style="float: right" id="shipTran">0 VND</span><br>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <strong>Tổng cộng:</strong>
                                    <span style="float: right"><strong id="totalTran">70.000 </strong></span>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->

                            <form id="formTranAll" action="{{ action('App\Http\Controllers\billController@addBill') }}" method="POST">
                                <input type="submit" name="redirect" hidden>
                                @csrf

                            <!-- Default box -->
                            <div class="card col-md-12" style="background-color: rgba(255,255,255,0.1);">
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Chọn phương thức thanh toán</strong></h3>
                                </div>
                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-sm-12  pl-5 pr-5 mb-3">

                                            <div class="row rbtnTranAll rbtnTienMatAll" style="border-radius: 5px; position: relative">
                                                <input class="radioTienMatAll" type="radio" name="radioTran" value="0"
                                                       style="position: absolute; top: 0; right: 0; z-index: 1000;" checked>
                                                <div class="col-sm-3 text-center iconTranAll iconTranTienMat"
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
                                            <div class="row rbtnTranAll rbtnVNpayAll" style="border-radius: 5px; position: relative">
                                                <input class="radioVNPayAll" type="radio" name="radioTran" value="1"
                                                       style="position: absolute; top: 0; right: 0; z-index: 1000;">
                                                <div class="col-sm-3 text-center iconTranAll iconTranVNPay"
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
                            </div>
                            <!-- /.card -->



                            <!-- Default box -->
                            <div class="card col-md-12" style="background-color: rgba(255,255,255,0.1);">
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Thông tin khách hàng</strong></h3>
                                </div>
                                <div class="card-body">
                                    <p class="row">
                                        <span class="col-md-3 mt-1">Tên người nhận:</span>
                                        <input type="text" class="form-control col-md-9 nameTransac" name="name"
                                               value="{{ Auth::user()->name }}">
                                    </p>
                                    <p class="row">
                                        <span class="col-md-3 mt-1">Số điện thoại:</span>
                                        <input type="text" class="form-control col-md-9 phoneTransac" name="phone_number"
                                               data-inputmask="'mask': ['9999-999-999']" data-mask="" inputmode="text"
                                               value="{{ Auth::user()->profile->phone_number }}">
                                    </p>

                                    <p class="row">
                                        <span class="col-md-3 mt-1">Địa chỉ:</span>
                                        <textarea type="text" class="form-control col-md-9 adTransac" name="address"
                                                  rows="2">{{ Auth::user()->profile->address }}</textarea>
                                    </p>
                                    <p class="row">
                                        <span class="col-md-3 mt-1">Ghi chú:</span>
                                        <textarea type="text" class="form-control col-md-9 messTransac" rows="2" name="description">{{ Auth::user()->profile->description }}
                                        </textarea>
                                    </p>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>



@endsection

@section('script')

    <script>

        var match_total = function () {
            var total = 0;
            $('.itemOrder').each(function () {
                var qty = $(this).find('.qtyTran').val()
                var price = $(this).find('.priceProduct').attr('data')
                total += qty*price
            })

            var str_total = formatToCurrency(total).toString()
            str_total = str_total.slice(0, str_total.length - 3) + ' VND'
            $('#amountTran').html(str_total)


            if (total > 0 && total < 700000)  {
                $('#shipTran').html('30.000 VND')
                total += 30000
                var str_total = formatToCurrency(total).toString()
                str_total = str_total.slice(0, str_total.length - 3) + ' VND'
            }
            else {
                $('#shipTran').html('0 VND')
            }

            $('#totalTran').html(str_total)


        }

        $(document).ready(function () {

            match_total()

            $(document).on('click','.btnSub',function () {
                var quan = parseInt($(this).next().val()) - 1
                if (quan >= 0) $(this).next().val(quan)
                else $(this).next().val(0)
            })

            $(document).on('click','.btnAdd',function () {
                var quan = parseInt($(this).prev().val()) + 1
                if (quan <= 3) $(this).prev().val(quan)
                else {
                    $(this).prev().val(3)
                    Toast.fire({
                        icon: 'warning',
                        title: 'Số lượng đã đạt tối đa!'
                    })
                }
            })



            $('.btnTran').click(function () {
                var arr = []
                $('.itemOrder').each(function () {
                    var product_id = $(this).attr('data')
                    var quan = $(this).find('.qtyTran').val()
                    if (quan !== '0') arr.push("{\"product_id\":" + product_id + ", \"quantity\":"+quan+"}")
                })

                $('#formTranAll').append('<input type="hidden" id="arrTranAll" name="products" value="" /> ');

                $('#arrTranAll').val(JSON.stringify(arr))

                // console.log(JSON.stringify(arr))
                // return


                if (arr.length === 0){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Không có gì trong giỏ hàng'
                    })
                    return
                }

                if ($('.nameTransac').val() === '' || $('.phoneTransac').val() === '' || $('.adTransac').val() === '') {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Vui lòng cung cấp đầy đủ thông tin liên hệ!'
                    })
                    return
                }
                $('#formTranAll').submit()
            })


            $(document).on('click','.btnUpdateQty', function () {
                match_total()
            })



            $('.rbtnTienMatAll').click(function () {
                $('.radioTienMatAll').prop("checked", true);
                $('.iconTranAll').css('background','none')
                $('.iconTranAll').css('color','white')
                $('.iconTranTienMat').css('background','white')
                $('.iconTranTienMat').css('color','black')
            })

            $('.rbtnVNpayAll').click(function () {
                $('.radioVNPayAll').prop("checked", true);
                $('.iconTranAll').css('background','none')
                $('.iconTranAll').css('color','white')
                $('.iconTranVNPay').css('background','white')
                $('.iconTranVNPay').css('color','black')
            })
        })

    </script>

@endsection
