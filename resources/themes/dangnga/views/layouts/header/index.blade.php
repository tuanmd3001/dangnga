@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')
<?php

$categories = [];

foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) {
    if ($category->slug)
        array_push($categories, $category);
}
$cart = cart()->getCart();
?>
@auth('customer')
    @php
        $wishCount = $wishListHelper->getWishListCount();
    @endphp
@endauth
<!-- mobile site__header -->
<header class="site__header d-lg-none"><!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
    <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
        <div class="mobile-header__panel">
            <div class="container">
                <div class="mobile-header__body">
                    <button class="mobile-header__menu-button menu-toggle">
                        <svg width="18px" height="14px">
                            <use xlink:href="/images/sprite.svg#menu-18x14"></use>
                        </svg>
                    </button>
                    <a class="mobile-header__logo" href="{{ route('shop.home.index') }}">
                        <img width="120px" height="20px" src="/images/logo.svg">
                    </a>
                    <div class="search search--location--mobile-header mobile-header__search">
                        <div class="search__body">
                            <form class="search__form" role="search" action="{{ route('shop.search.index') }}">
                                <input class="search__input" name="term"
                                       placeholder="Tìm kiếm"
                                       aria-label="Site search" type="text"
                                       autocomplete="off">
                                <button class="search__button search__button--type--submit" type="submit">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#search-20"></use>
                                    </svg>
                                </button>
                                <button class="search__button search__button--type--close" type="button">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#cross-20"></use>
                                    </svg>
                                </button>
                                <div class="search__border"></div>
                            </form>
                            <div class="search__suggestions suggestions suggestions--location--mobile-header"></div>
                        </div>
                    </div>
                    <div class="mobile-header__indicators">
                        <div class="indicator indicator--mobile-search indicator--mobile d-md-none">
                            <button class="indicator__button">
                                <span class="indicator__area">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#search-20"></use>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        @auth('customer')
                            <div class="indicator indicator--mobile d-sm-flex">
                                <a href="{{ route('customer.wishlist.index') }}" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#heart-20"></use>
                                        </svg>
                                        <span class="indicator__value">{{$wishCount}}</span>
                                    </span>
                                </a>
                            </div>
                        @endauth
                        <div class="indicator indicator--mobile">
                            <a href="{{ route('shop.checkout.cart.index') }}" class="indicator__button">
                                <span class="indicator__area">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="/images/sprite.svg#cart-20"></use>
                                    </svg>
                                    <span class="indicator__value">@if($cart) {{count($cart->items)}} @else 0 @endif</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- mobile site__header / end -->
<!-- desktop site__header -->
<header class="site__header d-lg-block d-none">
    <div class="site-header">
        <div class="site-header__middle container">
            <div class="site-header__logo">
                <a href="{{ route('shop.home.index') }}">
                    <img width="196px" height="26px" src="/images/logo.svg">
                </a>
            </div>
            <div class="site-header__search">
                <div class="search search--location--header">
                    <div class="search__body">
                        <form class="search__form" role="search" action="{{ route('shop.search.index') }}">
                            <input class="search__input" name="term"
                                   placeholder="Tìm kiếm"
                                   aria-label="Site search" type="text"
                                   autocomplete="off">
                            <button class="search__button search__button--type--submit" type="submit">
                                <svg width="20px" height="20px">
                                    <use xlink:href="/images/sprite.svg#search-20"></use>
                                </svg>
                            </button>
                            <div class="search__border"></div>
                        </form>
                        <div class="search__suggestions suggestions suggestions--location--header"></div>
                    </div>
                </div>
            </div>
            <div class="site-header__phone">
                <div class="site-header__phone-title">Chăm sóc khách hàng</div>
                <div class="site-header__phone-number">(800) 060-0730</div>
            </div>
        </div>
        <div class="site-header__nav-panel"><!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
            <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                <div class="nav-panel__container container">
                    <div class="nav-panel__row">
                        <div class="nav-panel__departments"><!-- .departments -->
                            <div
                                @if(Route::current()->getName() == 'shop.home.index')
                                class="departments departments--open departments--fixed"
                                data-departments-fixed-by=".block-slideshow"
                                @else
                                class="departments"
                                @endif>
                                <div class="departments__body">
                                    <div class="departments__links-wrapper">
                                        <div class="departments__submenus-container"></div>
                                        <ul class="departments__links">
                                            @foreach($categories as $category)
                                                @if($category->parent_id == 1)
                                                    @if(count($category->children))
                                                        <li class="departments__item">
                                                            <a class="departments__item-link" href="#">{{$category->name}}
                                                                <svg class="departments__item-arrow" width="6px" height="9px">
                                                                    <use
                                                                        xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                                </svg>
                                                            </a>
                                                            <div class="departments__submenu departments__submenu--type--megamenu departments__submenu--size--xl">
                                                                <div class="megamenu megamenu--departments">
                                                                    <div class="megamenu__body"
                                                                         style="background-image: url('images/megamenu/megamenu-1.jpg');">
                                                                        <div class="row">
                                                                            @foreach($category->children as $child_idx => $child)
                                                                                @if($child->parent_id == $category->id)
                                                                                    <div class="col-3">
                                                                                        <ul class="megamenu__links megamenu__links--level--0">
                                                                                            <li class="megamenu__item megamenu__item--with-submenu">
                                                                                                <a href="#">{{$child->name}}</a>
                                                                                                <ul class="megamenu__links megamenu__links--level--1">
                                                                                                    @foreach($child->children as $child_2)
                                                                                                        @if ($child_2->parent_id == $child->id)
                                                                                                            <li class="megamenu__item">
                                                                                                                <a href="/{{$child_2->url_path}}">{{$child_2->name}}</a>
                                                                                                            </li>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @else
                                                        <li class="departments__item">
                                                            <a class="departments__item-link" href="/{{$category->url_path}}">{{$category->name}}</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button class="departments__button">
                                    <svg class="departments__button-icon" width="18px" height="14px">
                                        <use xlink:href="/images/sprite.svg#menu-18x14"></use>
                                    </svg>
                                    Danh mục
                                    <svg class="departments__button-arrow" width="9px" height="6px">
                                        <use xlink:href="/images/sprite.svg#arrow-rounded-down-9x6"></use>
                                    </svg>
                                </button>
                            </div><!-- .departments / end --></div><!-- .nav-links -->
                        <div class="nav-panel__nav-links nav-links">
                            <ul class="nav-links__list">
                                <li class="nav-links__item">
                                    <a class="nav-links__item-link" href="{{ route('shop.home.index') }}">
                                        <div class="nav-links__item-body">Trang chủ</div>
                                    </a>
                                </li>
                                <li class="nav-links__item">
                                    <a class="nav-links__item-link" href="{{ route('shop.cms.page', ['slug' => 'contact-us']) }}">
                                        <div class="nav-links__item-body">Giới thiệu</div>
                                    </a>
                                </li>
                                <li class="nav-links__item">
                                    <a class="nav-links__item-link" href="{{ route('shop.cms.page', ['slug' => 'about-us']) }}">
                                        <div class="nav-links__item-body">Liên hệ</div>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- .nav-links / end -->
                        <div class="nav-panel__indicators">
                            @auth('customer')
                                <div class="indicator">
                                    <a href="{{ route('customer.wishlist.index') }}" class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="/images/sprite.svg#heart-20"></use>
                                            </svg>
                                            <span class="indicator__value">{{$wishCount}}</span>
                                        </span>
                                    </a>
                                </div>
                            @endauth
                            @include('shop::checkout.cart.mini-cart', ['cart' => $cart])
                            <div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="/images/sprite.svg#person-20"></use>
                                        </svg>
                                    </span>
                                </a>
                                <div class="indicator__dropdown">
                                    <div class="account-menu">
                                        @guest('customer')
                                            <form class="account-menu__form" method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
                                                {{ csrf_field() }}
                                                <div class="account-menu__form-title">Đăng nhập</div>

                                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                                                <div class="form-group">
                                                    <label for="header-signin-email" class="sr-only">Email</label>
                                                    <input id="header-signin-email" placeholder="Email" type="text" class="form-control form-control-sm" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
                                                </div>

                                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                                                <div class="form-group">
                                                    <label for="header-signin-password" class="sr-only">Mật khẩu</label>
                                                    <div class="account-menu__form-forgot">
                                                        <input class="form-control form-control-sm" type="password" v-validate="'required|min:6'" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;" value=""/>
                                                        <a href="{{ route('customer.forgot-password.create') }}" class="account-menu__form-forgot-link">Quên mật khẩu?</a>
                                                    </div>
                                                </div>
                                                <div class="form-group account-menu__form-button">
                                                    <button type="submit" class="btn btn-primary btn-sm">Đăng nhập</button>
                                                </div>
                                                <div class="account-menu__form-link">
                                                    <a href="{{ route('customer.register.index') }}">Tạo tài khoản</a>
                                                </div>
                                            </form>
                                            <div class="account-menu__divider"></div>
                                        @endguest
                                        @auth('customer')
                                            <a href="{{ route('customer.profile.index') }}" class="account-menu__user">
                                                <div class="account-menu__user-avatar"><img
                                                        src="/images/avatars/avatar-3.jpg" alt=""></div>
                                                <div class="account-menu__user-info">
                                                    <div class="account-menu__user-name">{{ auth()->guard('customer')->user()->last_name }}</div>
                                                    <div class="account-menu__user-email">{{ auth()->guard('customer')->user()->email }}</div>
                                                </div>
                                            </a>
                                            <div class="account-menu__divider"></div>
                                            <ul class="account-menu__links">
                                                <li><a href="{{ route('customer.profile.index') }}">Thông tin cá nhân</a></li>
                                                <li><a href="{{ route('customer.orders.index') }}">Đơn hàng</a></li>
                                                <li><a href="{{ route('customer.address.index') }}">Địa chỉ</a></li>
{{--                                                <li><a href="account-password.html">Mật khẩu</a></li>--}}
                                            </ul>
                                            <div class="account-menu__divider"></div>
                                            <ul class="account-menu__links">
                                                <li><a href="{{ route('customer.session.destroy') }}">Đăng xuất</a></li>
                                            </ul>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- desktop site__header / end -->

<!-- mobilemenu -->
<div class="header-nav container-vertical-wapper">
    <div class="header-nav-inner">
        <div class="box-header-nav">
            <div class=" container-wapper">
                <a href="#" class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a>
                <ul id="menu-main-menu" class="main-menu clone-main-menu ovic-clone-mobile-menu box-has-content">
                    @foreach($categories as $category)
                        @if($category->parent_id == 1)
                            @if(count($category->children))
                                <li class="menu-item menu-item-has-children">
                                    <a href="#" class="kt-item-title ovic-menu-item-title" title="{{$category->name}}">{{$category->name}}</a>
                                    <ul class="sub-menu mega-menu">
                                        @foreach($category->children as $child_idx => $child)
                                            @if($child->parent_id == $category->id)
                                                <li class="col-xs-12 col-sm-12 col-md-12 col-lg-15">
                                                    <a href="#" class="sub-menu--title">
                                                        <span class="number">{{$child_idx + 1}}. </span>
                                                        {{$child->name}}
                                                    </a>
                                                    @if(count($child->children))
                                                        <div class="sub-menu--content clearfix">
                                                        @foreach($child->children as $child_2)
                                                            @if ($child_2->parent_id == $child->id)
                                                                <a href="/{{$child_2->url_path}}">
                                                                    <div class="sub-menu--item">
                                                                        <img src="@if ($child_2->image) {{Storage::url($child_2->image)}} @else '/images/categories/category-1.jpg' @endif" alt="">
                                                                        <span class="sub-menu--item--title">{{$child_2->name}}</span>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                        </div>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="menu-item">
                                    <a href="/{{$category->url_path}}" class="kt-item-title ovic-menu-item-title"
                                       title="{{$category->name}}">{{$category->name}}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- mobilemenu / end -->

<!-- photoswipe -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <!--<button class="pswp__button pswp__button&#45;&#45;share" title="Share"></button>-->
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>