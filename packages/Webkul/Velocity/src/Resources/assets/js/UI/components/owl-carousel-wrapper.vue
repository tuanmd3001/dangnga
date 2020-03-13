<template>
    <owl-carousel
        :id="id"
        :class="[
            addClass
        ]"
        :items="items"
        :margin="margin"
        :nav="nav"
        :dots="dots"
        :loop="loop"
        :stagePadding="stagePadding"
        :autoplay="autoplay"
        :autoplayTimeout="autoplayTimeout"
        :autoplayHoverPause="autoplayHoverPause"
        :responsive="responsive"
        :ref="this.refID"
    >
        <slot></slot>
    </owl-carousel>
</template>

<script type="text/javascript">
    const options = {
        banner: {
            items: 1,
            margin: 0,
            nav: false,
            dots: true,
            loop: true,
            stagePadding: 0,
            autoplay: true,
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: null
        },
        products: {
            items: 4,
            margin: 14,
            nav: false,
            dots: false,
            loop: false,
            stagePadding: 1,
            autoplay: false,
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: null
        },
        gallery: {
            items: 1,
            margin: 10,
            nav: false,
            dots: false,
            loop: false,
            stagePadding: 0,
            autoplay: false,
            autoplayTimeout: 10000,
            autoplayHoverPause: false,
            responsive: null
        }
    };
    const layoutOptions = {
        'grid-4': {
            responsive: {
                1200: {items: 4, margin: 14},
                992: {items: 4, margin: 10},
                768: {items: 3, margin: 10},
                576: {items: 2, margin: 10},
                475: {items: 2, margin: 10},
                0: {items: 1}
            }
        },
        'grid-4-sm': {
            responsive: {
                1200: {items: 4, margin: 14},
                992: {items: 3, margin: 10},
                768: {items: 3, margin: 10},
                576: {items: 2, margin: 10},
                475: {items: 2, margin: 10},
                0: {items: 1}
            }
        },
        'grid-5': {
            responsive: {
                1200: {items: 5, margin: 12},
                992: {items: 4, margin: 10},
                768: {items: 3, margin: 10},
                576: {items: 2, margin: 10},
                475: {items: 2, margin: 10},
                0: {items: 1}
            }
        },
        'horizontal': {
            items: 3,
            responsive: {
                1200: {items: 3, margin: 14},
                992: {items: 3, margin: 10},
                768: {items: 2, margin: 10},
                576: {items: 1},
                475: {items: 1},
                0: {items: 1}
            }
        },
        standard: {
            responsive: {
                1200: {items: 5},
                992: {items: 4},
                768: {items: 3},
                480: {items: 5},
                380: {items: 4},
                0: {items: 3}
            }
        },
        sidebar: {
            responsive: {
                768: {items: 4},
                480: {items: 5},
                380: {items: 4},
                0: {items: 3}
            }
        },
        columnar: {
            responsive: {
                768: {items: 4},
                480: {items: 5},
                380: {items: 4},
                0: {items: 3}
            }
        },
        quickview: {
            responsive: {
                1200: {items: 5},
                768: {items: 4},
                480: {items: 5},
                380: {items: 4},
                0: {items: 3}
            }
        }
    };
    import events from './owl-carousel-events';
    export default {
        data() {
            const uid = 'owl-carousel-' + Math.random().toString(36).substring(2, 15);
            if (this.layout) {
                return {...options[this.carousel_type], ...layoutOptions[this.layout], refID: uid}
            } else {
                return {...options[this.carousel_type], refID: uid}
            }
        },
        props: [
            'id',
            'carousel_type',
            'layout',
            'addClass'
        ],
        mounted(){
            events.forEach((eventName) => {
                this.$refs[this.refID].$on(eventName,(event) => {
                    this.$emit(eventName, event);
                })
            });
        },
        methods: {
            next() {
                this.$refs[this.refID].next();
            },
            prev() {
                this.$refs[this.refID].prev();
            },
        },
    }
</script>