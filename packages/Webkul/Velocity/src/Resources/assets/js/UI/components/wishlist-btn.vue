<template>
    <button v-if="active"
        class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist"
        type="button">
        <svg width="16px" height="16px">
            <use xlink:href="images/sprite.svg#wishlist-16"></use>
        </svg>
        <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
    </button>
    <button v-else
        class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist wished"
        type="button">
        <svg width="16px" height="16px">
            <use xlink:href="images/sprite.svg#wishlist-16"></use>
        </svg>
        <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
    </button>
</template>

<script type="text/javascript">
    export default {
        props: ['active', 'addClass'],
        data: function () {
            return {
                isActive: this.active
            }
        },
    }
</script>