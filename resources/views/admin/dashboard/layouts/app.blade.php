<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title class="d-print-none">Admin Dashboard </title>

    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.35.0/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/global/upload-preview/upload-preview.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/dist/css/tabler.css') }}" />

    @stack('styles')

    <script src="{{ asset('assets/backend/dist/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            height: 500,
            license_key: 'gpl'
        });

        tinymce.init({
            selector: 'textarea#short-editor',
            height: 300,
            license_key: 'gpl'
        });
    </script>
</head>

<body>
    <script src="{{ asset('assets/backend/dist/js/tabler-theme.min.js') }}"></script>

    <div class="page">
        @include('admin.dashboard.layouts.sidebar')

        <div class="page-wrapper">
            <div class="page">
                <div class="page-wrapper">
                    <div class="page-body" style="min-height: 70vh">
                        @yield('contents')
                    </div>

                    <footer class="footer footer-transparent d-print-none" style="margin-top: 100px">
                        <div class="container-xl">
                            <div class="row text-center align-items-center flex-row-reverse">
                                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                    <ul class="list-inline list-inline-dots mb-0">
                                        <li class="list-inline-item">
                                            Copyright &copy; 2025
                                            <a href="." class="link-secondary">Ayyub</a>. All rights reserved.
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="./changelog.html" class="link-secondary" rel="noopener">v1.0.0</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </footer>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/backend/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/global/upload-preview/upload-preview.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/backend/dist/libs/litepicker/dist/litepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @stack('scripts')

    @include('admin.dashboard.layouts.scripts')
</body>
</html>
