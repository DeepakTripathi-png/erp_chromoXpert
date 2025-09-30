@extends('Admin.Layouts.layout')

@section('meta_title')
    Branch Dashboard | Pets Lab Chain
@endsection

@section('css')
<style>
    .card {
        display: block;
        min-width: 0;
        word-wrap: break-word;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(14px);
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-bottom: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .content {
        padding-top: 25px;
    }

    .content-page {
        padding: 0 12px 40px 12px;
    }

    .widget-chart-1 i {
        font-size: 2rem;
        margin-right: 1rem;
        color: #6267ae;
    }

    .chartjs-chart canvas {
        max-height: 300px;
    }

    .revenue-chart-tabs .nav-link {
        padding: 0.5rem 1rem;
        cursor: pointer;
        color: #6267ae;
        border: 1px solid #f6b51d;
        border-radius: 0.25rem;
        margin-right: 0.5rem;
    }

    .revenue-chart-tabs .nav-link.active {
        background: #6267ae;
        color: #fff;
        border: none;
    }

    .header-title {
        color: #6267ae;
    }

    .btn-info {
        background-color: #6267ae;
        border-color: #6267ae;
    }

    .btn-info:hover {
        background-color: #f6b51d;
        border-color: #f6b51d;
        color: #fff;
    }

    .btn-danger {
        background-color: #cc235e;
        border-color: #cc235e;
    }

    .btn-danger:hover {
        background-color: #b01f53;
        border-color: #b01f53;
    }
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid dashboard-cards">
            <!-- Hero Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Branch Dashboard</h4>
                            <p>Welcome, {{ Auth::guard('branch')->user()->branch_name }}!</p>
                            @php
                                $privileges = explode(',', Auth::guard('branch')->user()->role->privileges ?? '');
                            @endphp
                            <div class="mb-3">
                                {{-- @if(in_array('branch_view', $privileges))
                                    <a href="{{ route('branches.index') }}" class="btn btn-info me-2">View Branch Details</a>
                                @endif
                                @if(in_array('appointments_view', $privileges))
                                    <a href="{{ route('appointments.index') }}" class="btn btn-info me-2">View Appointments</a>
                                @endif --}}
                                {{-- <a href="{{ route('branch.logout') }}" class="btn btn-danger">Logout</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Metrics Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Total Appointments</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-calendar-check"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1" style="color: #6267ae;">450</h2>
                                    <p class="mb-1" style="color: #6267ae;">This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Pending Tests</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-test-tube"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1" style="color: #6267ae;">120</h2>
                                    <p class="mb-1" style="color: #6267ae;">Awaiting Results</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Branch Revenue</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-currency-inr"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1" style="color: #6267ae;">1,25,000</h2>
                                    <p class="mb-1" style="color: #6267ae;">This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Pet Owners Served</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1" style="color: #6267ae;">300</h2>
                                    <p class="mb-1" style="color: #6267ae;">Unique Owners</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Graph -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Branch Revenue Overview</h4>
                            <ul class="nav nav-pills revenue-chart-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-type="daily">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-type="monthly">Monthly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-type="yearly">Yearly</a>
                                </li>
                            </ul>
                            <div class="chartjs-chart">
                                <canvas id="revenue-line-chart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointment Status and Test Types -->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Appointment Status</h4>
                            <div class="chartjs-chart">
                                <canvas data-counts='[200, 150, 100]' id="appointment-pie-chart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Test Types</h4>
                            <div class="chartjs-chart">
                                <canvas data-counts='[250, 100, 50]' id="test-types-doughnut-chart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Appointment Status Pie Chart
    var pieCanvas = document.getElementById('appointment-pie-chart').getContext('2d');
    var appointment_counts = JSON.parse($("#appointment-pie-chart").attr('data-counts'));
    var pieData = {
        labels: ['Completed', 'Pending', 'Cancelled'],
        datasets: [{
            data: appointment_counts,
            backgroundColor: ["#6267ae", "#f6b51d", "#cc235e"],
            hoverBackgroundColor: ["#6267ae", "#f6b51d", "#cc235e"],
            hoverBorderColor: "#fff",
        }]
    };
    new Chart(pieCanvas, {
        type: 'pie',
        data: pieData,
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#6267ae'
                    }
                }
            }
        }
    });

    // Test Types Doughnut Chart
    var doughnutCanvas = document.getElementById('test-types-doughnut-chart').getContext('2d');
    var test_types_counts = JSON.parse($("#test-types-doughnut-chart").attr('data-counts'));
    var doughnutData = {
        labels: ['Blood Test', 'Urine Test', 'X-Ray'],
        datasets: [{
            data: test_types_counts,
            backgroundColor: ["#6267ae", "#f6b51d", "#cc235e"],
            hoverBackgroundColor: ["#6267ae", "#f6b51d", "#cc235e"],
            hoverBorderColor: "#fff",
        }]
    };
    new Chart(doughnutCanvas, {
        type: 'doughnut',
        data: doughnutData,
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#6267ae'
                    }
                }
            }
        }
    });

    // Revenue Line Chart
    var revenueCanvas = document.getElementById('revenue-line-chart').getContext('2d');
    var revenueChart = new Chart(revenueCanvas, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Revenue (₹)',
                data: [],
                borderColor: '#6267ae',
                backgroundColor: 'rgba(98, 103, 174, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue (₹)',
                        color: '#6267ae'
                    },
                    ticks: {
                        color: '#6267ae'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Time',
                        color: '#6267ae'
                    },
                    ticks: {
                        color: '#6267ae'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#6267ae'
                    }
                }
            }
        }
    });

    // Revenue Data for Branch
    const revenueData = {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            data: [10000, 15000, 12000, 18000, 20000, 22000, 25000]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: [100000, 120000, 110000, 130000, 140000, 130000, 150000, 140000, 160000, 170000, 180000, 200000]
        },
        yearly: {
            labels: ['2021', '2022', '2023', '2024', '2025'],
            data: [1000000, 1200000, 1400000, 1600000, 1800000]
        }
    };

    // Update Revenue Chart based on tab selection
    function updateRevenueChart(type) {
        const data = revenueData[type];
        revenueChart.data.labels = data.labels;
        revenueChart.data.datasets[0].data = data.data;
        revenueChart.options.scales.x.title.text = type.charAt(0).toUpperCase() + type.slice(1);
        revenueChart.data.datasets[0].label = `Revenue (₹) - {{ Auth::guard('branch')->user()->branch_name }}`;
        revenueChart.update();
    }

    // Tab click handler
    document.querySelectorAll('.revenue-chart-tabs .nav-link').forEach(tab => {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.revenue-chart-tabs .nav-link').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const type = this.getAttribute('data-type');
            updateRevenueChart(type);
        });
    });

    // Trigger daily tab by default
    document.querySelector('.revenue-chart-tabs .nav-link[data-type="daily"]').click();
</script>
@endsection