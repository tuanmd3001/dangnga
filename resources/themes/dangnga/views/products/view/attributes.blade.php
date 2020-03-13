@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

{!! view_render_event('bagisto.shop.products.view.attributes.before', ['product' => $product]) !!}
    @php
        $customAttributeValues = $productViewHelper->getAdditionalData($product);
    @endphp

    @if ($customAttributeValues && $customAttributeValues[0]['value'])
        <div class="spec">
            @foreach ($customAttributeValues as $attribute)
                <div class="spec__row">
                    <div class="spec__name">{{ $attribute['label'] ? $attribute['label'] : $attribute['admin_name'] }}</div>
                    <div class="spec__value">
                    @if ($attribute['type'] == 'file' && $attribute['value'])
                        <a  href="{{ route('shop.product.file.download', [$product->product_id, $attribute['id']])}}">
                            <i class="icon sort-down-icon download"></i>
                        </a>
                    @elseif ($attribute['type'] == 'image' && $attribute['value'])
                        <a href="{{ route('shop.product.file.download', [$product->product_id, $attribute['id']])}}">
                            <img src="{{ Storage::url($attribute['value']) }}" style="height: 20px; width: 20px;"/>
                        </a>
                    @else
                        {{ $attribute['value'] }}
                    @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

{!! view_render_event('bagisto.shop.products.view.attributes.after', ['product' => $product]) !!}