@extends('admin.master')
@section('header') DANH SÁCH ĐƠN HÀNG
@endsection

@section('content')

    {{--------------------------------------Datatable-------------------------------------------------}}

    <div class="card">

        <div class="card-body">

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



    {{---------------------------------------Modal----------------------------------------------------}}

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


        $(document).ready(function () {

            $('#billTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "serverSide": true, "ordering": false,
                "ajax": '{{ action('App\Http\Controllers\billController@getDataTableAdmin') }}',
                "columns":
            [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'payment', name: 'payment'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ]
        })
            ;


            $(document).on('click', '.btnDetailHis', function () {
                var url = '{{ action('App\Http\Controllers\billController@getBillAdmin',1) }}'
                url = url.substring(0, url.length - 1)
                window.location = url + $(this).attr('data');
            })


            window.Echo.channel('chat')
                .listen('.notification', (e) => {
                    $('#billTable').DataTable().ajax.reload()
                });

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


        });


    </script>

@endsection



