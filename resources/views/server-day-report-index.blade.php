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
    <title>天堂M 掉寶查詢 打寶查詢</title>
</head>
<body>
<div class="container">
    <h1>角色近半年資料查詢</h1>
    <div class="row">
        <form action="/search">
            <div class="form-group">
                <label for="exampleFormControlSelect1">伺服器</label>
                <select name="serverId" class="form-control" id="exampleFormControlSelect1">
                    <option value="0">請選擇伺服器</option>
                    @foreach ($servers as $serverId => $name)
                        <option value="{{ $serverId }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">名稱</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="名稱">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Submit</label>
                <input type="submit" value="Submit" class="form-control" id="exampleFormControlInput2" placeholder="Submit">
            </div>
        </form>
    </div>
    <h1>歐洲統計</h1>
    <div class="row">
        <div class="col-4">
            <a href="/card-time.html">
                合卡時刻分佈
            </a>
        </div>
        <div class="col-4">
            <a href="/purple-item-time.html">
                全服近七日紫色道具裝備武器
            </a>
        </div>
        <div class="col-4">
            <a href="/red-item-time.html">
                全服近七日紅色道具裝備武器
            </a>
        </div>
        <div class="col-4">
            <a href="/near-month-report-1.html">
                各服近30日上電視排行榜
            </a>
        </div>
        @foreach ($items as $item)
            <div class="col-4">
                <a href="/{{ $item['item'] }}.html">
                    {{ $item['slogan'] }}
                </a>
            </div>
        @endforeach
    </div>
    <h1>魔法娃娃時刻分佈</h1>
    <div class="row">
        {{--        @foreach ($wawas as $wawa)--}}
        {{--            <div class="col-4">--}}
        {{--                <a href="/{{ $wawa['item'] }}.html">--}}
        {{--                    {{ $wawa['slogan'] }}--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--        @endforeach--}}
        <div class="col-4">
            <a href="/wawa.html">
                魔法娃娃時刻分佈
            </a>
        </div>
    </div>
    <h3>輔助, 遠端, 模擬器</h3>
    <div class="row">
        <div class="col-4">
            <a href="https://www.ldplayer.tw/">
                雷電模擬器, 推薦版本3.62
            </a>
        </div>
        <div class="col-4">
            <a href="http://www.okaywan.com/">
                ok輔助
            </a>
        </div>
        <div class="col-4">
            <a href="http://www.gamebot.cc/">
                風雲輔助
            </a>
        </div>
        <div class="col-4">
            <a href="https://www.gdlmg.net/">
                助手輔助
            </a>
        </div>
        <div class="col-4">
            <a href="https://lineagem.shop/">
                大尾3
            </a>
        </div>
        <div class="col-4">
            <a href="https://remotedesktop.google.com/access/">
                google遠端
            </a>
        </div>
        <div class="col-4">
            <a href="https://www.teamviewer.com/tw/">
                teamviewer遠端
            </a>
        </div>
        <div class="col-4">
            <a href="https://www.splashtop.com/">
                splashtop遠端（需付費）
            </a>
        </div>
    </div>
    <h2>打寶查詢每日11點更新</h2>
    <div class="row">
        @foreach ($dates as $date)
            <div class="col-4">
                <a href="/{{ $date }}-1.html">
                    {{ $date }}
                </a>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
