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
    <title>合卡時刻分佈</title>
</head>
<body>
<div class="container">
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
        @foreach ($yellow_result as $item)
            <div class="col-12">
                <p class="text-warning">
                    {{ $item['date'] }} {{ $item['get_time'] }} [{{ $servers[$item['server_id']] }}] {{ $item['role_name'] }} {{ $item['item_name'] }}
                </p>
            </div>
        @endforeach
    </div>
    <h3>紫變, 紫娃</h3>
    <div class="row">
        @foreach ($purple_result as $time => $item)
            <div class="col-12">
                <p style="color:#563d7c !important;">
                    {{ $time }} => {{ $item['percent'] }}%
                </p>
            </div>
        @endforeach
    </div>
    <h3>紅變, 紅娃</h3>
    <div class="row">
        @foreach ($all_result as $time => $item)
            <div class="col-12">
                <p>
                    {{ $time }} => {{ $item['percent'] }}%
                </p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
