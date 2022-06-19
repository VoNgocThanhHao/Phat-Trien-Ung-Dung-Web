@extends('admin.master')
@section('header') THỐNG KÊ
@endsection

@section('style')
@endsection

@section('content')


    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tổng doanh thu</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="chart">
                        <canvas id="thongkeDanhMuc" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>

                </div>
            </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sản phẩm mua nhiều nhất của danh mục</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group col-6">
                        <label>Chọn danh mục:</label>
                        <select class="form-control selectCategory">
                            <option value="Điện thoại">Điện thoại</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Máy tính bàn (PC)">Máy tính bàn (PC)</option>
                            <option value="Đồng hồ thông minh">Đồng hồ thông minh</option>
                            <option value="Máy tính bảng">Máy tính bảng</option>
                            <option value="Phụ kiện">Phụ kiện</option>
                        </select>
                    </div>


                    <div class="chart">
                        <canvas id="thongkeSanPham" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-6">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">So sánh doanh thu các năm</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-5">
                            <label for="datepicker">Năm chính:</label>
                            <input type="number" class="form-control text-center datepicker" id="picker_year_1" />
                        </div>

                        <div class="col-5">
                            <label for="datepicker">Năm phụ:</label>
                            <input type="number" class="form-control text-center datepicker" id="picker_year_2" />
                        </div>

                        <div class="col-2 text-center" >
                            <button type="button" class="btn btn-outline-primary btn-sm btnGetSoSanh" style="margin-top: 30px;">Xác nhận</button>
                        </div>
                    </div>




                    <div class="chart">
                        <canvas id="thongkeSoSanh" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>

                </div>
            </div>



            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thống kê lượt xem trên danh mục</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="chart">
                        <canvas id="thongkeLuotXem" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>

                </div>
            </div>

        </div>




    </div>


@endsection

@section('script')

    <script>

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

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        $(document).ready(function () {

            $(".datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose:true
            });

            var dataDanhMuc = []

            @foreach($income as $item)

            dataDanhMuc.push({{$item}})

            @endforeach


            const data = {
                labels: ['Điện thoại', 'Laptop', 'Máy tính bàn (PC)', 'Đồng hồ thông minh', 'Máy tính bảng', 'Phụ kiện'],
                datasets: [{
                    data: dataDanhMuc,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            };

            new Chart(
                $('#thongkeDanhMuc').get(0).getContext('2d'), config
            )



            $('#picker_year_1').val(2022)
            $('#picker_year_2').val(2021)




            var get_sosanh = function (data_year_1, data_year_2) {
                const data_sosanh = {
                    labels: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
                    datasets: [
                        {
                            label: $('#picker_year_1').val(),
                            data: data_year_1,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0)',
                        },
                        {
                            label: $('#picker_year_2').val(),
                            data: data_year_2,
                            borderColor: 'rgb(108, 117, 125)',
                            backgroundColor: 'rgba(108, 117, 125, 0)',
                        }
                    ]
                };

                const config_sosanh = {
                    type: 'line',
                    data: data_sosanh,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                return new Chart(
                    $('#thongkeSoSanh').get(0).getContext('2d'), config_sosanh
                )
            }

            var data_year_1 = []
            var data_year_2 = []

            @for($i = 0; $i<12; $i++)
            data_year_1.push({{$result_year_1[$i] }})
            data_year_2.push({{$result_year_2[$i] }})
            @endfor

            var chartSoSanh = get_sosanh(data_year_1, data_year_2)


            $('.btnGetSoSanh').click(function () {

                if ($('#picker_year_1').val() === '' || $('#picker_year_2').val() === ''){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Năm không được bỏ trống!'
                    })
                    return;
                }
                chartSoSanh.destroy()
                data_year_1 = []
                data_year_2 = []

                $.ajax({
                    url: '{{ action('App\Http\Controllers\statisticalController@getSoSanh') }}',
                    data: {
                        'year': $('#picker_year_1').val(),
                    },
                    dataType: 'json', // jQuery will parse the response as JSON
                    success: function (outputfromserver) {
                        for (var i = 0; i < outputfromserver.length; i++) {
                            data_year_1.push(outputfromserver[i])
                        }


                        $.ajax({
                            url: '{{ action('App\Http\Controllers\statisticalController@getSoSanh') }}',
                            data: {
                                'year': $('#picker_year_2').val(),
                            },
                            dataType: 'json', // jQuery will parse the response as JSON
                            success: function (outputfromserver) {
                                for (var i = 0; i < outputfromserver.length; i++) {
                                    data_year_2.push(outputfromserver[i])
                                }

                                chartSoSanh = get_sosanh(data_year_1, data_year_2)
                            }
                        });


                    }
                });


            })


            var array_label_sanpham = []
            var array_data_sanpham = []
            var array_color_sanpham = []

            @foreach($array_sanpham as $key => $item)

            array_label_sanpham.push('{{$key}}')
            array_data_sanpham.push({{$item}})
            array_color_sanpham.push(getRandomColor())

            @endforeach


            var get_sanpham = function (array_label_sanpham, array_data_sanpham, array_color_sanpham) {
                const data_sanpham = {
                    labels: array_label_sanpham,
                    datasets: [{
                        // label: 'My First Dataset',
                        data: array_data_sanpham,
                        backgroundColor: array_color_sanpham,
                    }]
                };

                const config_sanpham = {
                    type: 'polarArea',
                    data: data_sanpham,
                    options: {}
                };

                return new Chart(
                    $('#thongkeSanPham').get(0).getContext('2d'), config_sanpham
                )
            }

            var chartSanPham = get_sanpham(array_label_sanpham, array_data_sanpham, array_color_sanpham)


            $('.selectCategory').change(function (){
                chartSanPham.destroy()
                array_label_sanpham = []
                array_data_sanpham = []
                array_color_sanpham = []
                $.ajax({
                    url: '{{ action('App\Http\Controllers\statisticalController@getSanPham') }}',
                    data: {
                        'category': $('.selectCategory').val(),
                    },
                    dataType: 'json', // jQuery will parse the response as JSON
                    success: function (outputfromserver) {
                        Object.keys(outputfromserver).forEach(function(key) {
                            var value = outputfromserver[key];
                            array_label_sanpham.push(key)
                            array_data_sanpham.push(value)
                            array_color_sanpham.push(getRandomColor())
                        });
                        chartSanPham = get_sanpham(array_label_sanpham, array_data_sanpham, array_color_sanpham)
                    }
                });
            })




            var array_data_luotxem = []
            @foreach($array_luotxem as $item)
            array_data_luotxem.push({{$item}})
            @endforeach


            const data_luotxem = {
                labels: ['Điện thoại', 'Laptop', 'Máy tính bàn (PC)', 'Đồng hồ thông minh', 'Máy tính bảng', 'Phụ kiện'],
                datasets: [{
                    data: array_data_luotxem,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                    ],
                    borderWidth: 1
                }]
            };

            const config_luotxem = {
                type: 'bar',
                data: data_luotxem,
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            };

            new Chart(
                $('#thongkeLuotXem').get(0).getContext('2d'), config_luotxem
            )

        });


    </script>

@endsection



