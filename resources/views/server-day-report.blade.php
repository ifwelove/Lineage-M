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
    <title>{{ $serverName }}/{{ $date }}</title>
</head>
<body>
<div class="container">
    <div class="row">
        <h1>{{ $serverName }}/{{ $date }}</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <div class="row">
        @foreach ($servers as $serverId => $name)
            <div class="col-4">
                <a href="/{{ $date }}-{{ $serverId }}.html">
                    [{{ $name }}]
                </a>
            </div>
        @endforeach
    </div>
    <h2>地點統計</h2>
    <div class="row">
        @foreach ($data5 as $about => $item)
            <div class="col-6">
                {{ $about }} : {{ $item['total'] }}
                @foreach ($item['data'] as $location => $row)
                    <p>
                        {{ $location }} : {{ $row }}
                    </p>
                @endforeach
            </div>
        @endforeach
    </div>
    <h3>裝備, 武器, 道具, 技能書</h3>
    <div class="row">
        @foreach ($data1 as $item)
            @if($item['grade_cd'] == 4)
                <div class="col-12">
                    <p class="text-danger">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 32)
                <div class="col-12">
                    <p class="text-warning">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 5)
                <div class="col-12">
                    <p style="color:#563d7c !important;">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @else
                <div class="col-12">
                    <p>
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @endif
        @endforeach
    </div>
    <h3>裝備, 武器, 道具, 技能書(刻印)</h3>
    <div class="row">
        @foreach ($data2 as $item)
            @if($item['grade_cd'] == 4)
                <div class="col-12">
                    <p class="text-danger">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 32)
                <div class="col-12">
                    <p class="text-warning">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 5)
                <div class="col-12">
                    <p style="color:#563d7c !important;">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @else
                <div class="col-12">
                    <p>
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @endif
        @endforeach
    </div>
    <h3>變身, 娃娃</h3>
    <div class="row">
        @foreach ($data3 as $item)
            @if($item['grade_cd'] == 4)
                <div class="col-12">
                    <p class="text-danger">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 32)
                <div class="col-12">
                    <p class="text-warning">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 5)
                <div class="col-12">
                    <p style="color:#563d7c !important;">
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @else
                <div class="col-12">
                    <p>
                        {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @endif
        @endforeach
    </div>
    <h4>歐林的日記</h4>
    <div class="row">
        @foreach ($data4 as $item)
            <div class="col-12">
                <p>
                    {{ $item['get_time'] }} {{ $item['role_name'] }} {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                </p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
