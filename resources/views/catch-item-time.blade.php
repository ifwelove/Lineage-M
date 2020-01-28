<!doctype html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155746198-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-155746198-1');
    </script>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>魔法書 捕捉, 出寶時間點</title>
</head>
<body>
<div class="container">
    <div class="row">
        <h1>魔法書 捕捉, 出寶時間點</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <h2>近期20本 魔法書 捕捉, 出寶時間分佈點</h2>
    <div class="row">
        @foreach ($result20 as $index => $item)
            <div class="col-12">
                @if ($index == 0)
                    <p class="text-warning">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 1)
                    <p style="color:#563d7c !important;">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 2)
                    <p class="text-danger">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @else
                    <p>
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @endif
            </div>
        @endforeach
    </div>
    <h2>近期50本 魔法書 捕捉, 出寶時間分佈點</h2>
    <div class="row">
        @foreach ($result50 as $index50 => $item)
            <div class="col-12">
                @if ($index50 == 0)
                    <p class="text-warning">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @elseif ($index50 == 1)
                    <p style="color:#563d7c !important;">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @elseif ($index50 == 2)
                    <p class="text-danger">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @else
                    <p>
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @endif
            </div>
        @endforeach
    </div>
    <h2>近期{{ $total }}本 魔法書 捕捉, 出寶時間分佈點</h2>
    <div class="row">
        @foreach ($result as $index => $item)
            <div class="col-12">
                @if ($index == 0)
                    <p class="text-warning">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 1)
                    <p style="color:#563d7c !important;">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @elseif ($index == 2)
                    <p class="text-danger">
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @else
                    <p>
                        {{ $item['time'] }} : {{ $item['num'] }}本, {{ $item['percent'] }}%
                    </p>
                @endif
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
