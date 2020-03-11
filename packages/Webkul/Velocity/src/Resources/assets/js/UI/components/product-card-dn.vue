<template>
    <div class="col-12 lg-card-container list-card product-card row" v-if="list">
        <div class="product-image">
            <a :title="product.name" :href="`${baseUrl}/${product.slug}`">
                <img :src="product.image" />
            </a>
        </div>

        <div class="product-information">
            <div>
                <div class="product-name">
                    <a :href="`${baseUrl}/${product.slug}`" :title="product.name" class="unset">
                        <span class="fs16">{{ product.name }}</span>
                    </a>
                </div>

                <div class="product-price" v-html="product.priceHTML"></div>

                <div class="product-rating" v-if="product.totalReviews && product.totalReviews > 0">
                    <star-ratings :ratings="product.avgRating"></star-ratings>
                    <span>{{ product.totalReviews }}</span>
                </div>

                <div class="product-rating" v-else>
                    <span class="fs14" v-text="product.firstReviewText"></span>
                </div>

                <div class="cart-wish-wrap row mt5" v-html="product.addToCartHtml"></div>
            </div>
        </div>
    </div>
    <div class="block-products-carousel__column" v-else>
        <div class="block-products-carousel__cell">
            <div class="product-card">
                <button class="product-card__quickview" type="button">
                    <svg width="16px" height="16px">
                        <use xlink:href="images/sprite.svg#quickview-16"></use>
                    </svg>
                    <span class="fake-svg-icon"></span></button>
                <div class="product-card__badges-list">
                    <div class="product-card__badge product-card__badge--new" v-if="product.is_new">New</div>
                    <div class="product-card__badge product-card__badge--sale" v-if="product.is_sale">Sale</div>
                </div>
                <div class="product-card__image">
                    <a :href="`${baseUrl}/${product.slug}`">
                        <img
                            loading="lazy"
                            :alt="product.name"
                            :src="product.image"
                            :data-src="product.image"
                            class="card-img-top lzy_img"/>
                    </a>
                </div>
                <div class="product-card__info">
                    <div class="product-card__name">
                        <a :href="`${baseUrl}/${product.slug}`">{{product.name}}</a></div>
                    <div class="product-card__rating">
                        <star-ratings :ratings="product.avgRating"></star-ratings>
                        <div class="product-card__rating-legend">
                            {{ __('products.reviews-count', {'totalReviews': product.totalReviews}) }}
                        </div>
                    </div>
                    <ul class="product-card__features-list">
                        <li>Speed: 750 RPM</li>
                        <li>Power Source: Cordless-Electric</li>
                        <li>Battery Cell Type: Lithium</li>
                        <li>Voltage: 20 Volts</li>
                        <li>Battery Capacity: 2 Ah</li>
                    </ul>
                </div>
                <div class="product-card__actions">
                    <div class="product-card__availability">
                        Availability:
                        <span class="text-success">In Stock</span></div>
                    <div class="product-card__prices" v-html="product.priceHTML"></div>
<!--                    <div class="product-card__buttons" v-html="product.addToCartHtml"></div>-->
                    <div class="product-card__buttons">
                        <vnode-injector :nodes="getAddToCartHtml()"></vnode-injector>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    // compile add to cart html (it contains wishlist component)
    import Vue from "vue";

    $(document).ready(function () {
        Vue.mixin(require('./trans'));
    });
    export default {
        props: [
            'list',
            'product',
        ],

        data: function () {
            return {
                'addToCart': 0,
                'addToCartHtml': '',
                'message': "Hello there",
                'showTestClass': 'sdfsdf',
            }
        },

        methods: {
            getAddToCartHtml: function () {
                const {render, staticRenderFns} = Vue.compile(this.product.addToCartHtml);
                const _staticRenderFns = this.$options.staticRenderFns = staticRenderFns;
                try {
                    var output = render.call(this, this.$createElement)
                } catch (exception) {
                    debugger
                }

                this.$options.staticRenderFns = _staticRenderFns;

                console.log(output);
                return output
            }
        },
    }
</script>