<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Stroyka</title>
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">
    <!-- css -->
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/owl-carousel/assets/owl.carousel.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/photoswipe/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/photoswipe/default-skin/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/css/ovic-mobile-menu.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/css/style.css')}}">
    <!-- font - fontawesome -->
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/vendor/fontawesome/css/all.min.css')}}">
    <!-- font - stroyka -->
    <link rel="stylesheet" href="{{asset('themes/dangnga/assets/fonts/stroyka/stroyka.css')}}">

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

<div id="app" class="site">
    <flash-wrapper ref='flashes'></flash-wrapper>

    <div class="site__body">

        {!! view_render_event('bagisto.shop.layout.header.before') !!}

        @include('shop::layouts.header.index')

        {!! view_render_event('bagisto.shop.layout.header.after') !!}

{{--        @yield('slider')--}}


        {!! view_render_event('bagisto.shop.layout.content.before') !!}

        @yield('content-wrapper')

        {!! view_render_event('bagisto.shop.layout.content.after') !!}

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

<script type="text/javascript">
    window.flashMessages = [];

    @if ($success = session('success'))
        window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}"}];
    @elseif ($warning = session('warning'))
        window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}"}];
    @elseif ($error = session('error'))
        window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}"}
    ];
    @elseif ($info = session('info'))
        window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}"}
    ];
    @endif

        window.serverErrors = [];
    @if(isset($errors))
        @if (count($errors))
        window.serverErrors = @json($errors->getMessages());
    @endif
    @endif
</script>

<!-- js -->
<script src="{{asset('themes/dangnga/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('themes/dangnga/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script baseUrl="{{ url()->to('/') }}" src="{{ asset('themes/velocity/assets/js/velocity.js') }}"></script>
<script src="{{asset('themes/dangnga/assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
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

@stack('scripts')

{!! view_render_event('bagisto.shop.layout.body.after') !!}

<div class="modal-overlay"></div>

</body>

</html>