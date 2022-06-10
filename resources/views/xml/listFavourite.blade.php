@if(count($list) == 0)
    <h2 class="text-center">Hiện tại chưa có sản phẩm nào trong danh sách yêu thích của bạn</h2>
@else

@foreach($list as $item)
<div class="row itemFav mb-3"  style="border: black solid 1px; border-radius: 5px">
    <div class="col-md-4 text-center">
        <img src="{{ asset($item->product->image) }}" alt="" style="width: 70%">
    </div>
    <div class="col-md-8 row align-items-center">
        <a href="{{ action('App\Http\Controllers\productController@getViewProductDetail', $item->product_id) }}" class="col-sm-7 btnItemFav">
            <h4>{{ $item->product->name }}</h4>
            <p>
                <i class="fa-brands fa-invision"></i> {{ $item->product->brand->name }}
                @if($item->product->ram != '')
                <i class="fa-solid fa-memory ml-2"></i> {{ $item->product->ram }} GB
                @endif
            </p>
            @if($item->product->chip != '')
            <span>
                <i class="fa-solid fa-microchip"></i> {{ $item->product->chip }}
            </span>
            @endif
        </a>
        <div class="col-sm-5">
            <button type="button" class="btn btn-outline-primary btnBuy" data="{{$item->product}}">
                <i class="fa-solid fa-cart-shopping"></i> Mua ngay</button>
            <button type="button" class="btn btn-outline-danger btnDelFav" name="{{ $item->product->name }}" data="{{ $item->id }}"><i class="fa-solid fa-x"></i></button>
        </div>
    </div>
</div>
@endforeach

@endif
