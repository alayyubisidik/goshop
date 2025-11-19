<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>

    <link href="{{ asset('assets/backend/dist/css/tabler.css') }}" rel="stylesheet" />

    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
</head>

<body>
    <script src="./dist/js/tabler-theme.min.js?1750026890"></script>

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" aria-label="Tabler" class="navbar-brand navbar-brand-autodark">
                    <img width="130" src="{{ asset('assets/backend/dist/img/logo/logo.png') }}" alt="">
                </a>
            </div>

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('admin.login') }}" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="your@email.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                    <a href="{{ route('admin.password.request') }}">I forgot password</a>
                                </span>
                            </label>

                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="Your password" autocomplete="off">

                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password">
                                        <svg class="icon eye-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>

                                        <svg class="icon eye-off-icon d-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $('.input-group-text a').on('click', function(e) {
            e.preventDefault();

            let input = $(this).closest('.input-group').find('input');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).find('.eye-icon').addClass('d-none');
                $(this).find('.eye-off-icon').removeClass('d-none');
            } else {
                input.attr('type', 'password');
                $(this).find('.eye-icon').removeClass('d-none');
                $(this).find('.eye-off-icon').addClass('d-none');
            }
        });
    </script>
</body>

</html>
