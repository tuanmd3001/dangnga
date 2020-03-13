<template>
    <b-modal id="quickview-modal"
             size="xl"
             hide-header
             hide-footer
             centered
             @hidden="closeQuickView">
        <div class="quickview">
            <button class="quickview__close" type="button"
                    @click="$bvModal.hide('quickview-modal')">
                <svg width="20px" height="20px">
                    <use xlink:href="images/sprite.svg#cross-20"></use>
                </svg>
            </button>
            <div class="product product--layout--quickview" data-layout="quickview">
                <div class="product__content">
                    <!-- .product__gallery -->
                    <product-gallery :galleryImages="product.galleryImages"></product-gallery>
                    <!-- .product__gallery / end -->
                    <!-- .product__info -->
                    <product-info :product="product"></product-info>
                    <!-- .product__info / end -->
                    <!-- .product__sidebar -->
                    <product-sidebar :product="product" :config="product.config"></product-sidebar>
                    <!-- .product__end -->
<!--                    <product-footer :product="product"></product-footer>-->
                </div>
            </div>
        </div>
    </b-modal>
</template>

<script type="text/javascript">
    export default {
        data: function () {
            return {
                currentlyActiveImage: 0,
                showProductDetails: true,
                product: this.$root.productDetails,
            }
        },

        mounted: function () {

            this.$bvModal.show('quickview-modal');
            // console.log(this.quickViewDetails, this.quickView);
        },

        methods: {
            closeQuickView: function () {
                this.$root.quickView = false;
                this.$root.productDetails = [];
                $('body').toggleClass('overflow-hidden');
            },

            changeImage: function (imageIndex) {
                this.currentlyActiveImage = imageIndex;
            },

            getAddToCartHtml: function () {
                const { render, staticRenderFns } = Vue.compile(this.product.addToCartHtml);
                const _staticRenderFns = this.$options.staticRenderFns = staticRenderFns;

                try {
                    var output = render.call(this, this.$createElement)
                } catch (exception) {
                    console.log("something went wrong");
                }

                this.$options.staticRenderFns = _staticRenderFns;

                return output;
            }
        }
    }
</script>