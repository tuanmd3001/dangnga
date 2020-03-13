@extends('shop::layouts.master')

@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')
@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('configurableOptionHelper', 'Webkul\Product\Helpers\ConfigurableOption')

@php
    $total = $reviewHelper->getTotalReviews($product);
    $images = $productImageHelper->getGalleryImages($product);
    $config = $configurableOptionHelper->getConfigurationConfig($product);

    $avgRatings = $reviewHelper->getAverageRating($product);
    $avgStarRating = ceil($avgRatings);

    $product['avgRating'] = $avgRatings > 0 ? $avgRatings: null;
    $product['totalReviews'] = $total;
    $product['shortDescription'] = $product->short_description;
    $product['is_stock'] = $product->haveSufficientQuantity(1);
    $product['priceHTML'] = view('shop::products.price', ['product' => $product])->render();
    $product['formAction'] = route('cart.add', $product->product_id);

@endphp

@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description"
          content="{{ trim($product->meta_description) != "" ? $product->meta_description : str_limit(strip_tags($product->description), 120, '') }}"/>
    <meta name="keywords" content="{{ $product->meta_keywords }}"/>
@stop

@push('css')
    <style type="text/css">
    </style>
@endpush

@section('full-content-wrapper')
    {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('shop.home.index') }}">Trang chủ</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="product--layout--standard" data-layout="standard">
                <div class="product__content">
                    {{-- product-gallery --}}
                    <product-gallery json-images="{{json_encode($images)}}"></product-gallery>
                    <product-info json-product="{{json_encode($product)}}"></product-info>
                    <product-sidebar json-product="{{json_encode($product)}}" config="{{json_encode($config)}}"></product-sidebar>
                </div>
            </div>
            <div class="product-tabs">
                <div class="product-tabs__list">
                    <a href="#tab-description" class="product-tabs__item product-tabs__item--active">{{ __('velocity::app.products.description') }}</a>
                    <a href="#tab-specification" class="product-tabs__item">{{ __('velocity::app.products.specification') }}</a>
                    <a href="#tab-reviews" class="product-tabs__item">{{ __('velocity::app.products.reviews') }}</a>
                </div>
                <div class="product-tabs__content">
                    <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                        <div class="typography">{!! $product->description !!}</div>
                    </div>
                    <div class="product-tabs__pane" id="tab-specification">
                        @include ('shop::products.view.attributes')
                    </div>
                    <div class="product-tabs__pane" id="tab-reviews">
                        @include ('shop::products.view.reviews')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
@endsection