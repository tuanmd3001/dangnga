@if ($cart)
    <script type="text/x-template" id="coupon-component-template">
        <form class="cart__coupon-form" method="post" @submit.prevent="applyCoupon">
            @csrf
            <div class="applied-coupon-details" v-if="applied_coupon">
                <label>{{ __('shop::app.checkout.total.coupon-applied') }}:</label>

                <label class="right" style="display: inline-flex; align-items: center;">
                    <b>@{{ applied_coupon }}</b>

                    <button type="button" class="btn btn-light btn-sm btn-svg-icon" v-on:click="removeCoupon">
                        <svg width="12px" height="12px">
                            <use xlink:href="/images/sprite.svg#cross-12"></use>
                        </svg>
                    </button>
                </label>
            </div>
            <div style="flex-basis: 100%; height: 0;"></div>
            <div class="control-error">@{{ error_message }}</div>
            <div style="flex-basis: 100%; height: 0;"></div>
            <div style="display: flex; width: 100%">
                <label for="input-coupon-code" class="sr-only">Password</label>
                <input type="text" class="form-control" id="input-coupon-code" placeholder="Mã khuyến mại" name="code" v-model="coupon_code">
                <button type="submit" class="btn btn-primary">Áp dụng</button>
            </div>
        </form>
    </script>

    <script>
        Vue.component('coupon-component', {
            template: '#coupon-component-template',

            inject: ['$validator'],

            data: function() {
                return {
                    coupon_code: '',
                    error_message: '',
                    applied_coupon: "{{ $cart->coupon_code }}",
                    route_name: "{{ request()->route()->getName() }}",
                    disable_button: ("{{ $cart->coupon_code }}" == "" ? false : true),
                }
            },

            methods: {
                applyCoupon: function() {
                    if (! this.coupon_code.length)
                        return;

                    this.error_message = null;
                    this.disable_button = true;

                    let code = this.coupon_code;
                    axios.post(
                        '{{ route('shop.checkout.cart.coupon.apply') }}', {code}
                    ).then(response => {
                        if (response.data.success) {
                            this.$emit('onApplyCoupon');
                            this.applied_coupon = this.coupon_code;
                            this.coupon_code = '';

                            window.flashMessages = [{'type': 'alert-success', 'message': response.data.message}];

                            this.$root.addFlashMessages();

                            this.redirectIfCartPage();
                        } else {
                            this.error_message = response.data.message;
                        }

                        this.disable_button = false;
                    }).catch(error => {
                        debugger
                        this.error_message = error.response.data.message;

                        this.disable_button = false;
                    });
                },

                removeCoupon: function () {
                    var self = this;

                    axios.delete('{{ route('shop.checkout.coupon.remove.coupon') }}')
                    .then(function(response) {
                        self.$emit('onRemoveCoupon')

                        self.applied_coupon = '';
                        self.disable_button = false;

                        window.flashMessages = [{'type': 'alert-success', 'message': response.data.message}];

                        self.$root.addFlashMessages();

                        self.redirectIfCartPage();
                    })
                    .catch(function(error) {
                        window.flashMessages = [{'type': 'alert-error', 'message': error.response.data.message}];

                        self.$root.addFlashMessages();
                    });
                },

                redirectIfCartPage: function() {
                    if (this.route_name != 'shop.checkout.cart.index')
                        return;

                    setTimeout(function() {
                        window.location.reload();
                    }, 700);
                }
            }
        });
    </script>
@endif