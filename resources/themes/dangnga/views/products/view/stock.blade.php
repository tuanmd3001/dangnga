{!! view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]) !!}

<div class="col-12 availability">
    <div class="product__availability">Tình trạng:
        {{! $product->haveSufficientQuantity(1) ? '' : '<span class="text-success">Còn hàng</span>' }}
        {{ $product->haveSufficientQuantity(1) ? '' : '<span class="text-error">Hết hàng</span>' }}
    </div>
</div>

{!! view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]) !!}