import Vue from 'vue';
import accounting from 'accounting';
import VueCarousel from 'vue-carousel';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/index.css';
import messagesAr from 'vee-validate/dist/locale/ar';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.axios = require("axios");
window.VeeValidate = require("vee-validate");
window.jQuery = window.$ = require("jquery");
window.BootstrapSass = require("bootstrap-sass");

Vue.use(BootstrapVue);
Vue.use(VueToast);
Vue.use(VeeValidate);
Vue.use(VueCarousel);
Vue.use(BootstrapSass);
Vue.prototype.$http = axios;

Vue.use(VeeValidate, {
    dictionary: {
        ar: { messages: messagesAr }
    }
});

Vue.filter('currency', function (value, argument) {
    return accounting.formatMoney(value, argument);
})

window.Vue = Vue;
window.Carousel = VueCarousel;

// UI components
Vue.component("vue-slider", require("vue-slider-component"));
Vue.component('modal-component', require('./UI/components/modal'));
Vue.component("add-to-cart", require("./UI/components/add-to-cart"));
Vue.component('quantity-btn', require('./UI/components/quantity-btn'));
Vue.component('sidebar-component', require('./UI/components/sidebar'));
Vue.component("product-card", require("./UI/components/product-card"));
Vue.component("product-card-dn", require("./UI/components/product-card-dn"));
Vue.component("wishlist-component", require("./UI/components/wishlist"));
Vue.component("wishlist-btn", require("./UI/components/wishlist-btn"));
Vue.component('carousel-component', require('./UI/components/carousel'));
Vue.component('owl-carousel-wrapper', require('./UI/components/owl-carousel-wrapper'));
Vue.component('owl-carousel', require('./UI/components/owl-carousel'));
Vue.component('child-sidebar', require('./UI/components/child-sidebar'));
Vue.component('card-list-header', require('./UI/components/card-header'));
Vue.component('magnify-image', require('./UI/components/image-magnifier'));
Vue.component('responsive-sidebar', require('./UI/components/responsive-sidebar'));
Vue.component('product-quick-view', require('./UI/components/product-quick-view'));
Vue.component('product-gallery', require('./UI/components/product-gallery'));
Vue.component('product-quick-view-dn', require('./UI/components/product-quick-view-dn'));
Vue.component('product-quick-view-btn', require('./UI/components/product-quick-view-btn'));
Vue.component('product-quick-view-btn-dn', require('./UI/components/product-quick-view-btn-dn'));
Vue.component('product-info', require('./UI/components/product-info'));
Vue.component('product-sidebar', require('./UI/components/product-sidebar'));
Vue.component('product-footer', require('./UI/components/product-footer'));
Vue.component('product-stock', require('./UI/components/product-stock'));
Vue.component('product-options-form', require('./UI/components/product-options-form'));
Vue.component('product-options-input', require('./UI/components/product-options-input'));
Vue.component('product-options-input', require('./UI/components/product-options-input'));
Vue.component('product-tabs', require('./UI/components/product-tabs'));
Vue.component('quantity-changer-dn', require('./UI/components/quantity-changer-dn'));

window.eventBus = new Vue();

$(document).ready(function () {
    // define a mixin object
    Vue.mixin(require('./UI/components/trans'));
    Vue.mixin({
        data: function () {
            return {
                'baseUrl': document.querySelector("script[src$='velocity.js']").getAttribute('baseUrl'),
                // 'navContainer': false,
                'responsiveSidebarTemplate': '',
                'responsiveSidebarKey': Math.random(),
                'sharedRootCategories': [],
                'imageObserver': null,
            }
        },

        methods: {
            redirect: function (route) {
                route ? window.location.href = route : '';
            },

            toggleSidebar: function (id, {target}, type) {
                if (
                    Array.from(target.classList)[0] == "main-category"
                    || Array.from(target.parentElement.classList)[0] == "main-category"
                ) {
                    let sidebar = $(`#sidebar-level-${id}`);
                    if (sidebar && sidebar.length > 0) {
                        if (type == "mouseover") {
                            this.show(sidebar);
                        } else if (type == "mouseout") {
                            this.hide(sidebar);
                        }
                    }
                } else if (
                    Array.from(target.classList)[0] == "category"
                    || Array.from(target.classList)[0] == "category-icon"
                    || Array.from(target.classList)[0] == "category-title"
                    || Array.from(target.classList)[0] == "category-content"
                    || Array.from(target.classList)[0] == "rango-arrow-right"
                ) {
                    let parentItem = target.closest('li');
                    if (target.id || parentItem.id.match('category-')) {
                        let subCategories = $(`#${target.id ? target.id : parentItem.id} .sub-categories`);

                        if (subCategories && subCategories.length > 0) {
                            let subCategories1 = Array.from(subCategories)[0];
                            subCategories1 = $(subCategories1);

                            if (type == "mouseover") {
                                this.show(subCategories1);

                                let sidebarChild = subCategories1.find('.sidebar');
                                this.show(sidebarChild);
                            } else if (type == "mouseout") {
                                this.hide(subCategories1);
                            }
                        } else {
                            if (type == "mouseout") {
                                let sidebar = $(`#${id}`);
                                sidebar.hide();
                            }
                        }
                    }
                }
            },

            show: function (element) {
                element.show();
                element.mouseleave(({target}) => {
                    $(target.closest('.sidebar')).hide();
                });
            },

            hide: function (element) {
                element.hide();
            },

            toggleButtonDisability ({event, actionType}) {
                let button = event.target.querySelector('button[type=submit]');

                button ? button.disabled = actionType : '';
            },

            onSubmit: function (event) {
                this.toggleButtonDisability({event, actionType: true});

                if(typeof tinyMCE !== 'undefined')
                    tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        event.target.submit();
                    } else {
                        this.toggleButtonDisability({event, actionType: false});

                        eventBus.$emit('onFormError')
                    }
                });
            },

            isMobile: function () {
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                  return true
                } else {
                  return false
                }
            },
        }
    });

    new Vue({
        el: "#app",
        VueToast,

        data: function () {
            return {
                modalIds: {},
                quickView: false,
                productDetails: [],
            }
        },

        created: function () {
            window.addEventListener('click', () => {
                let modals = document.getElementsByClassName('sensitive-modal');

                Array.from(modals).forEach(modal => {
                    modal.classList.add('hide');
                });
            });
        },

        mounted: function () {
            setTimeout(() => {
                this.addServerErrors();
            }, 0);

            document.body.style.display = "block";
            this.$validator.localize(document.documentElement.lang);

            this.loadCategories();
            this.addIntersectionObserver();
        },

        methods: {
            onSubmit: function (event) {
                this.toggleButtonDisability({event, actionType: true});

                if(typeof tinyMCE !== 'undefined')
                    tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        event.target.submit();
                    } else {
                        this.toggleButtonDisability({event, actionType: false});

                        eventBus.$emit('onFormError')
                    }
                });
            },

            toggleButtonDisable (value) {
                var buttons = document.getElementsByTagName("button");

                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].disabled = value;
                }
            },

            addServerErrors: function (scope = null) {
                for (var key in serverErrors) {
                    var inputNames = [];
                    key.split('.').forEach(function(chunk, index) {
                        if(index) {
                            inputNames.push('[' + chunk + ']')
                        } else {
                            inputNames.push(chunk)
                        }
                    })

                    var inputName = inputNames.join('');

                    const field = this.$validator.fields.find({
                        name: inputName,
                        scope: scope
                    });

                    if (field) {
                        this.$validator.errors.add({
                            id: field.id,
                            field: inputName,
                            msg: serverErrors[key][0],
                            scope: scope
                        });
                    }
                }
            },

            addFlashMessages: function () {
                // const flashes = this.$refs.flashes;

                // flashMessages.forEach(function (flash) {
                //     flashes.addFlash(flash);
                // }, this);

                if (window.flashMessages.alertMessage)
                    window.alert(window.flashMessages.alertMessage);
            },

            showModal: function (id) {
                this.$set(this.modalIds, id, true);
            },

            loadCategories: function () {
                this.$http.get(`${this.baseUrl}/categories`)
                .then(response => {
                    this.sharedRootCategories = response.data.categories;
                })
                .catch(error => {
                    console.log('failed to load categories');
                })
            },

            addIntersectionObserver: function () {
                this.imageObserver = new IntersectionObserver((entries, imgObserver) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const lazyImage = entry.target
                            lazyImage.src = lazyImage.dataset.src
                        }
                    })
                });
            }
        }
    });

    // for compilation of html coming from server
    Vue.component('vnode-injector', {
        functional: true,
        props: ['nodes'],
        render(h, {props}) {
            return props.nodes;
        }
    })
});
