@php
    $direction = core()->getCurrentLocale()->direction;
@endphp

@if ($velocityMetaData->slider)
    <slider-component direction="{{ $direction }}"></slider-component>
@endif

@push('scripts')
    <script type="text/x-template" id="slider-template">
        <div class="slides-container ltr height-100">
            <owl-carousel-wrapper
                carousel_type="banner"
            >
                @if (! empty($sliderData))
                    @foreach ($sliderData as $index => $slider)

                        @php
                            $textContent = str_replace("\r\n", '', $slider['content']);
                        @endphp
                        <a class="block-slideshow__slide" href="{{ $slider['slider_path'] }}">
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('{{ url()->to('/') . '/storage/' . $slider['path'] }}')"></div>
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('{{ url()->to('/') . '/storage/' . $slider['path'] }}')"></div>
                            <div class="block-slideshow__slide-content" v-html="'{{ $textContent }}'"></div>
                        </a>
                    @endforeach
                @else
                    <a class="block-slideshow__slide" href="#">
                        <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('{{ asset('/images/slides/slide-1.jpg') }}')"></div>
                        <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('{{ asset('/images/slides/slide-1-mobile.jpg') }}')"></div>
                        <div class="block-slideshow__slide-content">
                            <div class="block-slideshow__slide-title">Big choice of<br>Plumbing products</div>
                            <div class="block-slideshow__slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.</div>
                            <div class="block-slideshow__slide-button"><span class="btn btn-primary btn-lg">Shop Now</span></div>
                        </div>
                    </a>
                    <a class="block-slideshow__slide" href="#">
                        <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('{{ asset('/images/slides/slide-2.jpg') }}')"></div>
                        <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('{{ asset('/images/slides/slide-2-mobile.jpg') }}')"></div>
                        <div class="block-slideshow__slide-content">
                            <div class="block-slideshow__slide-title">Screwdrivers<br>Professional Tools</div>
                            <div class="block-slideshow__slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.</div>
                            <div class="block-slideshow__slide-button"><span class="btn btn-primary btn-lg">Shop Now</span></div>
                        </div>
                    </a>
                    <a class="block-slideshow__slide" href="#">
                        <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('{{ asset('/images/slides/slide-3.jpg') }}')"></div>
                        <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('{{ asset('/images/slides/slide-3-mobile.jpg') }}')"></div>
                        <div class="block-slideshow__slide-content">
                            <div class="block-slideshow__slide-title">One more<br>Unique header</div>
                            <div class="block-slideshow__slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.</div>
                            <div class="block-slideshow__slide-button"><span class="btn btn-primary btn-lg">Shop Now</span></div>
                        </div>
                    </a>
                @endif
            </owl-carousel-wrapper>
        </div>
    </script>

    <script type='text/javascript'>
        (() => {
            Vue.component('slider-component', {
                template: '#slider-template',
                props: ['direction'],

                mounted: function () {
                    let banners = this.$el.querySelectorAll('img');
                    banners.forEach(banner => {
                        banner.style.display = 'block';
                    });
                }
            })
        })()
    </script>
@endpush