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
    <title>天堂M | {{ $serverName }}/近30日上電視排行榜</title>
</head>
<body>
<div class="container">
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
</div>
</body>
</html>
