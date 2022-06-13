@extends('admin.master')
@section('style')
<style>
    .boxAvatar {
        position: relative;
    }

    .img-avatar {
        opacity: 1;
        display: block;
        width: 200px;
        height: 200px;
        border: 3px solid #adb5bd;
        margin: 0 auto;
        padding: 3px;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .btnUpload {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .boxAvatar:hover .img-avatar {
        opacity: 0.3;
    }

    .boxAvatar:hover .btnUpload {
        opacity: 1;
    }


</style>
@endsection

@section('content')

    <div class="row mt-n4 p-3" style="background-image: url('{{ asset('public/mySource/imgs/background/IOT-BUILDINGS.png') }}')">
    <div class="text-center float-left ml-5 boxAvatar">
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" id="image" hidden>

        <img class="img-fluid img-circle img-avatar" src="{{ asset($user->profile['image'].'?v='.time()) }}" alt="" id="image_preview_container">
        <button type="button" class="btn btn-secondary btnUpload" style="font-size: 10px">
            <i class="fa-solid fa-camera mr-1"></i>
            Cập nhật ảnh</button>
    </div>
    <div class="float-left ml-5 mt-5">
        <h2 class="float-left" style="color: whitesmoke">{{ $user->name }}</h2>
        <p class="" style="color: whitesmoke">{{ $user->email }}</p>
    </div>
    </div>


    <div class="float-none mt-5">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Thông tin cá nhân</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Lịch sử mua hàng</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="settings">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="nameUser" class="col-sm-2 col-form-label">Họ tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nameUser" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-2 col-form-label">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " id="phone_number"
                                           data-inputmask="'mask': ['9999-999-999']"
                                           data-mask="" inputmode="text" value="{{ $user->profile['phone_number'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" value="{{ $user->profile['address'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" disabled value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Ghi chú</label>
                                <div class="col-sm-10">
                                    <textarea  class="form-control" id="description">{{ $user->profile['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button class="btn btn-primary btnSubmit">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane" id="timeline">

                        <table id="billTable"
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
                                    style="width: 200px"> Thanh toán
                                </th>
                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    style="width: 200px"> Thời gian
                                </th>
                                <th style="width:200px">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>




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




    <div class="modal fade" id="modal-bill-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="stt_bill" class="col-sm-5 col-form-label">Trạng thái đơn hàng:</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <select class="form-control" id="stt_bill">
                                    <option value="0">Chưa thanh toán</option>
                                    <option value="1">Đã thanh toán</option>
                                </select>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btnUpdate">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $('[data-mask]').inputmask();

        var image_avatar = '';

        var UPDATE_PROFILE = '{{action('App\Http\Controllers\profileController@update',$user->id)}}'

        $(document).ready(function () {

            $('#billTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "serverSide": true,
                "ajax": '{{ action('App\Http\Controllers\billController@getDataTableAdminForUser', $user->id) }}',
                "columns":
                    [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'code', name: 'code'},
                        {data: 'payment', name: 'payment'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'},
                    ]
            });

            $(document).on('click', '.btnDetailHis', function () {
                var url = '{{ action('App\Http\Controllers\billController@getBillAdmin',1) }}'
                url = url.substring(0, url.length - 1)
                window.location = url + $(this).attr('data');
            })

            $(document).on('click', '.btnUpdateHis', async function () {
                var data = JSON.parse($(this).attr('data'));

                $('.modal-title').html("Đơn hàng #" + data.code)


                    if (data.payment){
                        $('#stt_bill').val(1)
                    }else{
                        $('#stt_bill').val(0)
                    }


                $('.btnUpdate').attr('data',data.id)

                $('#modal-bill-update').modal('show')

            })


            $('.btnUpdate').click(function () {
                var id = $(this).attr('data')

                $.ajax({
                    url: '{{ action('App\Http\Controllers\billController@updateBill') }}',
                    type: "POST",
                    data: {
                        'id': id,
                        'payment': $('#stt_bill').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            $('#billTable').DataTable().ajax.reload();
                            $('#modal-bill-update').modal('hide');
                            Swal.fire(
                                'Thành công!',
                                result.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Thất bại!',
                                result.message,
                                'error'
                            )
                        }
                    }
                });
            })




            $('.btnUpload').click(function (){
                $('#image').click();
            });
            $('.btnReChoose').click(function (){
                $('#image').click();
            });
            $('.btnCloseUpload').click(function (){
                $('#uploadimageModal').modal('hide');
            });

            var image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:200,
                    height:200,
                    type:'square' //circle
                },
                boundary:{
                    width:300,
                    height:300
                }
            });


            $('#image').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {
                    image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        // console.log('jQuery bind complete');
                    });

                    // $('#image_preview_container').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event){
                image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    // console.log(response);
                    image_avatar = response;
                    $('#image_preview_container').attr('src', response);
                })
                $('#uploadimageModal').modal('hide');
            });



            $('.btnSubmit').click(function (){

                // var image = $('#image')[0].files[0];

                var fd = new FormData();
                fd.append( 'image', image_avatar );
                fd.append( 'name', $('#nameUser').val() );
                fd.append( 'phone_number', $('#phone_number').val() );
                fd.append( 'address', $('#address').val() );
                fd.append( 'description', $('#description').val() );


                $.ajax({
                    url: UPDATE_PROFILE,
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


        });


    </script>

@endsection



