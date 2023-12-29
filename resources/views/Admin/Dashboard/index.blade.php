@section('meta_title') Dashboard | Construction Inventory @endsection
@extends('Admin.Layouts.layout')
@section('css')
<style>
    .card {
        display: block;
        min-width: 0;
        word-wrap: break-word;
        background-color: var(--ct-card-bg);
        background-clip: border-box;
        border: 0 solid var(--ct-card-border-color);
        border-radius: 0.25rem;

    }

    .morris-donut-example svg text tspan {
        font-size: 10px !important;
    }

    .content {
        padding-top: 25px;
    }

    .random {
        display: none;
    }
    .content-page {
    padding: 0 12px 40px 12px;
}
</style>
@endsection
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid dashboard-cards">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> No of vendors</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account text-info"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Total Vendors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Sites</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-office-building text-warning"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Total Sites</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Inventory</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-clipboard-list text-purple"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Total Inventory</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Warehouse</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-warehouse text-danger"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Warehouse</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Employee</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account-circle text-secondary"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Employees</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Attendance</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account-check"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Today Attendance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Support Ticket</h4>
                            <div class="chartjs-chart">
                                <canvas data-counts='[10,20,30]' id="support-ticket-pie-chart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Requisition</h4>
                            <div class="chartjs-chart">
                                <canvas data-counts='[2, 5, 3]' id="requisition-doughnut-chart" height="300"></canvas>
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
<script>
    var pieCanvas = document.getElementById('support-ticket-pie-chart').getContext('2d');
    var support_counts = JSON.parse($("#support-ticket-pie-chart").attr('data-counts'));
    var pieData = {
        labels: ['Resolved', 'Pending', 'Closed'],
        datasets: [{
            data: support_counts,
            backgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBackgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBorderColor: "#fff",
        }]
    };
    var myPieChart = new Chart(pieCanvas, {
        type: 'pie',
        data: pieData,
        options: {
            maintainAspectRatio: false,
        }
    });
</script>

<script>
    var doughnutCanvas = document.getElementById('requisition-doughnut-chart').getContext('2d');
    var requisition_counts = JSON.parse($("#requisition-doughnut-chart").attr('data-counts'));
    var doughnutData = {
        labels: ['Completed', 'Pending', 'Rejected'],
        datasets: [{
            data: requisition_counts,
            backgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBackgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBorderColor: "#fff",
        }]
    };
    var myPieChart = new Chart(doughnutCanvas, {
        type: 'doughnut',
        data: doughnutData,
        options: {
            maintainAspectRatio: false,
        }
    });
</script>
@endsection