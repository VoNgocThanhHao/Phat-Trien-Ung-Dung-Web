@extends('guest.master')
@section('style')

    <style>

        #btnBoxInfo {
            display: none;
        }

        #boxInfo:hover #textBoxInfo {
            filter: blur(3px);
        }

        #boxInfo:hover #btnBoxInfo {
            display: block;
        }


    </style>

@endsection
@section('content')

    <div class="container">
        <section class="content" style="background-color: black; padding-top: 5rem">

            <div class="card card-solid text-white" style="background-color: rgba(255,255,255,0.1)">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                            <div class="col-12 text-center"
                                 style="background-color: white; border: rgba(0,0,0,0.5) 5px solid">
                                <img src="{{ asset($product->image) }}"
                                     class="product-image"
                                     alt="Product Image" style="max-width: 60%">
                            </div>
                            <div class="col-12 product-image-thumbs" style="">
                                <div class="product-image-thumb"><img
                                        src="{{ asset($product->image) }}"
                                        alt="Product Image"></div>
                                @foreach( \File::allFiles($product->images_list) as $file )
                                    <div class="product-image-thumb"><img
                                            src="{{ asset($file) }}"
                                            alt="Product Image"></div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-12 col-sm-6" style="padding-left: 3rem;">
                            <h2 class="my-3">{{ $product->name }}</h2>
                            <h2 class="p-2"
                                style="font-weight: bolder; background-color: white; color: black; display: inline-block; border-radius: 15px; ">
                                {{ number_format($product->price, 0 ,"," ,".") }} VND</h2>
                            <hr style="background-color: white">

                            <div style="padding-right: 6rem;">
                                <div id="boxInfo" class="" style="position: relative; ">
                                    <h5>Thông số kỹ thuật:</h5>
                                    <div id="textBoxInfo" class="card text-white textBoxInfo" style=" overflow: hidden; width: 100%; height: 250px; display: inline-block;
border: solid 3px #3c8dbc; background-color: black">
                                <textarea class="form-control" id="specificationProduct">
                                    {{ \File::get($product->specification) }}
                                </textarea>
                                    </div>
                                    <button id="btnBoxInfo" type="button" class="btn btn-outline-primary" style="position: absolute;
                            top: 50%; left: 50%; transform: translate(-50%, -50%);" data-toggle="modal"
                                            data-target="#modal-lg">
                                        Xem chi tiết
                                    </button>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="btn btn-danger btn-lg btn-flat btnAddFav" data="{{ $product->id }}" style="border-radius: 5px">
                                    <i class="fas fa-heart fa-lg mr-2"></i>
                                    Yêu thích
                                </div>
                                <div class="btn btn-primary btn-lg btn-flat ml-3 btnBuy" data="{{ $product }}" style="border-radius: 5px">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    Mua ngay
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-4">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                   href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Đánh
                                    giá chi tiết</a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                   href="#product-comments" role="tab" aria-controls="product-comments"
                                   aria-selected="false">Bình luận</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent" style="width: 100%">
                            <div class="tab-pane fade active show" id="product-desc" role="tabpanel"
                                 aria-labelledby="product-desc-tab" style="background-color: white">
                            <textarea class="form-control" id="descriptionProduct">
                                    {{ \File::get($product->description) }}
                                </textarea>
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel"
                                 aria-labelledby="product-comments-tab" >


                                <div class="card direct-chat direct-chat-primary" style="background-color: rgba(255,255,255,0.1)">

                                    <div class="card-body ">

                                        <div class="direct-chat-messages pl-5 pr-5 boxComment" style="height: 50vh">

{{--                                        list comment--}}

                                        </div>


                                    </div>


                                    <div class="card-footer">
                                        @if(Auth::user())
                                            <div class="input-group">
                                                <input type="text" name="message" placeholder="Aa..."
                                                       class="form-control commentProduct">
                                                <span class="input-group-append">
<button type="button" class="btn btn-primary btnSent" style="z-index: 0">Gửi</button>
</span>
                                            </div>
                                        @else

                                            Bạn cần phải đăng nhập để bình luận

                                        @endif
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </section>
    </div>


    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông số kỹ thuật</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea id="specificationModal" class="form-control ">
                                    {{ \File::get($product->specification) }}
                                </textarea>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('script')

    <script>

        var getComment = function () {

            $.ajax({
                url: '{{ action('App\Http\Controllers\productController@getComment') }}',
                type: "GET",
                data: {
                    'id': {{ $product->id }},
                },
                success: function (result) {
                    $('.boxComment').html(result)
                }
            });
        }


        @if( Auth::user())

        var sentComment = function () {
            if ($('.commentProduct').val() === '') return

            $.post("{{ action('App\Http\Controllers\commentController@sentComment') }}", {"comment": $('.commentProduct').val(), "product_id":{{ $product->id }} })
            $('.commentProduct').val('')
        }

        @endif


        $(document).ready(function () {

            window.Echo.channel('chat')
                .listen('.comment', (e) => {
                    console.log(e)
                    getComment()
                });

            getComment()

            @if( Auth::user())

            $('.commentProduct').on('keypress', function (e) {
                if (e.which == 13) {
                    sentComment()
                }
            });

            $('.btnSent').click(function () {
                sentComment()
            })

            @endif

            $(document).ready(function () {
                $('.product-image-thumb').on('click', function () {
                    var $image_element = $(this).find('img')
                    $('.product-image').prop('src', $image_element.attr('src'))
                    $('.product-image-thumb.active').removeClass('active')
                    $(this).addClass('active')
                })


                $('#specificationProduct').summernote({
                    toolbar: false,
                });

                $('#specificationProduct').summernote("disable");

                $('#specificationModal').summernote({
                    toolbar: false,
                    disableResizeEditor: true,
                });

                $('#specificationModal').summernote("disable");

                $('#descriptionProduct').summernote({
                    toolbar: false,
                    disableResizeEditor: true,
                });

                $('#descriptionProduct').summernote("disable");

            })

        })

    </script>

@endsection
