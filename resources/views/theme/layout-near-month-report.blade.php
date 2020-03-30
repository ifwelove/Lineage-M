@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>{{ $serverName }} - 近30日上電視排行榜 - {{ config('app.name') }}</title>
    <meta content="🔥{{ $serverName }} - 近30日上電視排行榜 - {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $serverName }} - 近30日上電視排行榜 - {{ config('app.name') }}">
    <meta property="og:description" content="🔥{{ $serverName }} - 近30日上電視排行榜 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
{{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
    <div class="row">
        <h1>{{ $serverName }}/近30日上電視排行榜</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <div class="row">
        @foreach ($servers as $id => $name)
            <div class="col-4">
                <a href="/near-month-report-{{ $id }}.html">
                    [{{ $name }}]
                </a>
            </div>
        @endforeach
    </div>
    <h2>{{ $serverName }}近30日排行榜前30人名單</h2>
    <div class="row">
        @foreach ($result as $index => $item)
            <div class="col-12">
                @if ($index == 0)
                    <p class="text-warning">
                        <a class="text-warning" href="/search?serverId={{ $serverId }}&name={{ $item['name'] }}">
                            {{ $item['name'] }} : {{ $item['num'] }}
                        </a>
                    </p>
                @elseif ($index == 1)
                    <p style="color:#563d7c !important;">
                        <a style="color:#563d7c !important;" href="/search?serverId={{ $serverId }}&name={{ $item['name'] }}">
                            {{ $item['name'] }} : {{ $item['num'] }}
                        </a>
                    </p>
                @elseif ($index == 2)
                    <p class="text-danger">
                        <a class="text-danger" href="/search?serverId={{ $serverId }}&name={{ $item['name'] }}">
                            {{ $item['name'] }} : {{ $item['num'] }}
                        </a>
                    </p>
                @else
                    <p>
                        <a href="/search?serverId={{ $serverId }}&name={{ $item['name'] }}">
                            {{ $item['name'] }} : {{ $item['num'] }}
                        </a>
                    </p>
                @endif
            </div>
        @endforeach
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
