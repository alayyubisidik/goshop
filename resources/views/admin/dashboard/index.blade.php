@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">

                    <!-- 1. Pending Orders -->
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
                                        <div class="font-weight-medium">{{ $pendingOrders }} Pending Orders</div>
                                        <div class="text-secondary">Waiting confirmation</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Completed Orders -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-success text-white avatar">
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
                                        <div class="font-weight-medium">{{ $completedOrders }} Completed Orders</div>
                                        <div class="text-secondary">Delivered</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Total Orders -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar">
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
                                        <div class="font-weight-medium">{{ $totalOrders }} Total Orders</div>
                                        <div class="text-secondary">All orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Canceled Orders -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
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
                                        <div class="font-weight-medium">{{ $canceledOrders }} Canceled Orders</div>
                                        <div class="text-secondary">Failed orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Total Products -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-secondary text-white avatar">
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
                                        <div class="font-weight-medium">{{ $totalProducts }} Total Products</div>
                                        <div class="text-secondary">In catalog</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Pending Products -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-warning text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalPendingProducts }} Pending Products
                                        </div>
                                        <div class="text-secondary">Waiting approval</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Approved Products -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-success text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalApprovedProducts }} Approved Products
                                        </div>
                                        <div class="text-secondary">Published</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Rejected Products -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalRejectedProducts }} Rejected Products
                                        </div>
                                        <div class="text-secondary">Declined</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 9. Pending KYC -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-warning text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalPendingKycRequests }} Pending KYC
                                        </div>
                                        <div class="text-secondary">Identity check</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10. Approved KYC -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-success text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalApprovedKycRequests }} Approved KYC
                                        </div>
                                        <div class="text-secondary">Verified</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 11. Rejected KYC -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalRejectedKycRequests }} Rejected KYC
                                        </div>
                                        <div class="text-secondary">Not verified</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 12. Total KYC -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-info text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path
                                                    d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalKycRequests }} Total KYC Requests
                                        </div>
                                        <div class="text-secondary">All KYC submissions</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Analytics</h3>

                                <div class="card-actions">
                                    <form action="">
                                        <select name="month" class="form-control" onchange="this.form.submit()">
                                            @foreach ($months as $m)
                                                <option value="{{ $m['value'] }}" @selected($m['value'] == $month)>
                                                    {{ $m['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="ordersChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Sales & Revenue ({{ date('Y') }})</h3>
                            </div>

                            <div class="card-body" style="padding-bottom: 96px">
                                <div id="yearlyDonutChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Pending KYC</h3>
                            </div>
                            <div class="card-body">
                                <div class="divide-y">
                                    @foreach ($pendingKycs as $kyc)
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-1"
                                                        style="background-image: url({{ asset($kyc->user->avatar) }})">
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">{{ $kyc->full_name }}</div>
                                                    <div class="text-secondary">{{ $kyc->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Pending Orders</h3>
                            </div>
                            <div class="card-body">
                                <div class="divide-y">
                                    <div class="divide-y">
                                        @foreach ($recentPendingOrders as $order)
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="text-truncate">
                                                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                                                #{{ $order->id }} - {{ $order->customer_first_name }}
                                                                <span>({{ $order->customer_email }})</span>
                                                            </a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $order->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Pending Products</h3>
                            </div>
                            <div class="card-body">
                                <div class="divide-y">
                                    @foreach ($pendingProducts as $product)
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    @if ($product->product_type == 'physical')
                                                        <a href="{{ route('admin.products.edit', $product->id) }}">
                                                            <div class="text-truncate">{{ $product->name }}</div>
                                                        </a>
                                                    @else
                                                        <a
                                                            href="{{ route('admin.digital-products.edit', $product->id) }}">
                                                            <div class="text-truncate">{{ $product->name }}</div>
                                                        </a>
                                                    @endif
                                                    <div class="text-secondary">
                                                        {{ $product->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var options = {
            chart: {
                type: 'line',
                height: 400
            },
            series: [{
                name: "Orders",
                data: @json($ordersData)
            }, {
                name: "Total Amount",
                data: @json($amountData)
            }, {
                name: "Commission",
                data: @json($commissionData)
            }],
            xaxis: {
                categories: @json($dates)
            },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return val.toFixed(2);
                    }
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 4
            },
            colors: ['#008FFB', '#00E396', '#FEB019'],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(val) {
                        return val.toFixed(2);
                    }
                }
            }
        };

        var donutOptions = {
            chart: {
                type: 'donut',
                width: 400
            },
            series: [{{ $totalSales }}, {{ $totalCommission }}],
            labels: ['Total Sales (Orders)', 'Revenue (Commission)'],
            colors: ['#008FFB', '#00E396'],
            legend: {
                position: 'bottom'
            },
            datalabels: {
                // formatter: function (val, opts) {
                //     let value = opts.w.globals.series[opts.seriesIndex]
                //     return value.toLocaleString()
                // },
            },
            tooltip: {
                y: {
                    formatter: function(val, seriesIndex) {
                        if (seriesIndex == 0) {
                            return "{{ config('settings.site_currency_icon') }}" + val;
                        }
                        return "{{ config('settings.site_currency_icon') }}" + val.toFixed(2);
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#ordersChart"), options);
        chart.render();

        var donutChart = new ApexCharts(document.querySelector("#yearlyDonutChart"), donutOptions);
        donutChart.render();
    </script>
@endpush
