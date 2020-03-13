@php
    $count = $velocityMetaData ? $velocityMetaData->new_product_count : 10;
@endphp

<new-products></new-products>

@push('scripts')
    <script type="text/x-template" id="new-products-template">
        <div data-layout="grid-4" class="block block-products-carousel" v-if="newProducts.length > 0">
            <div class="container">
                <div class="block-header">
                    <h3 class="block-header__title">{{ __('shop::app.home.new-products') }}</h3>
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
                        :id="this.id"
                        carousel_type="products"
                        layout="grid-4"
                        :ref="this.id"
                    >
                        <template v-for="(product, index) in newProducts">
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
            Vue.component('new-products', {
                'template': '#new-products-template',
                data: function () {
                    return {
                        'id': 'new_product_carousel',
                        'list': false,
                        'newProducts': [],
                    }
                },

                mounted: function () {
                    this.getnewProducts();
                },

                methods: {
                    'getnewProducts': function () {
                        this.$http.get(`${this.baseUrl}/category-details?category-slug=new-products&count={{ $count }}`)
                            .then(response => {
                                if (response.data.status)
                                    this.newProducts = response.data.products;
                            })
                            .catch(error => {})
                    },
                    'next': function () {
                        this.$refs[this.id].next();
                    },
                    'prev': function () {
                        this.$refs[this.id].prev();
                    }
                }
            })
        })()
    </script>
@endpush
