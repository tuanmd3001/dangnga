@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

{!! view_render_event('bagisto.shop.products.wishlist.before') !!}
    @auth('customer')
        @php
            $isWished = $wishListHelper->getWishlistProduct($product);
        @endphp
        <a
            @if (! $isWished)
            href="{{ route('customer.wishlist.add', $product->product_id) }}"
            title="{{ __('velocity::app.shop.wishlist.add-wishlist-text') }}"
            @elseif (isset($itemId) && $itemId)
            href="{{ route('customer.wishlist.remove', $itemId) }}"
            title="{{ __('velocity::app.shop.wishlist.remove-wishlist-text') }}"
            @endif>
            <wishlist-btn active="{{ !$isWished }}"></wishlist-btn>
        </a>
        <button
            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
            type="button">
            <svg width="16px" height="16px">
                <use xlink:href="images/sprite.svg#compare-16"></use>
            </svg>
            <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
        </button>
    @endauth

    @guest('customer')
        <a href="{{ route('customer.session.index') }}">
            <wishlist-btn active="false"></wishlist-btn>
        </a>
        <button
            class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare"
            type="button">
            <svg width="16px" height="16px">
                <use xlink:href="images/sprite.svg#compare-16"></use>
            </svg>
            <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
        </button>
    @endauth
{!! view_render_event('bagisto.shop.products.wishlist.after') !!}