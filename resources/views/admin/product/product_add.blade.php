@extends('admin.master')
@section('header')
    @if($type == 'add') THÊM SẢN PHẨM
    @elseif ($type == 'update') CẬP NHẬT SẢN PHẨM
    @endif
@endsection

@section('content')

        <div class="card card-primary">

                <div class="card-body">
                    <div class="row">
                        <div class="col-6 row"  style="min-width: 260px">
                            <div class="col-6" style="border-right: gray 1px solid;">
                                <label for="">Ảnh chính:</label>
                                <button class="btn btn-outline-secondary btn-sm float-right btnUpImage">
                                    <i class="fa-solid fa-image mr-1"></i>
                                    Chọn ảnh</button>
                                <div class="mt-3 text-center">
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" id="image" hidden>
                                    @if($type == 'add')
                                        <img class="" src="{{ asset('public/mySource/imgs/avatars/phone.jpg') }}" alt="" id="image_preview_container" style="height: 250px; width: 250px">
                                    @elseif ($type == 'update')
                                        <img class="" src="{{ asset($product->image) }}" alt="" id="image_preview_container" style="height: 250px; width: 250px">
                                    @endif
                                </div>
                            </div>

                            <div class="col-6"  style="min-width: 260px; min-height: 300px">
                                <label for="">Ảnh phụ:</label>
                                <div class="float-right">
                                    <button class="btn btn-outline-secondary btn-sm btnUpMulImages">
                                        <i class="fa-solid fa-images mr-1"></i>
                                        Chọn ảnh</button>
                                    <button class="btn btn-outline-danger btn-sm btnClrMul">
                                        <i class="fa-solid fa-trash mr-1"></i>
                                        Xóa</button>
                                </div>
                                <div class="mt-3 text-center">
                                    <form enctype="multipart/form-data" id="formAddProduct">
                                        <input type="file" name="images[]" id="images"  multiple hidden>
                                    </form>
                                    <div class="show-multiple-image-preview" style="width: 100%; height: 90%; overflow-y: scroll; position: absolute;">
{{--                                        <img class="" src="{{ asset('public/mySource/imgs/avatars/bla.jpg') }}" alt="" style="height: 90px; width: 90px">--}}
                                        @if ($type == 'update')
                                            @foreach( \File::allFiles($product->images_list) as $file )
                                                <img class="" src="{{ asset($file) }}" alt="" style="height: 90px; width: 90px">
                                            @endforeach
                                        @endif
                                    </div>
                                    </div>
                            </div>
                        </div>


                        <div class="col-6 row ml-3 mt-5 form-group" style="min-width: 260px">
                            <div class="form-group col-12">
                                <label for="nameProduct">Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="nameProduct" placeholder="Tên sản phẩm"
                                @if ($type == 'update')
                                    value="{{ $product->name }}"
                                @endif
                                >
                            </div>

                            <div class="form-group col-4">
                                <label>Danh mục:</label>
                                <select class="form-control" id="cateProduct">
                                    <option value="Điện thoại">Điện thoại</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Máy tính bàn (PC)">Máy tính bàn (PC)</option>
                                    <option value="Đồng hồ thông minh">Đồng hồ thông minh</option>
                                    <option value="Máy tính bảng">Máy tính bảng</option>
                                    <option value="Phụ kiện">Phụ kiện</option>
                                </select>
                            </div>

                            <div class="form-group col-5">
                                <label for="priceProduct">Giá sản phẩm:</label>
                                <div  class="input-group">
                                    <input type="text" class="form-control" id="priceProduct" data-thousands="." placeholder="Giá sản phẩm"
                                    @if ($type == 'update')
                                       value="{{ $product->price }}"
                                    @endif
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text">VND</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-3">
                                <label for="discountProduct">Giảm giá:</label>
                                <div  class="input-group">
                                    <input type="number" class="form-control" id="discountProduct" placeholder="Giảm giá"
                                    @if ($type == 'update')
                                       value="{{ $product->discount }}"
                                    @endif
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-3">
                                <label>Trạng thái:</label>
                                <select class="form-control" id="statusProduct">
                                    <option value="1">Còn hàng</option>
                                    <option value="0">Tạm hết hàng</option>
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label>Thương hiệu:</label>
                                <select class="form-control" id="brandProduct">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-2">
                                <label for="ramProduct">RAM:</label>
                                <input type="number" class="form-control" id="ramProduct"
                                @if ($type == 'update')
                                   value="{{ $product->ram }}"
                                @endif
                                >
                            </div>

                            <div class="form-group col-4">
                                <label for="chipProduct">Chip:</label>
                                <input type="text" class="form-control" id="chipProduct"
                                @if ($type == 'update')
                                   value="{{ $product->chip }}"
                                @endif
                                >
                            </div>


                        </div>

                        <div class="form-group col-12 mt-5">
                            <label for="descriptionProduct">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="descriptionProduct" cols="30" rows="5" placeholder="Mô tả sản phẩm">
                                @if ($type == 'update')
                                    {{ \File::get($product->description) }}
                                @endif
                            </textarea>
                        </div>

                        <div class="form-group col-12">
                            <label for="specificationProduct">Thông số kỹ thuật:</label>
                            <textarea class="form-control" id="specificationProduct">
                                @if ($type == 'update')
                                    {{ \File::get($product->specification) }}
                                @endif
                            </textarea>
                        </div>


                    </div>

                </div>

            <div class="card-footer">
                <button class="btn btn-outline-danger btnBack">Trở lại</button>

                <button class="btn btn-outline-primary float-right btnSubmit">
                    @if($type == 'add')
                        Thêm
                    @elseif($type == 'update')
                        Cập nhật
                    @endif
                </button>

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


@endsection

@section('script')

    <script>

        $("#priceProduct").maskMoney({
            thousands:'.', decimal:',', precision: 0,
        });

        $("#priceProduct").maskMoney('mask');

        @if ($type == 'add')
            var ADD_PRODUCT = '{{ action('App\Http\Controllers\productController@addProduct') }}'
        @elseif($type == 'update')
            var UPDATE_PRODUCT = '{{ action('App\Http\Controllers\productController@updateProduct') }}'
        @endif

        var image_product = '';

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

        var ShowMultipleImagePreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                imgPreviewPlaceholder.html("");
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img style="height: 90px; width: 90px" >')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $(document).ready(function () {

            @if ($type == 'update')
            $('#cateProduct').val('{{ $product->category }}')
            $('#statusProduct').val('{{ $product->status }}')
            $('#brandProduct').val('{{ $product->brand_id }}')
            @endif

            $('#specificationProduct').summernote({
                placeholder: 'Thông số kỹ thuật',
                height: 500,
                toolbar: false,
            });

            $('#descriptionProduct').summernote({
                placeholder: 'Mô tả',
                height: 500,
                toolbar: false,
            });

            $('.btnUpImage').click(function (){
                $('#image').click();
            });
            $('.btnReChoose').click(function (){
                $('#image').click();
            });
            $('.btnCloseUpload').click(function (){
                $('#uploadimageModal').modal('hide');
            });


            $('.btnUpMulImages').click(function (){
                $('#images').click();
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
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event){
                image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    image_product = response;
                    $('#image_preview_container').attr('src', response);
                })
                $('#uploadimageModal').modal('hide');
            });




            $('#images').on('change', function() {
                var images = $('.show-multiple-image-preview');
                ShowMultipleImagePreview(this, images);
            });

            $('.btnClrMul').click(function () {
                $('.show-multiple-image-preview').html('');
                $('#images').val('');
            })

            $('.btnSubmit').click(function () {

                @if($type == 'add')
                if ($('#image').val() === ''){
                    Toast.fire({
                        icon: 'error',
                        title: 'Ảnh chính không được bỏ trống!'
                    })
                    return
                }
                @endif

                if ($('#nameProduct').val() === ''){
                    Toast.fire({
                        icon: 'error',
                        title: 'Tên sản phẩm không được bỏ trống!'
                    })
                    return
                }

                if ($('#priceProduct').val() === '0'){
                    Toast.fire({
                        icon: 'error',
                        title: 'Giá sản phẩm không được bỏ trống!'
                    })
                    return
                }

                var discount = parseInt($('#discountProduct').val())
                if (discount !='' && (discount > 100 || discount < 0)){
                    Toast.fire({
                        icon: 'error',
                        title: 'Giảm giá phải từ 0 đến 100!'
                    })
                    return
                }

                $('#formAddProduct').submit();
            })


            $('#formAddProduct').submit(function (e){
                e.preventDefault();

                var image = $('#image')[0].files[0];

                var formData = new FormData(jQuery('#formAddProduct')[0]);

                @if($type == 'update')
                formData.append( 'id', {{ $product->id }} );
                @endif

                formData.append( 'image', image_product );
                formData.append( 'name', $('#nameProduct').val() );
                formData.append( 'category', $('#cateProduct').val() );
                formData.append( 'price', $('#priceProduct').val() );
                formData.append( 'discount', $('#discountProduct').val() );
                formData.append( 'description', $('#descriptionProduct').val() );
                formData.append( 'specification', $('#specificationProduct').val() );
                formData.append( 'status', $('#statusProduct').val() );
                formData.append( 'brand', $('#brandProduct').val() );
                formData.append( 'ram', $('#ramProduct').val() );
                formData.append( 'chip', $('#chipProduct').val() );


                $.ajax({
                    @if($type == 'add')
                        url: ADD_PRODUCT,
                    @elseif($type == 'update')
                        url: UPDATE_PRODUCT,
                    @endif
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function (result){
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao tác thành công',
                                showConfirmButton: false,
                                text: result.message,
                            })
                            setTimeout(function() {
                                window.location.href= document.referrer
                                // history.go(-1);
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao tác thất bại',
                                text: result.message,
                            })
                        }
                    }
                });

            });


            $('.btnBack').click(function () {
                {{--window.location.href= '{{ action('App\Http\Controllers\productController@getView') }}'--}}
                    window.location.href= document.referrer
            })


        });


    </script>

@endsection



