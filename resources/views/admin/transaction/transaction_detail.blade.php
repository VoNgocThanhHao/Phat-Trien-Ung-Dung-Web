@extends('admin.master')
@section('header') CHI TIẾT ĐƠN HÀNG
@endsection

@section('content')


    <div class="card">

        <div class="card-body">


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="invoice p-3 mb-3" style="background-color: rgba(255,255,255,0.1); border-radius: 10px">

                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <img src="{{asset("public/mySource/imgs/logo/logo_v2.png")}}" style="border-radius: 50%; width: 40px"> Điện máy Đen
                                            <small class="float-right">Ngày lập hóa đơn: {{ $bill->created_at->format('d-m-Y') }}</small>
                                        </h4>
                                    </div>

                                </div>

                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Bên gửi
                                        <address>
                                            <strong>Điện máy Đen</strong><br>
                                            88 Phạm Thái Bường Phường 4, Vĩnh Long, Việt Nam<br>
                                            Hotline: 0849 211 557<br>
                                            Email: dienmayden@gmail.com
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        Bên nhận
                                        <address>
                                            <strong>{{ $bill->name }}</strong><br>
                                            {{ $bill->address }}<br>
                                            Điện thoại: {{ $bill->phone_number }}<br>
                                            Email: {{ Auth::user()->email }}
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <b>Mã hóa đơn #{{ $bill->code }}</b><br>
                                        <br>
                                        <b>Loại thanh toán:</b> {{ $bill->type == 0 ? 'Tiền mặt' : 'VNPay' }}<br>
                                        <b>Ngày thanh toán:</b>
                                            @if($bill->payment) {{ $bill->payment->format('d-m-Y') }}
                                            @else Chưa thanh toán
                                            @endif
                                        <br>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Ghi chú</th>
                                                <th>Giá</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bill->order as $key => $order)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $order->product->name }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>{{ $bill->description }}</td>
                                                    <td>{{ number_format($order->product->price * $order->quantity, 0 ,"," ,".") }} VND</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        <img src="{{asset("public/dist/img/credit/visa.png")}}" alt="Visa">
                                        <img src="{{asset("public/dist/img/credit/mastercard.png")}}" alt="Mastercard">
                                        <img src="{{asset("public/dist/img/credit/american-express.png")}}" alt="American Express">
                                        <img src="{{asset("public/dist/img/credit/paypal2.png")}}" alt="Paypal">
                                    </div>

                                    <div class="col-6">
                                        <p class="lead">Hóa đơn ngày {{ $bill->created_at->format('d-m-Y') }}</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody><tr>
                                                    <th style="width:50%">Tổng tiền sản phẩm:</th>
                                                    <td>
                                                        {{ number_format($total, 0 ,"," ,".") }} VND</td>
                                                </tr>
                                                <tr>
                                                    <th>Giảm giá:</th>
                                                    <td>{{ $bill->type == 0 ? '0 %' : '5% ('.number_format($total*5/100, 0 ,"," ,".").') - Thanh toán VNPay' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phí vận chuyển:</th>
                                                    <td>{{ number_format($ship, 0 ,"," ,".") }} VND</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng cộng:</th>
                                                    <td>{{ $bill->type == 0 ? number_format($total+$ship, 0 ,"," ,".") : number_format(($total - $total*5/100)+$ship, 0 ,"," ,".") }} VND</td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                    </div>

                                </div>


                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="{{ action('App\Http\Controllers\billController@getViewAdmin') }}" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                                            Xác nhận
                                        </a>
                                        <a href="{{ action('App\Http\Controllers\billController@getViewPDFAdmin', $bill->id) }}"
                                           target="_blank" class="btn btn-primary" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Xuất PDF
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>


        </div>

    </div>


@endsection

@section('script')

    <script>


        $(document).ready(function () {



        });


    </script>

@endsection



