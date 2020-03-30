@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>合卡時刻分佈 - {{ config('app.name') }}</title>
    <meta content="🔥近期 變身造型, 魔法娃娃 合卡時刻分佈 - {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="合卡時刻分佈 - {{ config('app.name') }}">
    <meta property="og:description" content="🔥近期 變身造型, 魔法娃娃 合卡時刻分佈 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
{{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
    <div class="row">
        <h1>合卡時刻分佈</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <h2>金變, 金娃</h2>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <p class="sub-header">
                    {{--                    紫變, 紫娃--}}
                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>時間</th>
                            <th>伺服器</th>
                            <th>名稱</th>
                            <th>種類</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($yellow_result as $item)
                            <tr class="table-warning">
                                <td>{{ $item['date'] }}{{ $item['get_time'] }}</td>
                                <td>{{ $servers[$item['server_id']] }}</td>
                                <td><a
                                        href="/search?serverId={{ $item['server_id'] }}&name={{ $item['role_name'] }}">
                                        {{ $item['role_name'] }}
                                    </a></td>
                                <td>{{ $item['item_name'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card-box -->
        </div>
    </div>
{{--    <div class="row">--}}
{{--        @foreach ($yellow_result as $item)--}}
{{--            <div class="col-12">--}}
{{--                <p class="text-warning">--}}
{{--                    {{ $item['date'] }} {{ $item['get_time'] }} [{{ $servers[$item['server_id']] }}] <a--}}
{{--                        href="/search?serverId={{ $item['server_id'] }}&name={{ $item['role_name'] }}">--}}
{{--                        {{ $item['role_name'] }}--}}
{{--                    </a> {{ $item['item_name'] }}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
    <h3>紫變, 紫娃</h3>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <p class="sub-header">
                    {{--                    紫變, 紫娃--}}
                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>時間</th>
                            <th>機率</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($purple_result as $time => $item)
                            <tr class="table-purple">
                                <td>{{ $time }}</td>
                                <td>{{ $item['percent'] }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card-box -->
        </div>
    </div>
    {{--    <div class="row">--}}
    {{--        @foreach ($purple_result as $time => $item)--}}
    {{--            <div class="col-12">--}}
    {{--                <p style="color:#563d7c !important;">--}}
    {{--                    {{ $time }} => {{ $item['percent'] }}%--}}
    {{--                </p>--}}
    {{--            </div>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
    <h3>紅變, 紅娃</h3>
    {{--    <div class="row">--}}
    {{--        @foreach ($all_result as $time => $item)--}}
    {{--            <div class="col-12">--}}
    {{--                <p>--}}
    {{--                    {{ $time }} => {{ $item['percent'] }}%--}}
    {{--                </p>--}}
    {{--            </div>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <p class="sub-header">
                    {{--                    紫變, 紫娃--}}
                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>時間</th>
                            <th>機率</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($all_result as $time => $item)
                            <tr class="table-danger">
                                <td>{{ $time }}</td>
                                <td>{{ $item['percent'] }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card-box -->
        </div>
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection

