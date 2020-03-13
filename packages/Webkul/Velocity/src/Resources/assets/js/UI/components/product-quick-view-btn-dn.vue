<template>
    <button class="product-card__quickview" type="button"
            @click="openQuickView({event: $event})">
        <svg width="16px" height="16px">
            <use xlink:href="images/sprite.svg#quickview-16"></use>
        </svg>
        <span class="fake-svg-icon"></span>
    </button>
</template>

<script type="text/javascript">
    export default {
        props: ['quickViewDetails'],

        methods: {
            openQuickView: function ({event}) {
                event.preventDefault();
                event.stopPropagation();

                this.$root.quickView = true;
                this.$root.productDetails = this.quickViewDetails;

                $('body').toggleClass('overflow-hidden');
            }
        }
    }
</script>