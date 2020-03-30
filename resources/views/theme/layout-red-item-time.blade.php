@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>全服近七天紅色道具裝備武器 - {{ config('app.name') }}</title>
    <meta content="🔥全服近七天紅色道具裝備武器 - {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="全服近七天紅色道具裝備武器 - {{ config('app.name') }}">
    <meta property="og:description" content="🔥全服近七天紅色道具裝備武器 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
{{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
    <div class="row">
        <h1>全服近七天紅色道具裝備武器</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <div class="row">
        @foreach ($result as $item)
            <div class="col-12">
                <p class="text-danger">
                    {{ $item['date'] }} {{ $item['get_time'] }} [{{ $servers[$item['server_id']] }}] {{ $item['role_name'] }} {{ $item['item_name'] }} {{ $item['land_nm'] }}
                </p>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection

