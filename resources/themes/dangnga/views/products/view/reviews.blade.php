@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')

@php
    if (! isset($total)) {
        $total = $reviewHelper->getTotalReviews($product);

        $avgRatings = $reviewHelper->getAverageRating($product);
        $avgStarRating = ceil($avgRatings);
    }

    $percentageRatings = $reviewHelper->getPercentageRating($product);
    $countRatings = $customHelper->getCountRating($product);
@endphp

{!! view_render_event('bagisto.shop.products.review.before', ['product' => $product]) !!}

<div class="reviews-view">
    @if ($total)
        <div class="reviews-view__list">
            <div class="reviews-list">
                <ol class="reviews-list__content">
                    @foreach ($reviewHelper->getReviews($product)->paginate(5) as $review)
                        <li class="reviews-list__item">
                            <div class="review">
                                <div class="review__avatar">
                                    <img src="images/avatars/anonymous.png" alt=""></div>
                                <div class="review__content">
                                    <div class="review__author">{{ $review->name ? $review->name . ' - ' : ''}}{{$review->title }} </div>
                                    <div class="review__rating">
                                        <star-ratings
                                            :ratings="{{ $review->rating }}"
                                            push-class="mr10 fs16 col-lg-12"
                                        ></star-ratings>
                                    </div>
                                    <div class="review__text">
                                        {{ $review->comment }}
                                    </div>
                                    <div class="review__date">{{ core()->formatDate($review->created_at, 'd m Y') }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
{{--                <div class="reviews-list__pagination">--}}
{{--                    <ul class="pagination justify-content-center">--}}
{{--                        <li class="page-item disabled">--}}
{{--                            <a class="page-link page-link--with-arrow" href="#"--}}
{{--                                aria-label="Previous">--}}
{{--                                <svg class="page-link__arrow page-link__arrow--left"--}}
{{--                                     aria-hidden="true" width="8px" height="13px">--}}
{{--                                    <use xlink:href="images/sprite.svg#arrow-rounded-left-8x13"></use>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                        <li class="page-item active"><a class="page-link" href="#">2 <span--}}
{{--                                    class="sr-only">(current)</span></a></li>--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="#">3</a></li>--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link page-link--with-arrow" href="#" aria-label="Next">--}}
{{--                                <svg class="page-link__arrow page-link__arrow--right"--}}
{{--                                     aria-hidden="true" width="8px" height="13px">--}}
{{--                                    <use xlink:href="images/sprite.svg#arrow-rounded-right-8x13"></use>--}}
{{--                                </svg>--}}
{{--                            </a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </div>
    @endif
    @if (core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check())
    <form class="reviews-view__form"
          method="POST"
          @submit.prevent="onSubmit"
          action="{{ route('shop.reviews.store', $product->product_id ) }}">
        @csrf
        <h3 class="reviews-view__header">{{ __('shop::app.reviews.write-review') }}</h3>
        <div class="row">
            <div class="col-12 col-lg-9 col-xl-8">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="review-stars">{{ __('admin::app.customers.reviews.rating') }}</label>
                        <select id="review-stars" class="form-control" name="rating">
                            <option value="5">5 Stars Rating</option>
                            <option value="4">4 Stars Rating</option>
                            <option value="3">3 Stars Rating</option>
                            <option value="2">2 Stars Rating</option>
                            <option value="1">1 Stars Rating</option>
                        </select>
                        <span :class="`control-error ${errors.has('rating') ? '' : 'hide'}`" v-if="errors.has('rating')">
                            @{{ errors.first('rating') }}
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="review-title">{{ __('shop::app.reviews.title') }}</label>
                        <input type="text" id="review-title" class="form-control" name="title"
                               v-validate="'required'">
                        <span :class="`control-error ${errors.has('title') ? '' : 'hide'}`">
                            @{{ errors.first('title') }}
                        </span>
                    </div>

                    @if (core()->getConfigData('catalog.products.review.guest_review') && ! auth()->guard('customer')->user())
                        <div class="form-group col-md-4">
                            <label for="review-author">{{ __('shop::app.reviews.name') }}</label>
                            <input type="text" id="review-author" class="form-control" name="name"
                                   v-validate="'required'">
                            <span :class="`control-error ${errors.has('name') ? '' : 'hide'}`">
                                @{{ errors.first('name') }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="review-text">{{ __('admin::app.customers.reviews.comment') }}</label>
                    <textarea class="form-control" id="review-text" rows="6"
                              name="comment"
                              v-validate="'required'"></textarea>
                        <span :class="`control-error ${errors.has('name') ? '' : 'hide'}`">
                            @{{ errors.first('comment') }}
                        </span>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('velocity::app.products.submit-review') }}</button>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

{!! view_render_event('bagisto.shop.products.review.after', ['product' => $product]) !!}