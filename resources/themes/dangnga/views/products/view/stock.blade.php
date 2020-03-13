{!! view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]) !!}

@if (isset($meta) && $meta)
    <li class="product__meta-availability">{{__('shop::app.products.availability')}}:
        @if($product->haveSufficientQuantity(1))
            <span class="text-success">{{__('shop::app.products.in-stock')}}</span>
        @else
            <span class="text-danger">{{__('shop::app.products.out-of-stock')}}</span>
        @endif
    </li>
@else
    <div class="product__availability">{{__('shop::app.products.availability')}}:
        @if($product->haveSufficientQuantity(1))
            <span class="text-success">{{__('shop::app.products.in-stock')}}</span>
        @else
            <span class="text-danger">{{__('shop::app.products.out-of-stock')}}</span>
        @endif
    </div>
@endif

{!! view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]) !!}