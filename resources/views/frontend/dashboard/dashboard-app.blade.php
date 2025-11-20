@extends('frontend.layouts.app')

@section('contents')
    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Dashboard']]" />

    <div class="page-content pt-70 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 d-print-none">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['dashboard.index']) }}"
                                            href="{{ route('dashboard.index') }}">
                                            <i class="fi-rs-settings-sliders mr-10"></i>Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['profile.index']) }}"
                                            href="{{ route('profile.index') }}"><i class="fi-rs-user mr-10"></i>Profile
                                            details</a>
                                    </li>

                                    @if (!user('web')->kyc || user('web')->kyc->status === 'rejected')
                                        <li class="nav-item">
                                            <a class="nav-link {{ setActive(['kyc.index']) }}"
                                                href="{{ route('kyc.index') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                                </svg>
                                                Start Selling?
                                            </a>
                                        </li>
                                    @endif

                                    @if (user('web')->user_type == "vendor")
                                        <li class="nav-item">
                                            <a class="nav-link {{ setActive(['vendor.dashboard.index']) }}"
                                                href="{{ route('vendor.dashboard.index') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                                </svg>
                                                Vendor Dashboard
                                            </a>
                                        </li>
                                    @endif

                                    {{--
                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['orders.*']) }}" href="{{ route("orders.index") }}"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['purchased-products.*']) }}" href="{{ route("purchased-products.index") }}"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Purchaed Products</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['track-order.*']) }}" href="{{ route('track-order.index') }}"><i
                                                class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['reviews.*']) }}" href="{{ route("reviews.index") }}"><i
                                                class="fi-rs-shopping-cart-check mr-10"></i>Reviews</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive(['address.*']) }}" href="{{ route("address.index") }}"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                     --}}
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="event.preventDefault(); $('.form-logout').submit()"
                                            href="#"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                    <form action="{{ route('logout') }}" class="form-logout" method="POST">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                @yield('dashboard_contents')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
