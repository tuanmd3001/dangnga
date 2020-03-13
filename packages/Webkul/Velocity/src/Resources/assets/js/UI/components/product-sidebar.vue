<template>
    <div class="product__sidebar" v-if="this.info">
        <ul class="product__meta">
            <product-stock :is-stock="this.info.is_stock" :meta="true"></product-stock>
            <li>SKU: {{ this.info.sku }}</li>
        </ul>
        <product-stock :isStock="info.is_stock" :meta="false"></product-stock>
        <div class="product__prices" v-html="this.info.priceHTML"></div>
        <!-- .product__options -->
        <product-options-form @priceUpdate="onPriceUpdate" :product="this.info" :config="this.config"></product-options-form>
    </div>
</template>

<script>
    export default {
        name: "product-sidebar",
        props: ['product', 'jsonProduct', 'config'],
        data() {
            if (!this.product && this.jsonProduct) return {info: JSON.parse(this.jsonProduct)};
            return {info: this.product}
        },
        methods:{
            onPriceUpdate(price, isStock){
                this.info.priceHTML = price;
                this.info.is_stock = isStock;
            }
        },
    }
</script>

<style scoped>

</style>