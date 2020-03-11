@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@if ($cart)
    <?php $items = $cart->items; ?>

    <div class="indicator indicator--trigger--click">
        <a href="#" class="indicator__button">
            <span class="indicator__area"><svg width="20px" height="20px">
                    <use xlink:href="/images/sprite.svg#cart-20"></use>
                </svg>
                <span class="indicator__value">{{count($items)}}</span>
            </span>
        </a>
        <div class="indicator__dropdown"><!-- .dropcart -->
        <div class="dropcart dropcart--style--dropdown">
            <div class="dropcart__body">
                <div class="dropcart__products-list">
                    @foreach ($items as $item)
                        <div class="dropcart__product">
                            <div class="dropcart__product-image">
                                @php
                                    $images = $item->product->getTypeInstance()->getBaseImage($item);
                                @endphp
                                <a href="product.html">
                                    <img src="{{ $images['small_image_url'] }}" alt="">
                                </a>
                            </div>
                            <div class="dropcart__product-info">

                                {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.before', ['item' => $item]) !!}
                                <div class="dropcart__product-name">
                                    <a href="product.html">
                                        {{ $item->name }}
                                    </a>

                                </div>
                                {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.after', ['item' => $item]) !!}

                                {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.before', ['item' => $item]) !!}
                                @if (isset($item->additional['attributes']))
                                    <ul class="dropcart__product-options">
                                        @foreach ($item->additional['attributes'] as $attribute)
                                            <li>{{ $attribute['attribute_name'] }} : {{ $attribute['option_label'] }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.after', ['item' => $item]) !!}


                                <div class="dropcart__product-meta">
                                    {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.before', ['item' => $item]) !!}

                                    <span class="dropcart__product-quantity">{{ $item->quantity }}</span> ×
                                    {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.after', ['item' => $item]) !!}

                                    {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.before', ['item' => $item]) !!}
                                    <span class="dropcart__product-price">{{ core()->currency($item->base_total) }}</span>
                                    {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.after', ['item' => $item]) !!}
                                </div>

                            </div>
                            <a href="{{ route('shop.checkout.cart.remove', ['id' => $item->id]) }}"
                                    class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                <svg width="10px" height="10px">
                                    <use xlink:href="/images/sprite.svg#cross-10"></use>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="dropcart__totals">
                    <table>
                        <tr>
                            <th>Tạm tính</th>
                            <td>{{ core()->currency($cart->base_sub_total) }}</td>
                        </tr>
                        @if ($cart->selected_shipping_rate)
                            <tr>
                                <th>Shipping</th>
                                <td>{{ core()->currency($cart->selected_shipping_rate->base_price) }}</td>
                            </tr>
                        @endif
                        @if ($cart->base_tax_total)
                            @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($cart, true) as $taxRate => $baseTaxAmount )
                                <tr>
                                    <th>{{ __('shop::app.checkout.total.tax') }} {{ $taxRate }} %</th>
                                    <td>{{ core()->currency($baseTaxAmount) }}</td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <th>{{ __('shop::app.checkout.total.grand-total') }}</th>
                            <td>{{ core()->currency($cart->base_grand_total) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="dropcart__buttons">
                    <a class="btn btn-secondary" href="{{ route('shop.checkout.cart.index') }}">
                        Xem giỏ hàng
                    </a>
                    <a class="btn btn-primary" href="{{ route('shop.checkout.onepage.index') }}">Thanh toán</a>
                </div>
            </div>
        </div><!-- .dropcart / end -->
    </div>
    </div>
@else
    <div class="indicator indicator--trigger--click">
        <a href="#" class="indicator__button">
            <span class="indicator__area"><svg width="20px" height="20px">
                    <use xlink:href="/images/sprite.svg#cart-20"></use>
                </svg>
                <span class="indicator__value">0</span>
            </span>
        </a>
        <div class="indicator__dropdown"><!-- .dropcart -->
            <div class="dropcart dropcart--style--dropdown">
                <div class="dropcart__body">
                    <div style="padding: 20px">
                        Không có sản phẩm nào trong giỏ
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif