@extends('admin.master')
@section('header') THƯƠNG HIỆU SẢN PHẨM
@endsection

@section('content')

    {{--------------------------------------Datatable-------------------------------------------------}}

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success btnAdd">Thêm</button>
        </div>

        <div class="card-body">

            <table id="brandTable"
                   class="table table-hover dataTable dtr-inline projects"
                   role="grid"
                   aria-describedby="example1_info" style="text-align: center">
                <thead>
                <tr role="row">
                    <th style="width:10px">#</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                        colspan="1" aria-sort="ascending"
                        style="width: 200px"> Tên thương hiệu
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 300px"> Từ khóa
                    </th>
                    <th style="width:100px">
                    </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


        </div>

    </div>

    {{---------------------------------------Modal----------------------------------------------------}}

    <div class="modal fade" id="modal-brand">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm thương hiệu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tên thương hiệu</label>
                        <input type="text" class="form-control nameBrand">
                    </div>

                    <div class="form-group">
                        <label for="">Từ khóa</label>
                        <input type="text" class="form-control slugBrand">
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

        var GET_DATATABLE = '{{ action('App\Http\Controllers\brandController@getDataTable') }}'
        var ADD_BRAND = '{{ action('App\Http\Controllers\brandController@addBrand') }}'
        var UPDATE_BRAND = '{{action('App\Http\Controllers\brandController@updateBrand')}}'
        var DELETE_BRAND = '{{ action('App\Http\Controllers\brandController@deleteBrand')  }}'

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

            $('#brandTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "serverSide": true, "ordering": false,
                "ajax": GET_DATATABLE,
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action'},
                ]
            });

            $(document).on('click', '.btnEdit', function () {
                var data = jQuery.parseJSON($(this).attr('data'));

                $('.modal-title').html('Cập nhật thương hiệu')
                $('.btnSave').html('Cập nhật')
                $('.nameBrand').val(data.name)
                $('.slugBrand').val(data.slug)
                $('.btnSave').attr('data','update')
                $('.btnSave').attr('data_id',data.id)

                $('#modal-brand').modal('show');
            })

            $('.btnAdd').click(function () {
                $('.modal-title').html('Thêm thương hiệu')
                $('.btnSave').html('Thêm')
                $('.nameBrand').val('')
                $('.slugBrand').val('')
                $('.btnSave').attr('data','insert')
                $('.btnSave').removeAttr('data_id')

                $('#modal-brand').modal('show');
            })

            $('.btnSave').click(function () {

                if($('.nameBrand').val() === ''){
                    Toast.fire({
                        icon: 'error',
                        title: 'Tên thương hiệu không được bỏ trống!'
                    })
                    return
                }

                if($('.slugBrand').val() === ''){
                    Toast.fire({
                        icon: 'error',
                        title: 'Từ khóa không được bỏ trống!'
                    })
                    return
                }

                var type = $('.btnSave').attr('data')

                switch (type) {

                    case 'insert':{
                        $.ajax({
                            url: ADD_BRAND,
                            type: "PUT",
                            data: {
                                'name': $('.nameBrand').val(),
                                'slug': $('.slugBrand').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#brandTable').DataTable().ajax.reload();
                                    $('#modal-brand').modal('hide');
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
                        break
                    }

                    case 'update':{
                        var id = $('.btnSave').attr('data_id');
                        $.ajax({
                            url: UPDATE_BRAND,
                            type: "POST",
                            data: {
                                'id': id,
                                'name': $('.nameBrand').val(),
                                'slug': $('.slugBrand').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#brandTable').DataTable().ajax.reload();
                                    $('#modal-brand').modal('hide');
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
                        break
                    }

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
                            url: DELETE_BRAND,
                            type: "DELETE",
                            data: {
                                'id': id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#brandTable').DataTable().ajax.reload();
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

        });


    </script>

@endsection



