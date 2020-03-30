<!DOCTYPE html>
<html lang="en">
    <head>
        <script data-ad-client="ca-pub-2737190164354255" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155746198-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-155746198-1');
        </script>
        <meta charset="utf-8" />
        @yield('seo')
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <header id="topnav">
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <form action="/search" class="app-search" style="max-width: 240px;">
                                <div class="app-search-box">
                                    <div class="input-group">
                                        <select name="serverId" class="form-control select2">
                                            <option>伺服器</option>
                                            @foreach ($layout_servers as $layout_serverId => $layout_name)
                                                <option value="{{ $layout_serverId }}" style="color: #000000; !important;">{{ $layout_name }}</option>
                                            @endforeach
                                        </select>
                                        <input name="name" type="text" class="form-control" style="border-radius: 0px;" placeholder="角色名稱">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="fe-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <div class="logo-box">
                        <a href="/index.html" class="logo text-center">
                            <span class="logo-lg">
                                <span class="logo-lg-text-light">天堂M</span>
                            </span>
{{--                            <span class="logo-sm">--}}
{{--                                <span class="logo-sm-text-dark">天堂M</span>--}}
{{--                            </span>--}}
                        </a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="#">
                                    <i class="remixicon-dashboard-line"></i>歐洲統計 <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="/card-time.html">合卡時刻分佈</a>
                                    </li>
                                    <li>
                                        <a href="/purple-item-time.html">全服近七日紫色道具裝備武器</a>
                                    </li>
                                    <li>
                                        <a href="/red-item-time.html">全服近七日紅色道具裝備武器</a>
                                    </li>
                                    <li>
                                        <a href="/near-month-report-1.html">各服近30日上電視排行榜</a>
                                    </li>
                                    <li>
                                        <a href="/wawa.html">魔法娃娃時刻分佈</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#">
                                    <i class="remixicon-stack-line"></i>道具裝備技能法書統計 <div class="arrow-down"></div>
                                </a>
                                <ul class="submenu">
                                    @foreach ($layout_items as $item)
                                    <li>
                                        <a href="/{{ $item['item'] }}.html">{{ $item['item'] }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"> <i class="remixicon-layout-line"></i>輔助, 遠端, 模擬器 <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">模擬器<div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="https://www.ldplayer.tw/" target="_blank">雷電模擬器</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">遊戲輔助<div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="http://www.okaywan.com/" target="_blank">ok輔助</a>
                                            </li>
                                            <li>
                                                <a href="http://www.gamebot.cc/" target="_blank">風雲輔助</a>
                                            </li>
                                            <li>
                                                <a href="https://www.gdlmg.net/" target="_blank">助手輔助</a>
                                            </li>
                                            <li>
                                                <a href="https://lineagem.shop/" target="_blank">大尾3</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">遠端<div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="https://remotedesktop.google.com/access/" target="_blank">google遠端</a>
                                            </li>
                                            <li>
                                                <a href="https://www.teamviewer.com/tw/" target="_blank">teamviewer遠端</a>
                                            </li>
                                            <li>
                                                <a href="https://www.splashtop.com/" target="_blank">splashtop遠端（需付費）</a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"> <i class="remixicon-layout-line"></i>打寶查詢每日11點更新<div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">依日期<div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                            @foreach ($layout_dates as $date)
                                                <li>
                                                    <a href="/{{ $date }}-1.html">{{ $date }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
{{--                                    <li class="has-submenu">--}}
{{--                                        <a href="#">依伺服器<div class="arrow-down"></div></a>--}}
{{--                                        <ul class="submenu">--}}
{{--                                            @foreach ($layout_servers as $layout_serverId => $layout_name)--}}
{{--                                                <li>--}}
{{--                                                    <a href="{{ $layout_today }}-{{ $layout_serverId }}.html">{{ $layout_name }}</a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="wrapper">
            <div class="container-fluid py-3">
                @yield('content')
            </div>
        </div>
        <script src="/assets/js/vendor.min.js"></script>
        <script src="/assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="/assets/libs/peity/jquery.peity.min.js"></script>
        <script src="/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="/assets/js/pages/dashboard-1.init.js"></script>
        <script src="/assets/js/app.min.js"></script>
        <script src="/assets/libs/select2/select2.min.js"></script>
        <script src="/assets/js/pages/form-advanced.init.js"></script>
    </body>
</html>
