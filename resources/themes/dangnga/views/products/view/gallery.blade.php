@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

@php
    $images = $productImageHelper->getGalleryImages($product);
@endphp

{!! view_render_event('bagisto.shop.products.view.gallery.before', ['product' => $product]) !!}
    <div class="product__gallery">
        <div class="product-gallery">
            <div class="product-gallery__featured">
                <button class="product-gallery__zoom">
                    <svg width="24px" height="24px">
                        <use xlink:href="images/sprite.svg#zoom-in-24"></use>
                    </svg>
                </button>
                <div class="owl-carousel" id="product-image">
                    @foreach ($images as $index => $thumb)
                        <a href="{{ $thumb['large_image_url'] }}" target="_blank">
                            <img :lazy="true" src="{{ $thumb['large_image_url'] }}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="product-gallery__carousel">
                <div class="owl-carousel" id="product-carousel">
                    @foreach ($images as $index => $thumb)
                        <a href="{{$thumb['small_image_url']}}"
                           class="product-gallery__carousel-item">
                            <img :lazy="true" class="product-gallery__carousel-image" src="{{$thumb['small_image_url']}}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

{!! view_render_event('bagisto.shop.products.view.gallery.after', ['product' => $product]) !!}