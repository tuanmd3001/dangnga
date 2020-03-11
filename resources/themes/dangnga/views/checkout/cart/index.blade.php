@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
    <cart-component></cart-component>
@endsection

@push('css')
    <style type="text/css">
        .quantity {
            width: unset;
            float: right;
        }
    </style>
@endpush

@push('scripts')
    @include('shop::checkout.cart.coupon')

    <script type="text/x-template" id="cart-template">
        <div>
            <div class="page-header">
                <div class="page-header__container container">
                    <div class="page-header__breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    <svg class="breadcrumb-arrow" width="6px" height="9px">
                                        <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                    </svg>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header__title"><h1>Giỏ hàng</h1></div>
                </div>
            </div>

            @if ($cart)
            <div class="cart block">
                <div class="container">
                    <form
                        action="{{ route('shop.checkout.cart.update') }}"
                        method="POST"
                        @submit.prevent="onSubmit">
                        @csrf
                        <table class="cart__table cart-table">
                            <thead class="cart-table__head">
                            <tr class="cart-table__row">
                                <th class="cart-table__column cart-table__column--image">Ảnh</th>
                                <th class="cart-table__column cart-table__column--product">Tên sản phẩm</th>
                                <th class="cart-table__column cart-table__column--price">Đơn giá</th>
                                <th class="cart-table__column cart-table__column--quantity">Số lượng</th>
                                <th class="cart-table__column cart-table__column--total">Thành tiền</th>
                                <th class="cart-table__column cart-table__column--remove"></th>
                            </tr>
                            </thead>
                            <tbody class="cart-table__body">
                            @foreach ($cart->items as $key => $item)
                                @php
                                    $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);
                                    $product = $item->product;

                                    $productPrice = $product->getTypeInstance()->getProductPrices();

                                @endphp
                                <tr class="cart-table__row">
                                    <td class="cart-table__column cart-table__column--image">
                                        <a href="#">
                                            <img src="{{ $productBaseImage['medium_image_url'] }}" alt="{{$product->name}}">
                                        </a>
                                    </td>
                                    <td class="cart-table__column cart-table__column--product">
                                        <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" class="cart-table__product-name">
                                            {{$product->name}}
                                        </a>
                                        @if (isset($item->additional['attributes']))
                                            <ul class="cart-table__options">
                                            @foreach ($item->additional['attributes'] as $attribute)
                                                <li>{{ $attribute['attribute_name'] }}: {{ $attribute['option_label'] }}</li>
                                            @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="cart-table__column cart-table__column--price" data-title="Price">
                                        {{ core()->currency($item->base_price) }}
                                    </td>
                                    <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                                        <quantity-changer
                                            :control-name="'qty[{{$item->id}}]'"
                                            quantity="{{ $item->quantity }}">
                                        </quantity-changer>
                                    </td>
                                    <td class="cart-table__column cart-table__column--total" data-title="Total">{{ core()->currency( $item->base_total) }}</td>
                                    <td class="cart-table__column cart-table__column--remove">
                                        <button type="button" class="btn btn-light btn-sm btn-svg-icon">
                                            <a href="{{ route('shop.checkout.cart.remove', ['id' => $item->id]) }}">
                                                <svg width="12px" height="12px">
                                                    <use xlink:href="/images/sprite.svg#cross-12"></use>
                                                </svg>
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}
                        <div class="cart__actions">
                            <coupon-component></coupon-component>
                            <div class="cart__buttons">
                                <a href="{{ route('shop.home.index') }}" class="btn btn-light">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>
                                <button type="submit" class="btn btn-primary cart__update-button">{{ __('shop::app.checkout.cart.update-cart') }}</button>
                            </div>
                        </div>
                        <div class="row justify-content-end pt-5">
                            <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                                @include('shop::checkout.total.summary', ['cart' => $cart])
                            </div>
                        </div>
                        {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
                    </form>
                </div>
            </div>

            @else
                <div class="block-empty__body">
                    <div class="block-empty__message">{{ __('shop::app.checkout.cart.empty') }}</div>
                    <div class="block-empty__actions"><a class="btn btn-primary btn-sm" href="{{ route('shop.home.index') }}">{{ __('shop::app.checkout.cart.continue-shopping') }}</a></div>
                </div>
            @endif
        </div>
    </script>

    <script type="text/javascript" id="cart-template">
        (() => {
            Vue.component('cart-component', {
                template: '#cart-template',
                data: function () {
                    return {
                        isMobileDevice: this.isMobile(),
                    }
                }
            })

            function removeLink(message) {
                if (!confirm(message))
                event.preventDefault();
            }
        })()
    </script>

    <script type="text/x-template" id="quantity-changer-template">
        <div class="input-number">
            <div class="wrap">
                <input :name="controlName" :value="qty" v-validate="'required|numeric|min_value:1'" data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" class="form-control input-number__input">
                <div class="input-number__sub" @click="decreaseQty()"></div>
                <div class="input-number__add" @click="increaseQty()"></div>

                <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
            </div>
        </div>
    </script>

    <script>
        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',

            inject: ['$validator'],

            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },

            methods: {
                decreaseQty: function() {
                    if (this.qty > 1)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        function removeLink(message) {
            if (!confirm(message))
                event.preventDefault();
        }

        function updateCartQunatity(operation, index) {
            var quantity = document.getElementById('cart-quantity'+index).value;

            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('{{ __('shop::app.products.less-quantity') }}');
                }
            }
            document.getElementById('cart-quantity'+index).value = quantity;
            event.preventDefault();
        }
    </script>
@endpush