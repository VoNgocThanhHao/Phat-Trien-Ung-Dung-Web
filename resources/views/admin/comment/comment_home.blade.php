@extends('admin.master')
@section('header') QUẢN LÝ BÌNH LUẬN
@endsection

@section('content')

    {{--------------------------------------Datatable-------------------------------------------------}}

    <div class="card">

        <div class="card-body">

            <table id="commentTable"
                   class="table table-hover dataTable dtr-inline projects"
                   role="grid"
                   aria-describedby="example1_info" style="text-align: center">
                <thead>
                <tr role="row">
                    <th style="width:10px">#</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                        colspan="1" aria-sort="ascending"
                        style="width: 300px"> Tên sản phẩm
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style=""> Nội dung
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                        colspan="1" aria-sort="ascending"
                        style="width: 200px"> Tên người gửi
                    </th>
                    <th style="width:100px">
                        Thời gian
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

        $(document).ready(function () {

            $('#commentTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "serverSide": true,
                "ajax": '{{ action('App\Http\Controllers\commentController@getDataTable') }}',
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'product_id', name: 'product_id'},
                    {data: 'content', name: 'content'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'},
                ]
            });



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
                            url: '{{ action('App\Http\Controllers\commentController@deleteComment') }}',
                            type: "DELETE",
                            data: {
                                'id': id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('#commentTable').DataTable().ajax.reload();
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



