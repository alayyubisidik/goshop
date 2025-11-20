@extends('vendor.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        @if (user()->kyc?->status == 'pending')
            <div class="alert alert-important alert-warning alert-dismissible" role="alert">
                <div class="alert-icon">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon alert-icon icon-2">
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                        </path>
                        <path d="M12 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="alert-heading">Your KYC is Pending</h4>
                    <div class="alert-description">Please wait for the admin to approve you KYC.</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if (user()->kyc?->status == 'rejected' || user()->kyc?->status == null)
            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                <div class="alert-icon">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/alert-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 8v4"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="alert-heading">Please Submit Your KYC</h4>
                    <div class="alert-description">Please submit your KYC to get started.</div>
                    <a href="{{ route('kyc.index') }}" class="btn btn-primary mt-2">Submit KYC</a>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-warning text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">10 Pending Orders</div>
                                        <div class="text-secondary">Waiting confirmation</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
