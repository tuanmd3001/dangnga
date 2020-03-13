<template>
    <li class="product__meta-availability" v-if="this.meta">{{__('products.availability')}}:
        <span class="text-success" v-if="this.is_stock">{{__('products.in-stock')}}</span>
        <span class="text-danger" v-else>{{__('products.out-of-stock')}}</span>
    </li>
    <div class="product__availability" v-else>{{__('products.availability')}}:
        <span class="text-success" v-if="this.is_stock">{{__('products.in-stock')}}</span>
        <span class="text-danger" v-else>{{__('products.out-of-stock')}}</span>
    </div>
</template>

<script>
    export default {
        name: "product-stock",
        props: ['isStock', 'meta'],
        data(){
            return {is_stock: this.isStock}
        },
        watch: {
            isStock(newValue, oldValue) {
                this.is_stock = newValue;
            }
        }
    }
</script>

<style scoped>

</style>