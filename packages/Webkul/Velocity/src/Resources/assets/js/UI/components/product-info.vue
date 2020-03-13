<template>
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
        <h1 class="product__name">{{ this.info.name }}</h1>
        <div class="product__rating">
            <star-ratings :ratings="this.info.avgRating"></star-ratings>
            <div class="product-card__rating-legend">
                {{ __('products.reviews-count', {'totalReviews': this.info.totalReviews}) }}
            </div>
        </div>
        <div class="product__description" v-html="this.info.shortDescription"></div>
        <ul class="product__features">
            <li>Speed: 750 RPM</li>
            <li>Power Source: Cordless-Electric</li>
            <li>Battery Cell Type: Lithium</li>
            <li>Voltage: 20 Volts</li>
            <li>Battery Capacity: 2 Ah</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "product-info",
        props: ['product', 'jsonProduct'],
        data() {
            if (!this.product && this.jsonProduct) return {info: JSON.parse(this.jsonProduct)};
            return {info: this.product}
        },
    }
</script>

<style scoped>

</style>