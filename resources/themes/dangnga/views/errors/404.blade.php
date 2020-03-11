@extends('shop::layouts.master')

@section('page_title')
    {{ __('admin::app.error.404.page-title') }}
@stop

@section('body-header')
@endsection

@section('full-content-wrapper')
    <div class="block">
        <div class="container">
            <div class="not-found">
                <div class="not-found__404">Oops! Error 404</div>
                <div class="not-found__content"><h1 class="not-found__title">Không tìm thấy trang</h1>
                    <p class="not-found__text">Trang không tồn tại hoặc một số lỗi khác xảy ra.
{{--                        <br>Hãy thử tìm kiếm.--}}
                    </p>
{{--                    <form class="not-found__search">--}}
{{--                        <input type="text" class="not-found__search-input form-control" placeholder="Từ khoá...">--}}
{{--                        <button type="submit" class="not-found__search-button btn btn-primary">Tìm</button>--}}
{{--                    </form>--}}
{{--                    <p class="not-found__text">Hoặc trở về trang chủ.</p>--}}
                    <a class="btn btn-secondary btn-sm" href="{{ route('shop.home.index') }}">Về trang chủ</a></div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
@show
