<template>
    <div :class="'input-number ' +  className">
        <input
            :name="controlName"
            :value="qty"
            v-validate="'required|numeric|min_value:1'"
            :class="'form-control input-number__input' + (className ? ' form-control-lg' : '')">
        <div class="input-number__sub" @click="decreaseQty()"></div>
        <div class="input-number__add" @click="increaseQty()"></div>

        <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
    </div>
</template>

<script>
    export default {
        name: "quantity-changer-dn",
        inject: ['$validator'],

        props: {
            controlName: {
                type: String,
                default: 'quantity'
            },

            quantity: {
                type: [Number, String],
                default: 1
            },
            className: {
                type: [String],
                default: ''
            }

        },

        data: function() {
            return {
                qty: this.quantity
            }
        },

        watch: {
            quantity: function (val) {
                this.qty = val;

                this.$emit('onQtyUpdated', this.qty)
            }
        },

        methods: {
            decreaseQty: function() {
                if (this.qty > 1)
                    this.qty = parseInt(this.qty) - 1;

                this.$emit('onQtyUpdated', this.qty)
            },

            increaseQty: function() {
                this.qty = parseInt(this.qty) + 1;

                this.$emit('onQtyUpdated', this.qty)
            }
        }
    }
</script>

<style scoped>

</style>