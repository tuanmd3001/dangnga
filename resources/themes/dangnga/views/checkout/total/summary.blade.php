<div class="card">
    <div class="card-body">
        <h3 class="card-title">{{ __('shop::app.checkout.total.order-summary') }}</h3>
        <table class="cart__totals">
            <thead class="cart__totals-header">
            <tr>
                <th>Subtotal</th>
                <td>{{ core()->currency($cart->base_sub_total) }}</td>
            </tr>
            </thead>
            <tbody class="cart__totals-body">
            @if ($cart->selected_shipping_rate)
                <tr>
                    <th>{{ __('shop::app.checkout.total.delivery-charges') }}</th>
                    <td>{{ core()->currency($cart->selected_shipping_rate->base_price) }}
{{--                        <div class="cart__calc-shipping">--}}
{{--                            <a href="#">Calculate Shipping</a>--}}
{{--                        </div>--}}
                    </td>
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
            @if ($cart->base_discount_amount && $cart->base_discount_amount > 0)
                <tr>
                    <th>{{ __('shop::app.checkout.total.disc-amount') }}</th>
                    <td>-{{ core()->currency($cart->base_discount_amount) }}</td>
                </tr>
            @endif
            </tbody>
            <tfoot class="cart__totals-footer">
            <tr>
                <th>{{ __('shop::app.checkout.total.grand-total') }}</th>
                <td>{{ core()->currency($cart->base_grand_total) }}</td>
            </tr>
            </tfoot>
        </table>
        <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="checkout.html">
            Proceed
            to checkout
        </a>
    </div>
</div>