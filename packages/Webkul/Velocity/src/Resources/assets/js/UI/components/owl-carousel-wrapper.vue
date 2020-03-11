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
        ref="custom_owl_carousel"
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
            autoplayHoverPause: true
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
            autoplayHoverPause: true
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
    };
    export default {
        data() {
            if (this.layout) {
                return {...options[this.carousel_type], ...layoutOptions[this.layout]}
            } else {
                return options[this.carousel_type]
            }
        },
        props: [
            'id',
            'carousel_type',
            'layout',
            'addClass'
        ],
        methods: {
            next() {
                if (owl){
                    that.$refs.custom_owl_carousel.next();
                }
            },
            prev() {
                if (owl){
                    that.$refs.custom_owl_carousel.prev();
                }
            }
        }
    }
</script>