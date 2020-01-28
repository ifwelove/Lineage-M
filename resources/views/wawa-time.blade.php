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
    <title>魔法娃娃, 合成時間點</title>
</head>
<body>
<div class="container">
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
</div>
</body>
</html>
