@php
    $count = $velocityMetaData ? $velocityMetaData->featured_product_count : 10;
@endphp

<featured-products></featured-products>

@push('scripts')
    <script type="text/x-template" id="featured-products-template">
        <div data-layout="grid-4" class="block block-products-carousel" v-if="featuredProducts.length > 0">
            <div class="container">
                <div class="block-header">
                    <h3 class="block-header__title">{{ __('shop::app.home.featured-products') }}</h3>
                    <div class="block-header__divider"></div>
                    <div class="block-header__arrows-list">
                        <button class="block-header__arrow block-header__arrow--left" type="button" @click="prev">
                            <svg width="7px" height="11px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-left-7x11"></use>
                            </svg>
                        </button>
                        <button class="block-header__arrow block-header__arrow--right" type="button" @click="next">
                            <svg width="7px" height="11px">
                                <use xlink:href="images/sprite.svg#arrow-rounded-right-7x11"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="block-products-carousel__slider">
                    <div class="block-products-carousel__preloader"></div>
                    <owl-carousel-wrapper
                        id="feature_product_carousel"
                        carousel_type="products"
                        layout="grid-4"
                        ref="owl_carousel_wrapper"
                    >
                        <template v-for="(product, index) in featuredProducts">
                            <product-card-dn
                                :list="list"
                                :product="product">
                            </product-card-dn>
                        </template>
                    </owl-carousel-wrapper>
                </div>
            </div>
        </div>
    </script>

    <script type="text/javascript">
        (() => {
            Vue.component('featured-products', {
                'template': '#featured-products-template',
                data: function () {
                    return {
                        'list': false,
                        'featuredProducts': [],
                    }
                },

                mounted: function () {
                    this.getFeaturedProducts();
                },

                methods: {
                    'getFeaturedProducts': function () {
                        this.$http.get(`${this.baseUrl}/category-details?category-slug=featured-products&count={{ $count }}`)
                            .then(response => {
                                if (response.data.status)
                                    this.featuredProducts = response.data.products;
                            })
                            .catch(error => {})
                    },
                    'next': function () {
                        this.$refs.owl_carousel_wrapper.next();
                    },
                    'prev': function () {
                        this.$refs.owl_carousel_wrapper.prev();
                    }
                }
            })
        })()
    </script>
@endpush
