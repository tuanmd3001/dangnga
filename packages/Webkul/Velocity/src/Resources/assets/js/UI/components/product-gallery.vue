<template>
    <div id="product-gallery" class="product__gallery" v-if="images && images.length">
        <div class="product-gallery">
            <div class="product-gallery__featured">
                <button class="product-gallery__zoom">
                    <svg width="24px" height="24px">
                        <use xlink:href="images/sprite.svg#zoom-in-24"></use>
                    </svg>
                </button>
                <owl-carousel-wrapper
                    id="product-image"
                    carousel_type="gallery"
                    ref="product_image_wrapper">
                    <template v-for="(image, index) in images">
                        <a :href="image.large_image_url" target="_blank">
                            <img :src="image.large_image_url" alt="">
                        </a>
                    </template>
                </owl-carousel-wrapper>
            </div>
            <div class="product-gallery__carousel">
                <owl-carousel-wrapper
                    id="product-carousel"
                    carousel_type="gallery"
                    layout="standard"
                    ref="product_carousel_wrapper">
                    <template v-for="(image, index) in images">
                        <a :href="image.large_image_url" class="product-gallery__carousel-item">
                            <img class="product-gallery__carousel-image" :src="image.small_image_url" alt="">
                        </a>
                    </template>
                </owl-carousel-wrapper>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "product-gallery",
        props: [
            'galleryImages',
            'jsonImages'
        ],
        data(){
            if (!this.galleryImages && this.jsonImages) return {images: JSON.parse(this.jsonImages)}
            return {images: this.galleryImages}
        },
        mounted() {
            const that = this;
            const gallery = $('#product-gallery');
            const image = gallery.find('.product-gallery__featured .owl-carousel');
            const carousel = gallery.find('.product-gallery__carousel .owl-carousel');

            this.$refs.product_image_wrapper.$on('changed', syncPosition);

            carousel.find('.product-gallery__carousel-item').eq(0).addClass('product-gallery__carousel-item--active');
            carousel.on('click', '.owl-item', function (e) {
                e.preventDefault();
                image.data('owl.carousel').to($(this).index(), 300, true);
            });

            function syncPosition(el) {
                let current = el.item.index;

                carousel
                    .find('.product-gallery__carousel-item')
                    .removeClass('product-gallery__carousel-item--active')
                    .eq(current)
                    .addClass('product-gallery__carousel-item--active');
                const onscreen = carousel.find('.owl-item.active').length - 1;
                const start = carousel.find('.owl-item.active').first().index();
                const end = carousel.find('.owl-item.active').last().index();

                if (current > end) {
                    carousel.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    carousel.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            gallery.find('.product-gallery__zoom').on('click', function () {
                openPhotoSwipe(image.find('.owl-item.active').index());
            });

            image.on('click', '.owl-item > a', function(event) {
                event.preventDefault();

                openPhotoSwipe($(this).closest('.owl-item').index());
            });

            function getIndexDependOnDir(index) {
                // we need to invert index id direction === 'rtl' because photoswipe do not support rtl
                if (isRTL()) {
                    return image.find('.owl-item img').length - 1 - index;
                }

                return index;
            }

            function openPhotoSwipe(index) {
                const photoSwipeImages = image.find('.owl-item > a').toArray().map(function(element) {
                    return {
                        src: element.href,
                        msrc: element.href,
                        w: 700,
                        h: 700
                    };
                });

                if (isRTL()) {
                    photoSwipeImages.reverse();
                }

                const photoSwipeOptions = {
                    getThumbBoundsFn: function(index) {
                        const imageElements = image.find('.owl-item img').toArray();
                        const dirDependentIndex = getIndexDependOnDir(index);

                        if (!imageElements[dirDependentIndex]) {
                            return null;
                        }

                        const imageElement = imageElements[dirDependentIndex];
                        const pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                        const rect = imageElement.getBoundingClientRect();

                        return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                    },
                    index: getIndexDependOnDir(index),
                    bgOpacity: .9,
                    history: false
                };

                const photoSwipeGallery = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, photoSwipeImages, photoSwipeOptions);

                photoSwipeGallery.listen('beforeChange', function() {
                    image.data('owl.carousel').to(getIndexDependOnDir(photoSwipeGallery.getCurrentIndex()), 0, true);
                });

                photoSwipeGallery.init();
            }
        }
    }
</script>

<style scoped>

</style>