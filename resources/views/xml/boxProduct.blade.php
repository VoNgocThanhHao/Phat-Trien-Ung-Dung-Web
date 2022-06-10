@if(count($products) == 0)
    <h2>Hiện tại chưa có sản phẩm theo yêu cầu của bạn</h2>
@else
@foreach($products as $product)

    <div class="col-sm-3 p-3" style="min-width: 300px">
        <div class="my-card-product text-white" style="border-radius: 10px;border: white solid 1px;">
            <div class="text-center">
                <img class="mt-2" src="{{ asset($product->image) }}" alt=""
                     style="width: 80%">
            </div>
            <div class="text-center">
                <p class="mt-2 h5"><strong>{{ $product->product_name }}</strong></p>
                @if($product->chip != '')
                    <p style="">
                        <i class="fa-solid fa-microchip"></i> {{ $product->chip }}
                    </p>
                @else
                    <p style="visibility: hidden">
                        <i class="fa-solid fa-microchip"></i>
                    </p>
                @endif
                <p>
                    <i class="fa-brands fa-invision"></i> {{ $product->brand_name }}
                    &ensp;
                    @if($product->ram != '')
                        <i class="fa-solid fa-memory"></i> {{ $product->ram }} GB
                    @endif
                </p>
                <p style="font-size: 1.5rem;">
                    <strong>
                                    <span style=" background-color: black; border-radius: 15px; color: white">
                                        &ensp; {{ number_format($product->price, 0 ,"," ,".") }} VND &ensp;
                                    </span>
                    </strong>
                </p>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-danger float-left ml-4 btnAddFav" data="{{ $product->id }}"
                            style="border-radius: 50%"><i class="fa-solid fa-heart-circle-plus"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary float-none text-white btnBuy" data="{{ $product }}"
                            style="border-radius: 100px">MUA NGAY
                    </button>
                    <a href="{{ action('App\Http\Controllers\productController@getViewProductDetail', $product->id) }}" type="button" class="btn btn-outline-primary float-right mr-4"
                            style="border-radius: 50%"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
    </div>

@endforeach
@endif
