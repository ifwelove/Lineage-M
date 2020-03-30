@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>{{ config('app.name') }}</title>
    <meta content="🔥提供打王Boss機器人, 統計出寶時間, 合成時間, 各個伺服器的人物打寶次數, 提供各項數據查詢 - {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="🔥提供打王Boss機器人, 統計出寶時間, 合成時間, 各個伺服器的人物打寶次數, 提供各項數據查詢 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
    {{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
                <h4 class="page-title"></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">免費Line Bot 天堂M 打王助手</h5>
                    <p class="card-text">提供簡易紀錄王的死亡和出生時間</p>
                    <p class="card-text">提供伺服器出寶物查詢個人查詢</p>
                </div>
                <img class="card-img-top img-fluid" src="/assets/images/qrcode/bot1.png" alt="Card image cap">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">相關打王助手指令 <p>重生, 王列表, 出, 重置王表, [時間] [王名稱] ex: 0010 奇岩</p></li>
                    <li class="list-group-item">相關打寶查詢指令 <p>tv list, tv25, tv25 劉德華</p></li>
                </ul>
{{--                <div class="card-body">--}}
{{--                    <a href="#" class="card-link">Card link</a>--}}
{{--                    <a href="#" class="card-link">Another link</a>--}}
{{--                </div>--}}
            </div>

        </div>

        <div class="col-xl-3 col-md-6">
            <div class="widget-bg-color-icon card-box">
                <div class="avatar-lg rounded-circle bg-icon-purple float-left">
                    <i class="mdi mdi-cloud-search-outline font-24 avatar-title text-white"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark mt-1"><span class="counter">{{ $date }}</span></h3>
                    <p class="text-muted mb-0">資料追朔日期</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="widget-bg-color-icon card-box">
                <div class="avatar-lg rounded-circle bg-icon-success float-left">
                    <i class="mdi mdi-format-title font-24 avatar-title text-white"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark mt-1"><span class="counter">{{ $total }}</span></h3>
                    <p class="text-muted mb-0">全服每日資料總數</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="widget-bg-color-icon card-box">
                <div class="avatar-lg rounded-circle bg-icon-primary float-left">
                    <i class="mdi mdi-numeric-8 font-24 avatar-title text-white"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark mt-1"><span class="counter">{{ $total_item }}</span></h3>
                    <p class="text-muted mb-0">全服每日道具裝備(紅紫金)</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="widget-bg-color-icon card-box">
                <div class="avatar-lg rounded-circle bg-icon-danger float-left">
                    <i class="mdi mdi-cards-outline font-24 avatar-title text-white"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark mt-1"><span class="counter">{{ $total_card }}</span></h3>
                    <p class="text-muted mb-0">全服每日變身&娃娃(紅紫金)</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- end row -->

{{--    <div class="row">--}}
{{--        <div class="col-xl-4">--}}
{{--            <div class="card-box">--}}
{{--                <div class="dropdown float-right">--}}
{{--                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                        <i class="mdi mdi-dots-horizontal"></i>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Download</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Upload</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Action</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <h4 class="header-title">Total Revenue</h4>--}}

{{--                <div class="mt-3 text-center">--}}
{{--                    <p class="text-muted font-15 font-family-secondary mb-0">--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Desktop</span>--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Laptop</span>--}}
{{--                    </p>--}}

{{--                    <div id="sparkline1" class="mt-3"></div>--}}

{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>--}}
{{--                            <h4> $56,214</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>--}}
{{--                            <h4><i class="fe-arrow-up text-success"></i> $840</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>--}}
{{--                            <h4><i class="fe-arrow-down text-danger"></i> $7,845</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div> <!-- end card-box -->--}}
{{--        </div> <!-- end col -->--}}

{{--        <div class="col-xl-4">--}}
{{--            <div class="card-box">--}}
{{--                <div class="dropdown float-right">--}}
{{--                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                        <i class="mdi mdi-dots-horizontal"></i>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Download</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Upload</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Action</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <h4 class="header-title">Yearly Sales Report</h4>--}}

{{--                <div class="mt-3 text-center">--}}
{{--                    <p class="text-muted font-15 font-family-secondary mb-0">--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-pink"></i> Revenue</span>--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-light"></i> Number of Sales</span>--}}
{{--                    </p>--}}

{{--                    <div id="sparkline2" class="text-center mt-3"></div>--}}

{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>--}}
{{--                            <h4>$8712</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>--}}
{{--                            <h4><i class="fe-arrow-up text-success"></i> $523</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>--}}
{{--                            <h4><i class="fe-arrow-down text-danger"></i> $965</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div> <!-- end card-box -->--}}
{{--        </div> <!-- end col -->--}}

{{--        <div class="col-xl-4">--}}
{{--            <div class="card-box">--}}
{{--                <div class="dropdown float-right">--}}
{{--                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                        <i class="mdi mdi-dots-horizontal"></i>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Download</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Upload</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Action</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <h4 class="header-title">Weekly Sales Report</h4>--}}

{{--                <div class="mt-3 text-center">--}}
{{--                    <p class="text-muted font-15 font-family-secondary mb-0">--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Direct</span>--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Affilliate</span>--}}
{{--                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Sponsored</span>--}}
{{--                    </p>--}}

{{--                    <div id="sparkline3" class="text-center mt-3"></div>--}}

{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>--}}
{{--                            <h4> $12,365</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>--}}
{{--                            <h4><i class="fe-arrow-down text-danger"></i> $365</h4>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>--}}
{{--                            <h4><i class="fe-arrow-up text-success"></i> $8,501</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div> <!-- end card-box -->--}}
{{--        </div> <!-- end col -->--}}

{{--    </div>--}}
    <!-- end row -->

{{--    <div class="row">--}}

{{--        <div class="col-xl-6">--}}
{{--            <div class="card-box">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-7">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-6 text-center">--}}
{{--                                <h1 class="display-4"><i class="wi wi-day-sleet text-primary"></i></h1>--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="text-muted">--}}
{{--                                    <h2 class="mt-1"><b>32°</b></h2>--}}
{{--                                    <p>Partly cloudy</p>--}}
{{--                                    <p class=" mb-0">15km/h - 37%</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- End row -->--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <h4 class="text-muted mt-0">SAT</h4>--}}
{{--                                <h3 class="my-3"><i class="wi wi-night-alt-cloudy text-primary"></i></h3>--}}
{{--                                <h4 class="text-muted mb-0">30<i class="wi wi-degrees"></i></h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <h4 class="text-muted mt-0">SUN</h4>--}}
{{--                                <h3 class="my-3"><i class="wi wi-day-sprinkle text-primary"></i></h3>--}}
{{--                                <h4 class="text-muted mb-0">28<i class="wi wi-degrees"></i></h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <h4 class="text-muted mt-0">MON</h4>--}}
{{--                                <h3 class="my-3"><i class="wi wi-hot text-primary"></i></h3>--}}
{{--                                <h4 class="text-muted mb-0">33<i class="wi wi-degrees"></i></h4>--}}
{{--                            </div>--}}
{{--                        </div><!-- end row -->--}}
{{--                    </div>--}}
{{--                </div><!-- end row -->--}}
{{--            </div><!-- cardbox -->--}}
{{--            <!-- END Weather WIDGET 1 -->--}}

{{--        </div><!-- End col-xl-6 -->--}}

{{--        <div class="col-xl-6">--}}

{{--            <!-- WEATHER WIDGET 2 -->--}}
{{--            <div class="card-box">--}}

{{--                <div class="row">--}}
{{--                    <div class="col-md-7">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-6 text-center">--}}
{{--                                <h1 class="display-4"><i class="wi wi-night-sprinkle text-success"></i></h1>--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="text-muted">--}}
{{--                                    <h2 class="mt-1"><b>18°</b></h2>--}}
{{--                                    <p>Partly cloudy</p>--}}
{{--                                    <p class=" mb-0">15km/h - 37%</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- End row -->--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <h4 class="text-muted mt-0">SAT</h4>--}}
{{--                                <h3 class="my-3"><i class="wi wi-day-sprinkle text-success"></i></h3>--}}
{{--                                <h4 class="text-muted mb-0">30<i class="wi wi-degrees"></i></h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <h4 class="text-muted mt-0">SUN</h4>--}}
{{--                                <h3 class="my-3"><i class="wi wi-storm-showers text-success"></i></h3>--}}
{{--                                <h4 class="text-muted mb-0">28<i class="wi wi-degrees"></i></h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <h4 class="text-muted mt-0">MON</h4>--}}
{{--                                <h3 class="my-3"><i class="wi wi-night-alt-cloudy text-success"></i></h3>--}}
{{--                                <h4 class="text-muted mb-0">33<i class="wi wi-degrees"></i></h4>--}}
{{--                            </div>--}}
{{--                        </div><!-- end row -->--}}
{{--                    </div>--}}
{{--                </div><!-- end row -->--}}
{{--            </div><!-- card-box -->--}}
{{--            <!-- END WEATHER WIDGET 2 -->--}}

{{--        </div><!-- /.col-xl-6 -->--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-xl-4">--}}
{{--            <div class="card-box">--}}
{{--                <div class="dropdown float-right">--}}
{{--                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                        <i class="mdi mdi-dots-horizontal"></i>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Download</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Upload</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Action</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <h4 class="header-title">Earning Reports</h4>--}}
{{--                <p class="text-muted">1 Mar - 31 Mar Showing Data</p>--}}
{{--                <h2 class="mb-4"><i class="mdi mdi-currency-usd text-primary"></i>25,632.78</h2>--}}

{{--                <div class="row mb-4">--}}
{{--                    <div class="col-6">--}}
{{--                        <p class="text-muted mb-1">This Month</p>--}}
{{--                        <h3 class="mt-0 font-20">$120,254 <small class="badge badge-light-success font-13">+15%</small></h3>--}}
{{--                    </div>--}}

{{--                    <div class="col-6">--}}
{{--                        <p class="text-muted mb-1">Last Month</p>--}}
{{--                        <h3 class="mt-0 font-20">$98,741 <small class="badge badge-light-danger font-13">-5%</small></h3>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <h5 class="font-16"><i class="mdi mdi-chart-donut text-primary"></i> Weekly Earning Report</h5>--}}

{{--                <div class="mt-5">--}}
{{--                    <span data-plugin="peity-bar" data-colors="#3bafda,#ebeff2" data-width="100%" data-height="86">5,3,9,6,5,9,7,3,5,2,9,7,2,1,3,5,2,9,7,2,5,3,9,6,5,9,7</span>--}}
{{--                </div>--}}

{{--            </div> <!-- end card-box -->--}}
{{--        </div> <!-- end col -->--}}
{{--        <div class="col-xl-8">--}}
{{--            <div class="card-box">--}}
{{--                <div class="dropdown float-right">--}}
{{--                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                        <i class="mdi mdi-dots-horizontal"></i>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Download</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Upload</a>--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item">Action</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <h4 class="header-title mb-3">Revenue History</h4>--}}

{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-borderless table-hover table-centered m-0">--}}

{{--                        <thead class="thead-light">--}}
{{--                        <tr>--}}
{{--                            <th>Marketplaces</th>--}}
{{--                            <th>Date</th>--}}
{{--                            <th>US Tax Hold</th>--}}
{{--                            <th>Payouts</th>--}}
{{--                            <th>Status</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <h5 class="m-0 font-weight-normal">Themes Market</h5>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                Oct 15, 2018--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $125.23--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $5848.68--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <span class="badge badge-light-warning">Upcoming</span>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <h5 class="m-0 font-weight-normal">Freelance</h5>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                Oct 12, 2018--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $78.03--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $1247.25--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <span class="badge badge-light-success">Paid</span>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <h5 class="m-0 font-weight-normal">Share Holding</h5>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                Oct 10, 2018--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $358.24--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $815.89--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <span class="badge badge-light-success">Paid</span>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <h5 class="m-0 font-weight-normal">Envato's Affiliates</h5>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                Oct 03, 2018--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $18.78--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $248.75--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <span class="badge badge-light-danger">Overdue</span>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <h5 class="m-0 font-weight-normal">Marketing Revenue</h5>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                Sep 21, 2018--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $185.36--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $978.21--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <span class="badge badge-light-warning">Upcoming</span>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <h5 class="m-0 font-weight-normal">Advertise Revenue</h5>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                Sep 15, 2018--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $29.56--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                $358.10--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <span class="badge badge-light-success">Paid</span>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div> <!-- end .table-responsive-->--}}
{{--            </div> <!-- end card-box-->--}}
{{--        </div> <!-- end col -->--}}
{{--    </div>--}}
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
