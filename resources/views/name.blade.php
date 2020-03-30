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
    <title>天堂M | {{ $serverName }} {{ $name }}</title>
</head>
<body>
<div class="container">
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
        @foreach ($data as $item)
            @if($item['grade_cd'] == 4)
                <div class="col-12">
                    <p class="text-danger">
                        {{ $item['date'] }} {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 32)
                <div class="col-12">
                    <p class="text-warning">
                        {{ $item['date'] }} {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 5)
                <div class="col-12">
                    <p style="color:#563d7c !important;">
                        {{ $item['date'] }} {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @else
                <div class="col-12">
                    <p>
                        {{ $item['date'] }} {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @endif
        @endforeach
    </div>
</div>
</body>
</html>
