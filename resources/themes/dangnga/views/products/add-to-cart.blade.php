{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}

@if (isset($form) && !$form)
    <button
        type="submit"
        {{ ! $product->isSaleable() ? 'disabled' : '' }}
        class="btn btn-add-to-cart {{ $addToCartBtnClass ?? '' }}">

        @if (! (isset($showCartIcon) && !$showCartIcon))
            <i class="material-icons text-down-3">shopping_cart</i>
        @endif

        <span class="fs14 fw6 text-uppercase text-up-4">
            {{ __('shop::app.products.add-to-cart') }}
        </span>
    </button>
@else
    <form method="POST" action="{{ route('cart.add', $product->product_id) }}" style="display: flex; width: 100%;">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <input type="hidden" name="quantity" value="1">
        <button
            {{ ! $product->isSaleable() ? 'disabled' : '' }}
            class="btn btn-primary product-card__addtocart" type="submit">
            {{ __('shop::app.products.add-to-cart') }}
        </button>
        <button
            {{ ! $product->isSaleable() ? 'disabled' : '' }}
            class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="submit">
            {{ __('shop::app.products.add-to-cart') }}
        </button>
        @if (! (isset($showWishlist) && !$showWishlist))
            @include('shop::products.wishlist', [
                'addClass' => $addWishlistClass ?? ''
            ])
        @endif
    </form>
@endif

{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}