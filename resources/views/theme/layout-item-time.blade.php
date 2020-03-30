@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>{{ $template_name }} - 出寶時間點 - {{ config('app.name') }}</title>
    <meta content="🔥{{ $template_name }} - 出寶時間點 - {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $template_name }} - 出寶時間點 - {{ config('app.name') }}">
    <meta property="og:description" content="🔥{{ $template_name }} - 出寶時間點 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
    {{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
    <div class="row">
        <h1>{{ $template_name }}, 出寶時間點</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <h2>近期20{{ $unit }} {{ $template_name }}, 出寶時間分佈點</h2>
    <div class="row">
        @foreach ($result20 as $index => $item)
            <div class="col-12">
                @if ($index == 0)
                    <p class="text-warning">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 1)
                    <p style="color:#563d7c !important;">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 2)
                    <p class="text-danger">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @else
                    <p>
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @endif
            </div>
        @endforeach
    </div>
    <h2>近期50{{ $unit }} {{ $template_name }}, 出寶時間分佈點</h2>
    <div class="row">
        @foreach ($result50 as $index50 => $item)
            <div class="col-12">
                @if ($index50 == 0)
                    <p class="text-warning">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @elseif ($index50 == 1)
                    <p style="color:#563d7c !important;">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @elseif ($index50 == 2)
                    <p class="text-danger">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @else
                    <p>
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @endif
            </div>
        @endforeach
    </div>
    <h2>近期{{ $total }}{{ $unit }} {{ $template_name }}, 出寶時間分佈點</h2>
    <div class="row">
        @foreach ($result as $index => $item)
            <div class="col-12">
                @if ($index == 0)
                    <p class="text-warning">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 1)
                    <p style="color:#563d7c !important;">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 2)
                    <p class="text-danger">
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
                    </p>
                @else
                    <p>
                        {{ $item['time'] }} : {{ $item['num'] }}{{ $unit }}, {{ $item['percent'] }}%
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

