@extends('admin.master')
@section('header') DANH SÁCH SẢN PHẨM
@endsection

@section('content')

    {{--------------------------------------Datatable-------------------------------------------------}}

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success btnAdd">Thêm</button>
        </div>

        <div class="card-body">

            <table id="productTable"
                   class="table table-hover dataTable dtr-inline projects"
                   role="grid"
                   aria-describedby="example1_info" style="text-align: center">
                <thead>
                <tr role="row">
                    <th style="width:10px">#</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                        colspan="1" aria-sort="ascending"
                        style=""> Tên sản phẩm
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 150px"> Danh mục
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style=""> Giá
                    </th>
                    <th style="width:140px">
                    </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


        </div>

    </div>

    {{---------------------------------------Modal----------------------------------------------------}}

    <div class="modal fade" id="modal-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control nameCate">
                    </div>

                    <div class="form-group">
                        <label for="">Từ khóa</label>
                        <input type="text" class="form-control slugCate">
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

        var GET_DATATABLE = '{{ action('App\Http\Controllers\productController@getDataTable') }}';
        var DELETE_PRODUCT = '{{ action('App\Http\Controllers\productController@deleteProduct') }}'

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

            $('#productTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "serverSide": true, "ordering": false,
                "ajax": GET_DATATABLE,
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'price', name: 'price'},
                    {data: 'action', name: 'action'},
                ],
            });


            $('.btnAdd').click(function (){
                window.location = '{{ action('App\Http\Controllers\productController@getViewAdd') }}';
            })

            $(document).on('click','.btnEdit',function () {
                var url = '{{ action('App\Http\Controllers\productController@getViewUpdate',1) }}'
                url = url.substring(0, url.length-1)
                window.location = url + $(this).attr('data');
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
                                    $('#productTable').DataTable().ajax.reload();
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



