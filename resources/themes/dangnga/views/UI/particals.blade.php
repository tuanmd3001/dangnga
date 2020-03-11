<script type="text/x-template" id="star-ratings-template">
    <div :class="`product-card__rating-stars fs${size ? size : '16'} ${pushClass ? pushClass : ''}`">
        <div class="rating">
            <div class="rating__body">
                <template v-for="(rating, index) in parseInt(showFilled ? showFilled : 3)">
                    <svg width="13px" height="12px" class="rating__star rating__star--active">
                        <g class="rating__fill">
                            <use xlink:href="images/sprite.svg#star-normal"></use>
                        </g>
                        <g class="rating__stroke">
                            <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                        </g>
                    </svg>
                    <div class="rating__star rating__star--only-edge rating__star--active">
                        <div class="rating__fill">
                            <div class="fake-svg-icon"></div>
                        </div>
                        <div class="rating__stroke">
                            <div class="fake-svg-icon"></div>
                        </div>
                    </div>
                </template>
                <template v-if="!hideBlank">
                    <template v-for="(blankStar, index) in (5 - (showFilled ? showFilled : 3))">
                        <svg width="13px" height="12px" class="rating__star">
                            <g class="rating__fill">
                                <use xlink:href="images/sprite.svg#star-normal"></use>
                            </g>
                            <g class="rating__stroke">
                                <use xlink:href="images/sprite.svg#star-normal-stroke"></use>
                            </g>
                        </svg>
                        <div class="rating__star rating__star--only-edge">
                            <div class="rating__fill">
                                <div class="fake-svg-icon"></div>
                            </div>
                            <div class="rating__stroke">
                                <div class="fake-svg-icon"></div>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </div>
</script>

<script type="text/x-template" id="cart-btn-template">
    <button
        type="button"
        id="mini-cart"
        @click="toggleMiniCart"
        :class="`btn btn-link disable-box-shadow ${itemCount == 0 ? 'cursor-not-allowed' : ''}`">

        <div class="mini-cart-content">
            <i class="material-icons-outlined text-down-3">shopping_cart</i>
            <span class="badge" v-text="itemCount" v-if="itemCount != 0"></span>
            <span class="fs18 fw6 cart-text">{{ __('velocity::app.minicart.cart') }}</span>
        </div>
        <div class="down-arrow-container">
            <span class="rango-arrow-down"></span>
        </div>
    </button>
</script>

<script type="text/x-template" id="close-btn-template">
    <button type="button" class="close disable-box-shadow">
        <span class="white-text fs20" @click="togglePopup">×</span>
    </button>
</script>

<script type="text/x-template" id="logo-template">
    <a
        :class="`left ${addClass}`"
        href="{{ route('shop.home.index') }}">

        @if ($logo = core()->getCurrentChannel()->logo_url)
            <img class="logo" src="{{ $logo }}" />
        @else
            <img class="logo" src="{{ asset('themes/velocity/assets/images/logo-text.png') }}" />
        @endif
    </a>
</script>

<script type="text/x-template" id="sidebar-categories-template">
    <div class="wrapper" v-if="rootCategories">
        Hello World
    </div>

    <div class="wrapper" v-else-if="subCategory">
        Hello World 2
    </div>
</script>

<script type="text/javascript">
    (() => {
        Vue.component('star-ratings', {
            props: [
                'ratings',
                'size',
                'hideBlank',
                'pushClass',
                'editable'
            ],

            template: '#star-ratings-template',

            data: function () {
                return {
                    showFilled: this.ratings,
                }
            },

            methods: {
                updateRating: function (index) {
                    index = Math.abs(index);
                    this.editable ? this.showFilled = index : '';
                }
            },
        })

        Vue.component('cart-btn', {
            template: '#cart-btn-template',

            props: ['itemCount'],

            methods: {
                toggleMiniCart: function () {
                    let modal = $('#cart-modal-content')[0];
                    if (modal)
                        modal.classList.toggle('hide');

                    let accountModal = $('.account-modal')[0];
                    if (accountModal)
                        accountModal.classList.add('hide');

                    event.stopPropagation();
                }
            }
        })

        Vue.component('close-btn', {
            template: '#close-btn-template',

            methods: {
                togglePopup: function () {
                    $('#cart-modal-content').hide();
                }
            }
        });

        Vue.component('logo-component', {
            template: '#logo-template',
            props: ['addClass'],
        });
    })()
</script>