@if(count($products) == 0)
    <p class="p-1 text-center">
        Hiện tại chưa có sản phẩm theo yêu cầu của bạn
    </p>
@else

@foreach($products as $product)
<a class="itemSearch" href="{{ action('App\Http\Controllers\productController@getViewProductDetail', $product->id) }}" style="position: relative; z-index: 1000">
    <div class="row p-2">
        <div class="col-sm-3" style="padding-right: 0 !important;">
            <img src="{{ asset($product->image) }}" alt=""
                 style="width: 100%; border-radius: 5px">
        </div>
        <div class="col-sm-9">
            <div class="row " style="padding-left: 10px;">
                <strong>{{ $product->name }}</strong>
            </div>
            <div class="row" style="padding-left: 10px;">
                {{ number_format($product->price, 0 ,"," ,".") }} VND
            </div>
        </div>
    </div>
</a>
@endforeach

@endif
