<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('images/favicon.ico')}}">
    <script>
        window.csrfToken = '<?php echo csrf_token(); ?>'
    </script>
    <script
        type="text/javascript"
        baseUrl="{{ url()->to('/') }}"
        src="{{ asset('themes/velocity/assets/js/velocity.js') }}">
    </script>

    <script
        type="text/javascript"
        src="{{ asset('themes/velocity/assets/js/jquery.ez-plus.js') }}">
    </script>


    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">
    <!-- css -->
    {{--    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/bootstrap/css/bootstrap.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/fonts/font-awesome.min.css')}}">--}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/photoswipe/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/photoswipe/default-skin/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/css/ovic-mobile-menu.css')}}">
    <!-- font - fontawesome -->
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- font - stroyka -->
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/fonts/stroyka/stroyka.css')}}">

    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/css/style.css')}}">


    {{--    <script src="{{asset('themes/dangnga/assets/vendor/jquery/jquery.min.js')}}"></script>--}}
    {{--    <script src="{{asset('themes/dangnga/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}


    @yield('head')

    @section('seo')
        @if (! request()->is('/'))
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @endif
    @show


    @stack('css')

    {!! view_render_event('bagisto.shop.layout.head') !!}

</head>


<body @if (core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">

{!! view_render_event('bagisto.shop.layout.body.before') !!}

@include('shop::UI.particals')
<div id="app" class="site">

    <product-quick-view-dn v-if="$root.quickView"></product-quick-view-dn>
    {{--    <flash-wrapper ref='flashes'></flash-wrapper>--}}

    <div class="site__body">

        {!! view_render_event('bagisto.shop.layout.header.before') !!}

        @include('shop::layouts.header.index')

        {!! view_render_event('bagisto.shop.layout.header.after') !!}

        @yield('slider')


        {!! view_render_event('bagisto.shop.layout.content.before') !!}

        @yield('content-wrapper')

        {!! view_render_event('bagisto.shop.layout.content.after') !!}

        {!! view_render_event('bagisto.shop.layout.full-content.before') !!}

        @yield('full-content-wrapper')

        {!! view_render_event('bagisto.shop.layout.full-content.after') !!}

    </div>

    {!! view_render_event('bagisto.shop.layout.footer.before') !!}

    @include('shop::layouts.footer.footer')

    {!! view_render_event('bagisto.shop.layout.footer.after') !!}

    @if (core()->getConfigData('general.content.footer.footer_toggle'))
        <div class="footer">
            <p style="text-align: center;">
                @if (core()->getConfigData('general.content.footer.footer_content'))
                    {{ core()->getConfigData('general.content.footer.footer_content') }}
                @else
                    {!! trans('admin::app.footer.copy-right') !!}
                @endif
            </p>
        </div>
    @endif
</div>
</body>
<script>
    let DIRECTION = null;

    function direction() {
        if (DIRECTION === null) {
            DIRECTION = getComputedStyle(document.body).direction;
        }

        return DIRECTION;
    }

    function isRTL() {
        return direction() === 'rtl';
    }
</script>

<!-- js -->
@stack('scripts')

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('themes/dangnga/assets/vendor/nouislider/nouislider.min.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/vendor/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/vendor/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/vendor/select2/js/select2.min.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/js/number.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/js/main.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/js/header.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/js/ovic-mobile-menu.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/js/mobilemenu.min.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/vendor/svg4everybody/svg4everybody.min.js')}}"></script>
<script>svg4everybody();</script>


<script type="text/javascript">
    (() => {
        var showAlert = (messageType, messageLabel, message) => {
            if (messageType && message !== '') {
                let html = `<div class="alert ${messageType} alert-dismissible" id="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>${messageLabel} !</strong> ${message}.
                        </div>`;
                toastr.info(message)

                // window.setTimeout(() => {
                //     $(".alert").fadeTo(500, 0).slideUp(500, () => {
                //         $(this).remove();
                //     });
                // }, 5000);
            }
        };

        @if ($message = session('success'))
            toastr.success("{{ $message }}");
        @elseif ($message = session('warning'))
            toastr.warning("{{ $message }}");
        @elseif ($message = session('error'))
            toastr.error("{{ $message }}");
        @elseif ($message = session('info'))
            toastr.info("{{ $message }}");
        @endif

        window.serverErrors = [];
        @if (isset($errors))
            @if (count($errors))
            window.serverErrors = @json($errors->getMessages());
        @endif
            @endif

            window._translations = @json(app('Webkul\Velocity\Helpers\Helper')->jsonTranslations());
    })();
</script>

{!! view_render_event('bagisto.shop.layout.body.after') !!}

</html>