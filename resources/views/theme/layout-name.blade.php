@extends('theme.layout')
@section('css')
@endsection
@section('seo')
<title>{{ $serverName }} - {{ $name }} - {{ config('app.name') }}</title>
<meta content="🔥{{ $serverName }} - {{ $name }} - 打寶次數 [{{ $total }}] - 最近一次打到寶物日期{{ $date }} - {{ config('app.name') }}🔥" name="description" />
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ config('app.name') }}">
<meta property="og:description" content="🔥{{ $serverName }} - {{ $name }} - 打寶次數 [{{ $total }}] - 最近一次打到寶物日期{{ $date }} - {{ config('app.name') }}🔥">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $pageUrl }}">
<meta property="og:locale" content="zh_TW">
@endsection
@section('content')
<div class="row">
    <h1>{{ $serverName }} {{ $name }}</h1>
</div>
<div class="row">
    <div class="col-12">
        <a href="/index.html">
            返回首頁
        </a>
    </div>
</div>
<h2>裝備, 武器, 道具, 技能書, 變身, 娃娃, 歐林</h2>
<div class="row">
    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title">已查詢到的次數</h4>
            <p class="text-muted"></p>
            <h2 class="mb-4"><i class="mdi mdi-monitor text-primary"></i>{{ $total }}</h2>
            <div class="row mb-4">
                <div class="col-6">
                    <p class="text-muted mb-1">本月</p>
                    @if($percentage >= 0)
                        <h3 class="mt-0 font-20">{{ $now_month }}<small class="badge badge-light-success font-13">+{{ $percentage }}%</small></h3>
                    @else
                        <h3 class="mt-0 font-20">{{ $now_month }}<small class="badge badge-light-danger font-13">{{ $percentage }}%</small></h3>
                    @endif
                </div>
                <div class="col-6">
                    <p class="text-muted mb-1">上月</p>
                    <h3 class="mt-0 font-20">{{ $last_month }}</h3>
                </div>
            </div>
            <h5 class="font-16"><i class="mdi mdi-chart-donut text-primary"></i>近半年電視報表</h5>
            <div class="mt-5">
                <span data-plugin="peity-bar" data-colors="#3bafda,#ebeff2" data-width="100%" data-height="86">{{ $report_string }}</span>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card-box p-2">
            <h4 class="header-title mb-3">上電視紀錄</h4>
            <div class="table-responsive">
                <table class="table table-borderless table-hover table-centered m-0">
                    <thead class="thead-light">
                    <tr>
                        <th>道具名稱</th>
                        <th>地點</th>
                        <th>時間</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>
                            @if($item['grade_cd'] == 4)
                            <span class="badge badge-light-danger">{{ $item['item_name'] }}</span>
                            @elseif ($item['grade_cd'] == 32)
                            <span class="badge badge-light-warning">{{ $item['item_name'] }}</span>
                            @elseif ($item['grade_cd'] == 5)
                            <span class="badge badge-light-purple">{{ $item['item_name'] }}</span>
                            @else
                            <span class="badge badge-light-primary">{{ $item['item_name'] }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $item['land_nm'] }}
                        </td>
                        <td>
                            <h5 class="m-0 font-weight-normal">{{ $item['date'] }} {{ $item['get_time'] }}</h5>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div> <!-- end .table-responsive-->
        </div> <!-- end card-box-->
    </div> <!-- end col -->
</div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
