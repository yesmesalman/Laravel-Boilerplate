@extends('layouts.dashboard')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Welcome !</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Minton</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="knob-chart" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70"
                                        data-fgColor="#1abc9c" data-bgColor="#d1f2eb" value="58"
                                        data-skin="tron" data-angleOffset="0" data-readOnly=true
                                        data-thickness=".15" />
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-1 mt-0"> <span data-plugin="counterup">268</span> </h3>
                                    <p class="text-muted mb-0">New Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="knob-chart" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70"
                                        data-fgColor="#3bafda" data-bgColor="#d8eff8" value="80"
                                        data-skin="tron" data-angleOffset="0" data-readOnly=true
                                        data-thickness=".15" />
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-1 mt-0"> <span data-plugin="counterup">8574</span> </h3>
                                    <p class="text-muted mb-0">Online Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="knob-chart" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70"
                                        data-fgColor="#f672a7" data-bgColor="#fde3ed" value="77"
                                        data-skin="tron" data-angleOffset="0" data-readOnly=true
                                        data-thickness=".15" />
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-1 mt-0"> $<span data-plugin="counterup">958.25</span> </h3>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="knob-chart" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70"
                                        data-fgColor="#6c757d" data-bgColor="#e2e3e5" value="35"
                                        data-skin="tron" data-angleOffset="0" data-readOnly=true
                                        data-thickness=".15" />
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-1 mt-0"> $<span data-plugin="counterup">89.25</span> </h3>
                                    <p class="text-muted mb-1">Daily Average</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>

                            <h4 class="header-title">Revenue Report</h4>

                            <div class="mt-3 text-center">

                                <div class="row pt-2">
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                        <h4> $12,365</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                        <h4><i class="fe-arrow-down text-danger"></i> $365</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                        <h4><i class="fe-arrow-up text-success"></i> $8,501</h4>
                                    </div>
                                </div>

                                <div dir="ltr">
                                    <div id="revenue-report" class="apex-charts"
                                        data-colors="#3bafda,#e3eaef"></div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->

                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>

                            <h4 class="header-title">Products Sales</h4>

                            <div class="mt-3 text-center">

                                <div class="row pt-2">
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                        <h4> $56,214</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                        <h4><i class="fe-arrow-up text-success"></i> $840</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                        <h4><i class="fe-arrow-down text-danger"></i> $7,845</h4>
                                    </div>
                                </div>
                                <div dir="ltr">
                                    <div id="products-sales" class="apex-charts"
                                        data-colors="#3bafda,#1abc9c"></div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title">Marketing Reports</h4>
                            <p class="text-muted mb-0">1 Mar - 31 Mar Showing Data</p>

                            <div dir="ltr">
                                <div id="marketing-reports" class="apex-charts"
                                    data-colors="#3bafda,#1abc9c,#f7b84b"></div>
                            </div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <p class="text-muted mb-1">This Month</p>
                                    <h3 class="mt-0 font-20"><span class="align-middle">$120,254</span> <small
                                            class="badge badge-soft-success font-12">+15%</small></h3>
                                </div>

                                <div class="col-6">
                                    <p class="text-muted mb-1">Last Month</p>
                                    <h3 class="mt-0 font-20"><span class="align-middle">$98,741</span> <small
                                            class="badge badge-soft-danger font-12">-5%</small></h3>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widgets">
                                <a href="javascript:;" data-toggle="reload"><i
                                        class="mdi mdi-refresh"></i></a>
                                <a data-bs-toggle="collapse" href="#cardCollpase4" role="button"
                                    aria-expanded="false" aria-controls="cardCollpase4"><i
                                        class="mdi mdi-minus"></i></a>
                                <a href="javascript:;" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0">Revenue By Location</h4>

                            <div id="cardCollpase4" class="collapse pt-3 show">
                                <div id="world-map-markers" style="height: 433px"></div>
                            </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widgets">
                                <a href="javascript:;" data-toggle="reload"><i
                                        class="mdi mdi-refresh"></i></a>
                                <a data-bs-toggle="collapse" href="#cardCollpase5" role="button"
                                    aria-expanded="false" aria-controls="cardCollpase5"><i
                                        class="mdi mdi-minus"></i></a>
                                <a href="javascript:;" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0">Top Selling Products</h4>

                            <div id="cardCollpase5" class="collapse pt-3 show">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ASOS Ridley High Waist</td>
                                                <td>$79.49</td>
                                                <td>82</td>
                                                <td>$6,518.18</td>
                                            </tr>
                                            <tr>
                                                <td>Marco Lightweight Shirt</td>
                                                <td>$128.50</td>
                                                <td>37</td>
                                                <td>$4,754.50</td>
                                            </tr>
                                            <tr>
                                                <td>Half Sleeve Shirt</td>
                                                <td>$39.99</td>
                                                <td>64</td>
                                                <td>$2,559.36</td>
                                            </tr>
                                            <tr>
                                                <td>Lightweight Jacket</td>
                                                <td>$20.00</td>
                                                <td>184</td>
                                                <td>$3,680.00</td>
                                            </tr>
                                            <tr>
                                                <td>Marco Shoes</td>
                                                <td>$28.49</td>
                                                <td>69</td>
                                                <td>$1,965.81</td>
                                            </tr>
                                            <tr>
                                                <td>ASOS Ridley High Waist</td>
                                                <td>$79.49</td>
                                                <td>82</td>
                                                <td>$6,518.18</td>
                                            </tr>
                                            <tr>
                                                <td>Half Sleeve Shirt</td>
                                                <td>$39.99</td>
                                                <td>64</td>
                                                <td>$2,559.36</td>
                                            </tr>
                                            <tr>
                                                <td>Lightweight Jacket</td>
                                                <td>$20.00</td>
                                                <td>184</td>
                                                <td>$3,680.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table responsive-->
                            </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-3">Revenue History</h4>

                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-centered m-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Marketplaces</th>
                                            <th>Date</th>
                                            <th>US Tax Hold</th>
                                            <th>Payouts</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">Themes Market</h5>
                                            </td>

                                            <td>
                                                Oct 15, 2020
                                            </td>

                                            <td>
                                                $125.23
                                            </td>

                                            <td>
                                                $5848.68
                                            </td>

                                            <td>
                                                <span class="badge badge-soft-warning">Upcoming</span>
                                            </td>

                                            <td>
                                                <a href="javascript: void(0);"
                                                    class="btn btn-xs btn-secondary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">Freelance</h5>
                                            </td>

                                            <td>
                                                Oct 12, 2020
                                            </td>

                                            <td>
                                                $78.03
                                            </td>

                                            <td>
                                                $1247.25
                                            </td>

                                            <td>
                                                <span class="badge badge-soft-success">Paid</span>
                                            </td>

                                            <td>
                                                <a href="javascript: void(0);"
                                                    class="btn btn-xs btn-secondary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">Share Holding</h5>
                                            </td>

                                            <td>
                                                Oct 10, 2020
                                            </td>

                                            <td>
                                                $358.24
                                            </td>

                                            <td>
                                                $815.89
                                            </td>

                                            <td>
                                                <span class="badge badge-soft-success">Paid</span>
                                            </td>

                                            <td>
                                                <a href="javascript: void(0);"
                                                    class="btn btn-xs btn-secondary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">Wrap's Affiliates</h5>
                                            </td>

                                            <td>
                                                Oct 03, 2020
                                            </td>

                                            <td>
                                                $18.78
                                            </td>

                                            <td>
                                                $248.75
                                            </td>

                                            <td>
                                                <span class="badge badge-soft-danger">Overdue</span>
                                            </td>

                                            <td>
                                                <a href="javascript: void(0);"
                                                    class="btn btn-xs btn-secondary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">Marketing Revenue</h5>
                                            </td>

                                            <td>
                                                Sep 21, 2020
                                            </td>

                                            <td>
                                                $185.36
                                            </td>

                                            <td>
                                                $978.21
                                            </td>

                                            <td>
                                                <span class="badge badge-soft-warning">Upcoming</span>
                                            </td>

                                            <td>
                                                <a href="javascript: void(0);"
                                                    class="btn btn-xs btn-secondary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">Advertise Revenue</h5>
                                            </td>

                                            <td>
                                                Sep 15, 2020
                                            </td>

                                            <td>
                                                $29.56
                                            </td>

                                            <td>
                                                $358.10
                                            </td>

                                            <td>
                                                <span class="badge badge-soft-success">Paid</span>
                                            </td>

                                            <td>
                                                <a href="javascript: void(0);"
                                                    class="btn btn-xs btn-secondary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>

                            <h4 class="header-title">Projections Vs Actuals</h4>

                            <div class="mt-3 text-center" dir="ltr">

                                <div id="projections-actuals" class="apex-charts"
                                    data-colors="#3bafda,#1abc9c,#f7b84b,#f672a7"></div>

                                <div class="row mt-3">
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                        <h4>$8712</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                        <h4><i class="fe-arrow-up text-success"></i> $523</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                        <h4><i class="fe-arrow-down text-danger"></i> $965</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; Minton theme by <a href="#">Coderthemes</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-sm-block">
                        <a href="javascript:void(0);">About Us</a>
                        <a href="javascript:void(0);">Help</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>

<script>
    var earning_overview = '<?php echo json_encode($earning_overview) ?>';
    earning_overview = JSON.parse(earning_overview);

    var revenue_sources_labels = '<?php echo json_encode($revenue_sources_labels) ?>';
    revenue_sources_labels = JSON.parse(revenue_sources_labels);

    var revenue_sources_data = '<?php echo json_encode($revenue_sources_data) ?>';
    revenue_sources_data = JSON.parse(revenue_sources_data);
</script>
@endsection
