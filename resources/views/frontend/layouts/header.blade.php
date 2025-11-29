@php
    $customPages = \App\Models\CustomPage::where('is_active', true)->get();
@endphp


<header class="header-area header-style-1 header-style-5 header-height-2 d-print-none">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-3 col-xl-4 col-lg-7">
                    <div class="header-info">
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-5 col-lg-4 d-none d-xl-block">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-5">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>Need help? Call Us: <strong class="text-brand"> +0000-000</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="/"><img src="{{ asset('assets/backend/dist/img/logo/logo.png') }}"
                            alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="#">
                            <select class="select-active">
                                <option>All Categories</option>
                                <option>Laptops & Computers</option>
                                <option>Smart Home Devices</option>
                                <option>Wearable Technology</option>
                                <option>Cameras & Drones</option>
                                <option>Men's Clothing</option>
                                <option>Women's Clothing</option>
                                <option>Shoes & Footwear</option>
                                <option>Bags & Accessories</option>
                                <option>Jewelry & Watches</option>
                            </select>
                            <input type="text" placeholder="Search for items..." />
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist.index') }}">
                                    <img class="svgInject" alt="ShopX"
                                        src="{{ asset('assets/frontend/dist/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue">6</span>
                                </a>
                                <a href="{{ route('wishlist.index') }}"><span class="lable">Wishlist</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart.index') }}">
                                    <img alt="ShopX"
                                        src="{{ asset('assets/frontend/dist/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue">2</span>
                                </a>
                                <a href="{{ route('cart.index') }}"><span class="lable">Cart</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="{{ route('login') }}">
                                    <img class="svgInject" alt="ShopX"
                                        src="{{ asset('assets/frontend/dist/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                <a href="{{ route('login') }}"><span class="lable ml-0">Account</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fi fi-rs-user mr-10"></i>My
                                                Account</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fi fi-rs-location-alt mr-10"></i>Order
                                                Tracking</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fi fi-rs-label mr-10"></i>My
                                                Voucher</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fi fi-rs-heart mr-10"></i>My
                                                Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                onclick="event.preventDefault(); document.querySelector('.logout-form').submit();"><i
                                                    class="fi fi-rs-sign-out mr-10"></i>Sign
                                                out</a>
                                        </li>
                                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="index.html"><img src="{{ asset('assets/backend/dist/img/logo/logo.png') }}"
                            alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> Trending Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        {{-- <div
                            class="categories-dropdown-wrap style-2 font-heading categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-1.svg" alt="" />
                                            Men's Clothing
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-2.svg" alt="" />
                                            Women's Clothing
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-3.svg" alt="" />
                                            Jewelry & Fashion
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-4.svg" alt="" />
                                            Sports Apparel
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-5.svg" alt="" />
                                            Skincare
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-6.svg" alt="" />
                                            Exercise & Fitness
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-7.svg" alt="" />
                                            Toys & Games
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-8.svg" alt="" />
                                            Sunglasses
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-9.svg" alt="" />
                                            Denim Collection
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-1.svg" alt="" />
                                            Men's Clothing
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-2.svg" alt="" />
                                            Women's Clothing
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/category-3.svg" alt="" />
                                            Jewelry & Fashion
                                        </a>
                                        <ul>
                                            <li><a href="#">Menu 01</a></li>
                                            <li><a href="#">Menu 02</a></li>
                                            <li><a href="#">Menu 03</a></li>
                                            <li><a href="#">Menu 04</a></li>
                                            <li><a href="#">Menu 05</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="more_categories">
                                view all
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div> --}}
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <li>
                                    <a class="active" href="index.html">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('products.index') }}">Product</a>
                                </li>
                                @foreach ($customPages as $page)
                                    <li class="hot-deals">
                                        <a
                                            href="{{ route('custom-page.index', ['slug' => $page->slug]) }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img src="assets/imgs/theme/icons/icon-headphone-white.svg" alt="hotline" />
                    <p>0000-000<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist.index') }}">
                                <img alt="ShopX" src="assets/imgs/theme/icons/icon-heart.svg" />
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="ShopX" src="assets/imgs/theme/icons/icon-cart.svg" />
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="ShopX"
                                                    src="assets/imgs/shop/thumbnail-3.jpg" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Plain Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="ShopX"
                                                    src="assets/imgs/shop/thumbnail-4.jpg" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Macbook Pro 2025</a></h4>
                                            <h3><span>1 × </span>$3500.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="shop-cart.html">View cart</a>
                                        <a href="shop-checkout.html">Checkout</a>
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
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="assets/imgs/theme/logo.svg" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="/">Home</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2025 © ShopX. All rights reserved. Powered by AliThemes.</div>
        </div>
    </div>
</div>
