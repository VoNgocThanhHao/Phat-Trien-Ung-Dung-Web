@extends('admin.master')
@section('header') DANH SÁCH TÀI KHOẢN
@endsection

@section('content')

    {{--------------------------------------Datatable-------------------------------------------------}}

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success btnAdd">Thêm</button>
        </div>

        <div class="card-body">

            <table id="userTable"
                   class="table table-hover dataTable dtr-inline projects"
                   role="grid"
                   aria-describedby="example1_info" style="text-align: center">
                <thead>
                <tr role="row">
                    <th style="width:10px">#</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                        colspan="1" aria-sort="ascending"
                        style=""> Tên người dùng
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style=""> Email
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 90px"> Xác thực
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 100px"> Quyền
                    </th>
                    <th style="width:150px">
                    </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


        </div>

    </div>

    {{---------------------------------------Modal----------------------------------------------------}}

    <div class="modal fade" id="modal-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm tài khoản</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                        <button type="button" class="btn btn-outline-secondary mb-2 btnChangePass"><i class="fa-solid fa-rotate"></i></button>
                        <input type="password" class="form-control passUser">
                        <span class="text-danger sttPass"></span>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label>Loại tài khoản:</label>
                            <select class="form-control permissionUser">
                                <option value="3">Quản trị viên</option>
                                <option value="2" selected>Nhân viên</option>
                                <option value="1">Khách hàng</option>
                            </select>
                        </div>

                        <div class="custom-control custom-checkbox col-6 text-center">
                            <input class="custom-control-input custom-control-input-primary" type="checkbox" id="email_verified" checked="">
                            <label for="email_verified" class="custom-control-label" style="margin-top: 35px">Đã xác thực</label>
                        </div>

                    </div>




                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btnSave">Thêm</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')

    <script>

        var timeout = null;
        var check_email = false;
        var check_pass = false;

        var GET_DATATABLE = '{{ action('App\Http\Controllers\userController@getDataTable') }}'
        var CHECK_EMAIL = '{{ action('App\Http\Controllers\userController@checkEmail') }}'
        var CHECK_EMAIL_UPDATE = '{{ action('App\Http\Controllers\userController@checkEmail_update') }}'
        var CHANGE_PASSWORD = '{{ action('App\Http\Controllers\userController@changePassword') }}'

        var ADD_USER = '{{ action('App\Http\Controllers\userController@addUser') }}'
        var UPDATE_USER = '{{ action('App\Http\Controllers\userController@updateUser') }}'
        var DELETE_USER = '{{ action('App\Http\Controllers\userController@deleteUser') }}'

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

        $(document).ready(function () {

            $('#userTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "serverSide": true, "ordering": false,
                "ajax": GET_DATATABLE,
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'verified', name: 'verified'},
                    {data: 'permission', name: 'permission'},
                    {data: 'action', name: 'action'},
                ]
            });

            $('.passUser').keyup(function (){

                if($(this).val().length === 0){
                    $('.sttPass').html('');
                    check_pass = false;
                    return
                }

                if ($(this).val().length < 6 ){
                    $('.sttPass').html('Mật khẩu phải từ 6 ký tự trở lên!');
                    check_pass = false;
                }else{
                    $('.sttPass').html('');
                    check_pass = true;
                }

            })

            $('.emailUser').keyup(function () {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if($(this).val().length === 0) {
                    $('.sttEmail').html('');
                    check_email = false;
                    return;
                }

                if (!regex.test($(this).val())){
                    $('.sttEmail').html('Email không hợp lệ!');
                    check_email = false;
                    return;
                }else{
                    $('.sttEmail').html('');
                    check_email = true;
                }

                var _this = $(this);

                clearTimeout(timeout);
                timeout = setTimeout(function ()
                {

                    if ($('.btnSave').attr('data')==='insert'){

                        $.ajax({
                            url: CHECK_EMAIL,
                            type: "POST",
                            data: {
                                'email': $('.emailUser').val(),
                            },
                            success: function (result) {
                                if (result){
                                    check_email = false;
                                    $('.sttEmail').html('Email đã có người sử dụng!');
                                }else{
                                    check_email = true;
                                    $('.sttEmail').html('');
                                }

                            }
                        });
                    }else if ($('.btnSave').attr('data')==='update'){

                        $.ajax({
                            url: CHECK_EMAIL_UPDATE,
                            type: "POST",
                            data: {
                                'id' : $('.btnSave').attr('data_id'),
                                'email': $('.emailUser').val(),
                            },
                            success: function (result) {
                                if (result){
                                    $('.sttEmail').html('Email đã có người sử dụng!');
                                    check_email = false;
                                }else{
                                    $('.sttEmail').html('');
                                    check_email = true;
                                }

                            }
                        });
                    }

                }, 500);

            })

            $('.btnAdd').click(function () {
                check_email = false;
                check_pass = false;
                $('.btnChangePass').hide()
                $('.passUser').prop('disabled', false)

                $('.modal-title').html('Thêm tài khoản')
                $('.nameUser').val('')
                $('.emailUser').val('')
                $('.passUser').val('')
                $('.permissionUser').val('2')
                $('#email_verified').prop('checked', true);
                $('.btnSave').html('Thêm')
                $('.btnSave').removeAttr('data_id')

                $('.sttEmail').html('')
                $('.sttPass').html('')


                $('.btnSave').attr('data','insert')
                $('#modal-user').modal('show');
            })

            $(document).on('click','.btnEdit', function () {
                var data = jQuery.parseJSON($(this).attr('data'));

                check_email = true;
                check_pass = true;
                $('.btnChangePass').show()
                $('.passUser').prop('disabled', true)

                $('.modal-title').html('Cập nhật tài khoản')
                $('.nameUser').val(data.name)
                $('.emailUser').val(data.email)
                $('.passUser').val('')
                $('.permissionUser').val(data.permission)
                $('#email_verified').prop('checked', data.email_verified_at !== null );
                $('.btnSave').html('Cập nhật')

                $('.sttEmail').html('')
                $('.sttPass').html('')

                $('.btnSave').attr('data','update')
                $('.btnSave').attr('data_id', data.id)
                $('#modal-user').modal('show');
            })

            $('.btnSave').click(function () {

                if($('.nameUser').val() === ''){
                    Toast.fire({
                        icon: 'error',
                        title: 'Tên người dùng không được bỏ trống!'
                    })
                    return
                }

                if(!check_email){
                    Toast.fire({
                        icon: 'error',
                        title: 'Email không hợp lệ!'
                    })
                    return;
                }

                if(!check_pass){
                    Toast.fire({
                        icon: 'error',
                        title: 'Mật khẩu không hợp lệ!'
                    })
                    return;
                }


                var email_verified = false;
                if ($('#email_verified').is(':checked')) email_verified = true;

                switch ($(this).attr('data')) {
                    case 'insert':
                        $.ajax({
                            url: ADD_USER,
                            type: "PUT",
                            data: {
                                'name': $('.nameUser').val(),
                                'email': $('.emailUser').val(),
                                'password': $('.passUser').val(),
                                'verified' : email_verified,
                                'permission': $('.permissionUser').val()
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#userTable').DataTable().ajax.reload();
                                    $('#modal-user').modal('hide');
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
                        break;

                    case 'update':
                        var id = $(this).attr('data_id');
                        $.ajax({
                            url: UPDATE_USER,
                            type: "POST",
                            data: {
                                'id' : id,
                                'name': $('.nameUser').val(),
                                'email': $('.emailUser').val(),
                                'verified' : email_verified,
                                'permission': $('.permissionUser').val()
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#userTable').DataTable().ajax.reload();
                                    $('#modal-user').modal('hide');
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
                        break;
                }

            })


            $(document).on('click','.btnDelete', function () {

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
                            url: DELETE_USER,
                            type: "DELETE",
                            data: {
                                'id': id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#userTable').DataTable().ajax.reload();
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
                    }
                })



            })


            $('.btnChangePass').click(async function () {
                var password = ''

                const {value: value} = await Swal.fire({
                    title: 'Đổi mật khẩu',
                    input: 'password',
                    inputLabel: 'Nhập mật khẩu mới',
                    inputPlaceholder: 'Mật khẩu mới',
                    showCancelButton: true,
                    reverseButtons: true,
                    cancelButtonText: 'Hủy',
                    confirmButtonText: 'Cập nhật',
                })

                if (value) {
                    password = `${value}`
                    $.ajax({
                        url: CHANGE_PASSWORD,
                        type: "POST",
                        data: {
                            'id': $('.btnSave').attr('data_id'),
                            'password': password,
                        },
                        success: function (result) {
                            result = JSON.parse(result);
                            if (result.status === 200) {
                                $('#userTable').DataTable().ajax.reload();
                                $('#modal-user').modal('hide');
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
                }

            })



        });


    </script>

@endsection



