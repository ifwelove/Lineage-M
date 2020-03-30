@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>魔法娃娃, 合成時間點 - {{ config('app.name') }}</title>
    <meta content="🔥魔法娃娃, 合成時間點 - {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="魔法娃娃, 合成時間點 - {{ config('app.name') }}">
    <meta property="og:description" content="🔥魔法娃娃, 合成時間點 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
{{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
    <div class="row">
        <h1>魔法娃娃, 合成時間點</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <h2>魔法娃娃, 合成時間分佈點</h2>
    <div class="row">
        @foreach ($result as $time => $items)
            <div class="col-12">
                <p>{{ $time }}</p>
                @foreach ($items as $wawa => $percent)
                    <span>
                    {{ $wawa }} {{ $percent }}%
                </span>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection

