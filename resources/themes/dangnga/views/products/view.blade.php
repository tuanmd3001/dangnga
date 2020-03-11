@extends('shop::layouts.master')

@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')

@php
    $total = $reviewHelper->getTotalReviews($product);

    $avgRatings = $reviewHelper->getAverageRating($product);
    $avgStarRating = ceil($avgRatings);
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
            <div class="product product--layout--standard" data-layout="standard">
                <div class="product__content">

                    {{-- product-gallery --}}
                    @include ('shop::products.view.gallery')
                    <div class="product__info">
                            <div class="product__wishlist-compare">
                                <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip"
                                        data-placement="right" title="Wishlist">
                                    <svg width="16px" height="16px">
                                        <use xlink:href="images/sprite.svg#wishlist-16"></use>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip"
                                        data-placement="right" title="Compare">
                                    <svg width="16px" height="16px">
                                        <use xlink:href="images/sprite.svg#compare-16"></use>
                                    </svg>
                                </button>
                            </div>
                            <h1 class="product__name">{{ $product->name }}</h1>
                            <div class="product__rating">
                                <div class="product__rating-stars">
                                    <div class="rating">
                                        <div class="rating__body">
                                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product__rating-legend"><a href="#">7 Reviews</a><span>/</span><a href="#">Write A Review</a></div>

                            </div>
                            @if ($product->short_description)
                                <div class="product__description">
                                    {!! $product->short_description !!}
                                </div>
                            @endif
                            <ul class="product__features">
                                <li>Speed: 750 RPM</li>
                                <li>Power Source: Cordless-Electric</li>
                                <li>Battery Cell Type: Lithium</li>
                                <li>Voltage: 20 Volts</li>
                                <li>Battery Capacity: 2 Ah</li>
                            </ul>
                            <ul class="product__meta">
                                <li class="product__meta-availability">Tình trạng:
                                    @if($product->haveSufficientQuantity(1))
                                        <span class="text-success">Còn hàng</span>
                                    @else
                                        <span class="text-danger">Hết hàng</span>
                                    @endif
                                </li>
                                <li>Thương hiệu: <a href="#">Wakita</a></li>
                                <li>Mã sản phẩm: {{$product->sku}}</li>
                            </ul>
                            <div class="product__sidebar">
                                <div class="product__availability">Tình trạng:
                                    @if($product->haveSufficientQuantity(1))
                                        <span class="text-success">Còn hàng</span>
                                    @else
                                        <span class="text-danger">Hết hàng</span>
                                    @endif
                                </div>
                                @include ('shop::products.price', ['product' => $product])
                                <product-view>
                                    @csrf()
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    @include ('shop::products.view.configurable-options')
                                    <div class="form-group product__option">
                                        <label
                                            class="product__option-label">Color</label>
                                        <div class="input-radio-color">
                                            <div class="input-radio-color__list"><label
                                                    class="input-radio-color__item input-radio-color__item--white"
                                                    style="color: #fff;" data-toggle="tooltip" title="White"><input
                                                        type="radio" name="color"> <span></span></label> <label
                                                    class="input-radio-color__item" style="color: #ffd333;"
                                                    data-toggle="tooltip" title="Yellow"><input type="radio" name="color">
                                                    <span></span></label> <label class="input-radio-color__item"
                                                                                 style="color: #ff4040;" data-toggle="tooltip"
                                                                                 title="Red"><input type="radio" name="color">
                                                    <span></span></label> <label
                                                    class="input-radio-color__item input-radio-color__item--disabled"
                                                    style="color: #4080ff;" data-toggle="tooltip" title="Blue"><input
                                                        type="radio" name="color" disabled="disabled"> <span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group product__option">
                                        <label
                                            class="product__option-label">Material</label>
                                        <div class="input-radio-label">
                                            <div class="input-radio-label__list"><label><input type="radio" name="material">
                                                    <span>Metal</span></label> <label><input type="radio" name="material">
                                                    <span>Wood</span></label> <label><input type="radio" name="material"
                                                                                            disabled="disabled">
                                                    <span>Plastic</span></label></div>
                                        </div>
                                    </div>
                                    <div class="form-group product__option">
                                        <label class="product__option-label" for="product-quantity">Quantity</label>
                                        <div class="product__actions">
                                            <div class="product__actions-item">
                                                <div class="input-number product__quantity"><input id="product-quantity"
                                                                                                   class="input-number__input form-control form-control-lg"
                                                                                                   type="number" min="1"
                                                                                                   value="1">
                                                    <div class="input-number__add"></div>
                                                    <div class="input-number__sub"></div>
                                                </div>
                                            </div>
                                            <div class="product__actions-item product__actions-item--addtocart">
                                                <button class="btn btn-primary btn-lg">Add to cart</button>
                                            </div>
                                            <div class="product__actions-item product__actions-item--wishlist">
                                                <button type="button" class="btn btn-secondary btn-svg-icon btn-lg"
                                                        data-toggle="tooltip" title="Wishlist">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="images/sprite.svg#wishlist-16"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="product__actions-item product__actions-item--compare">
                                                <button type="button" class="btn btn-secondary btn-svg-icon btn-lg"
                                                        data-toggle="tooltip" title="Compare">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="images/sprite.svg#compare-16"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </product-view>
                            </div>
                    </div>
                </div>
            </div>
            <div class="product-tabs">
                <div class="product-tabs__list">
                    <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Mô tả</a>
                    <a href="#tab-specification" class="product-tabs__item">Thông số kĩ thuật</a>
                    <a href="#tab-reviews" class="product-tabs__item">Đánh giá</a>
                </div>
                <div class="product-tabs__content">
                    <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                        <div class="typography">{!! $product->description !!}</div>
                    </div>
                    <div class="product-tabs__pane" id="tab-specification">
                        <div class="spec">
                            <h3 class="spec__header">Specification</h3>
                            <div class="spec__section"><h4 class="spec__section-title">General</h4>
                                <div class="spec__row">
                                    <div class="spec__name">Material</div>
                                    <div class="spec__value">Aluminium, Plastic</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Engine Type</div>
                                    <div class="spec__value">Brushless</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Battery Voltage</div>
                                    <div class="spec__value">18 V</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Battery Type</div>
                                    <div class="spec__value">Li-lon</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Number of Speeds</div>
                                    <div class="spec__value">2</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Charge Time</div>
                                    <div class="spec__value">1.08 h</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Weight</div>
                                    <div class="spec__value">1.5 kg</div>
                                </div>
                            </div>
                            <div class="spec__section"><h4 class="spec__section-title">Dimensions</h4>
                                <div class="spec__row">
                                    <div class="spec__name">Length</div>
                                    <div class="spec__value">99 mm</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Width</div>
                                    <div class="spec__value">207 mm</div>
                                </div>
                                <div class="spec__row">
                                    <div class="spec__name">Height</div>
                                    <div class="spec__value">208 mm</div>
                                </div>
                            </div>
                            <div class="spec__disclaimer">Information on technical characteristics, the delivery
                                set, the country of manufacture and the appearance of the goods is for reference
                                only and is based on the latest information available at the time of publication.
                            </div>
                        </div>
                    </div>
                    <div class="product-tabs__pane" id="tab-reviews">
                        <div class="reviews-view">
                            <div class="reviews-view__list"><h3 class="reviews-view__header">Customer Reviews</h3>
                                <div class="reviews-list">
                                    <ol class="reviews-list__content">
                                        <li class="reviews-list__item">
                                            <div class="review">
                                                <div class="review__avatar"><img src="images/avatars/avatar-1.jpg"
                                                                                 alt=""></div>
                                                <div class="review__content">
                                                    <div class="review__author">Samantha Smith</div>
                                                    <div class="review__rating">
                                                        <div class="rating">
                                                            <div class="rating__body">
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star" width="13px"
                                                                     height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review__text">Phasellus id mattis nulla. Mauris
                                                        velit nisi, imperdiet vitae sodales in, maximus ut lectus.
                                                        Vivamus commodo scelerisque lacus, at porttitor dui iaculis
                                                        id. Curabitur imperdiet ultrices fermentum.
                                                    </div>
                                                    <div class="review__date">27 May, 2018</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="reviews-list__item">
                                            <div class="review">
                                                <div class="review__avatar"><img src="images/avatars/avatar-2.jpg"
                                                                                 alt=""></div>
                                                <div class="review__content">
                                                    <div class="review__author">Adam Taylor</div>
                                                    <div class="review__rating">
                                                        <div class="rating">
                                                            <div class="rating__body">
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star" width="13px"
                                                                     height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star" width="13px"
                                                                     height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review__text">Aenean non lorem nisl. Duis tempor
                                                        sollicitudin orci, eget tincidunt ex semper sit amet. Nullam
                                                        neque justo, sodales congue feugiat ac, facilisis a augue.
                                                        Donec tempor sapien et fringilla facilisis. Nam maximus
                                                        consectetur diam. Nulla ut ex mollis, volutpat tellus vitae,
                                                        accumsan ligula.
                                                    </div>
                                                    <div class="review__date">12 April, 2018</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="reviews-list__item">
                                            <div class="review">
                                                <div class="review__avatar"><img src="images/avatars/avatar-3.jpg"
                                                                                 alt=""></div>
                                                <div class="review__content">
                                                    <div class="review__author">Helena Garcia</div>
                                                    <div class="review__rating">
                                                        <div class="rating">
                                                            <div class="rating__body">
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                                <svg class="rating__star rating__star--active"
                                                                     width="13px" height="12px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                    <div class="rating__fill">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                    <div class="rating__stroke">
                                                                        <div class="fake-svg-icon"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review__text">Duis ac lectus scelerisque quam
                                                        blandit egestas. Pellentesque hendrerit eros laoreet
                                                        suscipit ultrices.
                                                    </div>
                                                    <div class="review__date">2 January, 2018</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                    <div class="reviews-list__pagination">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled"><a
                                                    class="page-link page-link--with-arrow" href="#"
                                                    aria-label="Previous">
                                                    <svg class="page-link__arrow page-link__arrow--left"
                                                         aria-hidden="true" width="8px" height="13px">
                                                        <use xlink:href="images/sprite.svg#arrow-rounded-left-8x13"></use>
                                                    </svg>
                                                </a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2 <span
                                                        class="sr-only">(current)</span></a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link page-link--with-arrow"
                                                                     href="#" aria-label="Next">
                                                    <svg class="page-link__arrow page-link__arrow--right"
                                                         aria-hidden="true" width="8px" height="13px">
                                                        <use xlink:href="images/sprite.svg#arrow-rounded-right-8x13"></use>
                                                    </svg>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <form class="reviews-view__form"><h3 class="reviews-view__header">Write A Review</h3>
                                <div class="row">
                                    <div class="col-12 col-lg-9 col-xl-8">
                                        <div class="form-row">
                                            <div class="form-group col-md-4"><label for="review-stars">Review
                                                    Stars</label> <select id="review-stars" class="form-control">
                                                    <option>5 Stars Rating</option>
                                                    <option>4 Stars Rating</option>
                                                    <option>3 Stars Rating</option>
                                                    <option>2 Stars Rating</option>
                                                    <option>1 Stars Rating</option>
                                                </select></div>
                                            <div class="form-group col-md-4"><label for="review-author">Your
                                                    Name</label> <input type="text" class="form-control"
                                                                        id="review-author" placeholder="Your Name">
                                            </div>
                                            <div class="form-group col-md-4"><label for="review-email">Email
                                                    Address</label> <input type="text" class="form-control"
                                                                           id="review-email"
                                                                           placeholder="Email Address"></div>
                                        </div>
                                        <div class="form-group"><label for="review-text">Your Review</label>
                                            <textarea class="form-control" id="review-text" rows="6"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-lg">Post Your Review
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
@endsection

@push('scripts')
    <script type="text/x-template" id="product-view-template">
        <form class="product__options" method="POST" id="product-form" action="{{ route('cart.add', $product->product_id) }}"
              @click="onSubmit($event)">
            <input type="hidden" name="is_buy_now" v-model="is_buy_now">
            <slot></slot>
        </form>
    </script>

    <script type="text/javascript">
        Vue.component('product-view', {
            inject: ['$validator'],
            template: '#product-view-template',
            data: function () {
                return {
                    is_buy_now: 0,
                }
            },

            mounted: function () {
                let currentProductId = '{{ $product->url_key }}';
                let existingViewed = window.localStorage.getItem('recentlyViewed');
                if (!existingViewed) {
                    existingViewed = [];
                } else {
                    existingViewed = JSON.parse(existingViewed);
                }

                if (existingViewed.indexOf(currentProductId) == -1) {
                    existingViewed.push(currentProductId);

                    if (existingViewed.length > 3)
                        existingViewed = existingViewed.slice(Math.max(existingViewed.length - 4, 1));

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(existingViewed));
                } else {
                    var uniqueNames = [];

                    $.each(existingViewed, function (i, el) {
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });

                    uniqueNames.push(currentProductId);

                    uniqueNames.splice(uniqueNames.indexOf(currentProductId), 1);

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(uniqueNames));
                }
            },

            methods: {
                onSubmit: function (e) {
                    if (e.target.getAttribute('type') != 'submit')
                        return;

                    e.preventDefault();

                    var this_this = this;

                    this.$validator.validateAll().then(function (result) {
                        if (result) {
                            this_this.is_buy_now = e.target.classList.contains('buynow') ? 1 : 0;

                            setTimeout(function () {
                                document.getElementById('product-form').submit();
                            }, 0);
                        }
                    });
                }
            }
        });

        $(document).ready(function () {
            var addTOButton = document.getElementsByClassName('add-to-buttons')[0];
            // document.getElementById('loader').style.display="none";
            // addTOButton.style.display="flex";
        });

        window.onload = function () {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {
                for (let i = 0; i < thumbFrame.length; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function () {
                if (thumbList && productHeroImage) {

                    for (let i = 0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };


        let DIRECTION = null;

        function direction() {
            if (DIRECTION === null) {
                DIRECTION = getComputedStyle(document.body).direction;
            }

            return DIRECTION;
        }

        function isRTL() {
            return direction() === 'rtl';
        }
        const initProductGallery = function(element, layout) {
            layout = layout !== undefined ? layout : 'standard';

            const options = {
                dots: false,
                margin: 10,
                rtl: isRTL()
            };
            const layoutOptions = {
                standard: {
                    responsive: {
                        1200: {items: 5},
                        992: {items: 4},
                        768: {items: 3},
                        480: {items: 5},
                        380: {items: 4},
                        0: {items: 3}
                    }
                },
                sidebar: {
                    responsive: {
                        768: {items: 4},
                        480: {items: 5},
                        380: {items: 4},
                        0: {items: 3}
                    }
                },
                columnar: {
                    responsive: {
                        768: {items: 4},
                        480: {items: 5},
                        380: {items: 4},
                        0: {items: 3}
                    }
                },
                quickview: {
                    responsive: {
                        1200: {items: 5},
                        768: {items: 4},
                        480: {items: 5},
                        380: {items: 4},
                        0: {items: 3}
                    }
                }
            };

            const gallery = $(element);

            const image = gallery.find('.product-gallery__featured .owl-carousel');
            const carousel = gallery.find('.product-gallery__carousel .owl-carousel');

            image
                .owlCarousel({items: 1, dots: false, rtl: isRTL()})
                .on('changed.owl.carousel', syncPosition);

            carousel
                .on('initialized.owl.carousel', function () {
                    carousel.find('.product-gallery__carousel-item').eq(0).addClass('product-gallery__carousel-item--active');
                })
                .owlCarousel($.extend({}, options, layoutOptions[layout]));

            carousel.on('click', '.owl-item', function(e){
                e.preventDefault();

                image.data('owl.carousel').to($(this).index(), 300, true);
            });

            gallery.find('.product-gallery__zoom').on('click', function() {
                openPhotoSwipe(image.find('.owl-item.active').index());
            });

            image.on('click', '.owl-item > a', function(event) {
                event.preventDefault();

                openPhotoSwipe($(this).closest('.owl-item').index());
            });

            function getIndexDependOnDir(index) {
                // we need to invert index id direction === 'rtl' because photoswipe do not support rtl
                if (isRTL()) {
                    return image.find('.owl-item img').length - 1 - index;
                }

                return index;
            }

            function openPhotoSwipe(index) {
                const photoSwipeImages = image.find('.owl-item > a').toArray().map(function(element) {
                    return {
                        src: element.href,
                        msrc: element.href,
                        w: 700,
                        h: 700
                    };
                });

                if (isRTL()) {
                    photoSwipeImages.reverse();
                }

                const photoSwipeOptions = {
                    getThumbBoundsFn: function(index) {
                        const imageElements = image.find('.owl-item img').toArray();
                        const dirDependentIndex = getIndexDependOnDir(index);

                        if (!imageElements[dirDependentIndex]) {
                            return null;
                        }

                        const imageElement = imageElements[dirDependentIndex];
                        const pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                        const rect = imageElement.getBoundingClientRect();

                        return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                    },
                    index: getIndexDependOnDir(index),
                    bgOpacity: .9,
                    history: false
                };

                const photoSwipeGallery = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, photoSwipeImages, photoSwipeOptions);

                photoSwipeGallery.listen('beforeChange', function() {
                    image.data('owl.carousel').to(getIndexDependOnDir(photoSwipeGallery.getCurrentIndex()), 0, true);
                });

                photoSwipeGallery.init();
            }

            function syncPosition (el) {
                let current = el.item.index;

                carousel
                    .find('.product-gallery__carousel-item')
                    .removeClass('product-gallery__carousel-item--active')
                    .eq(current)
                    .addClass('product-gallery__carousel-item--active');
                const onscreen = carousel.find('.owl-item.active').length - 1;
                const start = carousel.find('.owl-item.active').first().index();
                const end = carousel.find('.owl-item.active').last().index();

                if (current > end) {
                    carousel.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    carousel.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }
        };

        $(function() {
            $('.product').each(function () {
                const gallery = $(this).find('.product-gallery');

                if (gallery.length > 0) {
                    initProductGallery(gallery[0], $(this).data('layout'));
                }
            });
        });
        $(function() {
            $('.block-products-carousel').each(function() {
                const layout = $(this).data('layout');
                const options = {
                    items: 4,
                    margin: 14,
                    nav: false,
                    dots: false,
                    loop: true,
                    stagePadding: 1,
                    rtl: isRTL()
                };
                const layoutOptions = {
                    'grid-4': {
                        responsive: {
                            1200: {items: 4, margin: 14},
                            992:  {items: 4, margin: 10},
                            768:  {items: 3, margin: 10},
                            576:  {items: 2, margin: 10},
                            475:  {items: 2, margin: 10},
                            0:    {items: 1}
                        }
                    },
                    'grid-4-sm': {
                        responsive: {
                            1200: {items: 4, margin: 14},
                            992:  {items: 3, margin: 10},
                            768:  {items: 3, margin: 10},
                            576:  {items: 2, margin: 10},
                            475:  {items: 2, margin: 10},
                            0:    {items: 1}
                        }
                    },
                    'grid-5': {
                        responsive: {
                            1200: {items: 5, margin: 12},
                            992:  {items: 4, margin: 10},
                            768:  {items: 3, margin: 10},
                            576:  {items: 2, margin: 10},
                            475:  {items: 2, margin: 10},
                            0:    {items: 1}
                        }
                    },
                    'horizontal': {
                        items: 3,
                        responsive: {
                            1200: {items: 3, margin: 14},
                            992:  {items: 3, margin: 10},
                            768:  {items: 2, margin: 10},
                            576:  {items: 1},
                            475:  {items: 1},
                            0:    {items: 1}
                        }
                    },
                };
                const owl = $('.owl-carousel', this);
                let cancelPreviousTabChange = function() {};

                owl.owlCarousel($.extend({}, options, layoutOptions[layout]));

                $(this).find('.block-header__group').on('click', function(event) {
                    const block = $(this).closest('.block-products-carousel');

                    event.preventDefault();

                    if ($(this).is('.block-header__group--active')) {
                        return;
                    }

                    cancelPreviousTabChange();

                    block.addClass('block-products-carousel--loading');
                    $(this).closest('.block-header__groups-list').find('.block-header__group--active').removeClass('block-header__group--active');
                    $(this).addClass('block-header__group--active');

                    // timeout ONLY_FOR_DEMO! you can replace it with an ajax request
                    let timer;
                    timer = setTimeout(function() {
                        let items = block.find('.owl-carousel .owl-item:not(".cloned") .block-products-carousel__column');

                        /*** this is ONLY_FOR_DEMO! / start */
                        /**/ const itemsArray = items.get();
                        /**/ const newItemsArray = [];
                        /**/
                        /**/ while (itemsArray.length > 0) {
                            /**/     const randomIndex = Math.floor(Math.random() * itemsArray.length);
                            /**/     const randomItem = itemsArray.splice(randomIndex, 1)[0];
                            /**/
                            /**/     newItemsArray.push(randomItem);
                            /**/ }
                        /**/ items = $(newItemsArray);
                        /*** this is ONLY_FOR_DEMO! / end */

                        block.find('.owl-carousel')
                            .trigger('replace.owl.carousel', [items])
                            .trigger('refresh.owl.carousel')
                            .trigger('to.owl.carousel', [0, 0]);

                        $('.product-card__quickview', block).on('click', function() {
                            quickview.clickHandler.apply(this, arguments);
                        });

                        block.removeClass('block-products-carousel--loading');
                    }, 1000);
                    cancelPreviousTabChange = function() {
                        // timeout ONLY_FOR_DEMO!
                        clearTimeout(timer);
                        cancelPreviousTabChange = function() {};
                    };
                });

                $(this).find('.block-header__arrow--left').on('click', function() {
                    owl.trigger('prev.owl.carousel', [500]);
                });
                $(this).find('.block-header__arrow--right').on('click', function() {
                    owl.trigger('next.owl.carousel', [500]);
                });
            });
        });
        $(function () {
            $('.product-tabs').each(function (i, element) {
                $('.product-tabs__list', element).on('click', '.product-tabs__item', function (event) {
                    event.preventDefault();

                    const tab = $(this);
                    const content = $('.product-tabs__pane' + $(this).attr('href'), element);

                    if (content.length) {
                        $('.product-tabs__item').removeClass('product-tabs__item--active');
                        tab.addClass('product-tabs__item--active');

                        $('.product-tabs__pane').removeClass('product-tabs__pane--active');
                        content.addClass('product-tabs__pane--active');
                    }
                });

                const currentTab = $('.product-tabs__item--active', element);
                const firstTab = $('.product-tabs__item:first', element);

                if (currentTab.length) {
                    currentTab.trigger('click');
                } else {
                    firstTab.trigger('click');
                }
            });
        });
    </script>
@endpush