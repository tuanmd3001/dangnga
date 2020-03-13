<template>
    <div>
        <template v-if="Object.keys(this.rawConfig.attributes).length">
            <input
                type="hidden"
                :value="this.selectedProduct"
                id="selected_configurable_option"
                name="selected_configurable_option"/>

            <div class="form-group product__option" v-for="(attribute, index) in this.rawConfig.attributes">
                <div v-if="Object.keys(attribute.options).length">
                    <label class="product__option-label">{{attribute.label}}</label>
                    <div class="input-radio-label">
                        <div class="input-radio-label__list">
                            <label v-for="(option, idx) in attribute.options">
                                <input type="radio"
                                       :value="option.id"
                                       :name="['super_attribute[' + attribute.id + ']']"
                                       v-on:change="onOptionSelect(attribute, option.id)">
                                <span>{{option.label}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="form-group product__option">
            <label class="product__option-label">Quantity</label>
            <div class="product__actions">
                <div class="product__actions-item">
                    <quantity-changer-dn
                        :className="'product__quantity'"
                        :control-name="'quantity'">
                    </quantity-changer-dn>
                </div>
                <div class="product__actions-item product__actions-item--addtocart">
                    <button class="btn btn-primary btn-lg">Add to cart</button>
                </div>
                <div class="product__actions-item product__actions-item--wishlist">
                    <button type="button" class="btn btn-secondary btn-svg-icon btn-lg"
                            data-toggle="tooltip" title="Wishlist">
                        <svg width="16px" height="16px">
                            <use xlink:href="images/sprite.svg#wishlist-16"></use>
                        </svg>
                    </button>
                </div>
                <div class="product__actions-item product__actions-item--compare">
                    <button type="button" class="btn btn-secondary btn-svg-icon btn-lg"
                            data-toggle="tooltip" title="Compare">
                        <svg width="16px" height="16px">
                            <use xlink:href="images/sprite.svg#compare-16"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "product-options-input",
        inject: ['$validator'],
        props: ['configs', 'images', 'product'],
        data: function () {
            return {
                selectedProduct: null,
                selectedOptions: {},
                rawConfig: JSON.parse(this.configs)
            }
        },

        methods: {
            changeProductPrice() {
                if (this.rawConfig.variant_prices && this.selectedProduct && this.rawConfig.variant_prices[this.selectedProduct]) {
                    this.$emit('priceUpdate', this.rawConfig.variant_prices[this.selectedProduct].final_price.formated_price, true)
                } else {
                    this.$emit('priceUpdate', "<span class='product-card__new-price'>Liên hệ</span>", false)
                }
            },
            findProductId() {
                if (this.rawConfig.index !== undefined) {
                    for (let productID in this.rawConfig.index) {
                        let check = true;
                        for (let attrId in this.selectedOptions) {
                            if (!this.rawConfig.index[productID][attrId] ||
                                this.rawConfig.index[productID][attrId] !== this.selectedOptions[attrId]) {
                                check = false;
                                break;
                            }
                        }
                        if (check) return productID
                    }
                }
                return null
            },
            updateProduct() {
                if (Object.keys(this.rawConfig.attributes).length === Object.keys(this.selectedOptions).length) {
                    this.selectedProduct = this.findProductId();
                    if (this.selectedProduct) {
                        this.changeProductPrice();
                    } else {
                        this.changeProductPrice();
                    }
                }
            },
            onOptionSelect(attribute, value) {
                this.selectedOptions[attribute.id] = value;
                this.updateProduct();
            }
        }
    }
</script>

<style scoped>

</style>