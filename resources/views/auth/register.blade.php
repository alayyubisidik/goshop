
@extends('frontend.layouts.app')

@section('contents')

    <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Register']
        ]" />

    <div class="page-content pt-150 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="row align-items-center">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h2 class="mb-5">Create an Account</h2>
                                        <p class="mb-30">Already have an account? <a href="{{ route("login") }}">Login</a></p>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}" >
                                        @csrf

                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Name"
                                                value="{{ old("name") }}" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email"
                                                value="{{ old("email") }}" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password" autocomplete="off"/>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="off"/>
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <div class="form-group mb-0 " style="margin-top: 20px">
                                            <button type="submit"
                                                class="btn btn-fill-out btn-block hover-up font-weight-bold"
                                                name="login">Submit &amp; Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
