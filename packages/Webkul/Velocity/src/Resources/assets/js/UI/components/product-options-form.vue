<template>
    <form class="product__options" method="POST" id="product-form"
          :action="this.info.formAction"
          @click="onSubmit($event)">
        <input type="hidden" name="_token" :value="this.csrf"/>
        <input type="hidden" name="product_id" :value="this.info.product_id">
        <input type="hidden" name="is_buy_now" v-model="is_buy_now">
        <product-options-input @priceUpdate="onPriceUpdate" :configs="this.config"></product-options-input>
    </form>
</template>

<script>
    export default {
        name: "product-options-form",
        inject: ['$validator'],
        props: ['product', 'jsonProduct', 'config'],
        data: function () {
            let info = this.product;
            if (!this.product && this.jsonProduct) info = JSON.parse(this.jsonProduct);
            return {
                csrf: window.csrfToken,
                is_buy_now: 0,
                info: info
            };
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
            onPriceUpdate(price, isStock) {
                this.$emit('priceUpdate', price, isStock)
            },
            onSubmit: function (e) {
                if (e.target.getAttribute('type') != 'submit')
                    return;

                e.preventDefault();

                var this_this = this;

                this.$validator.validateAll().then(function (result) {
                    if (result) {
                        document.getElementById('product-form').submit();
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>