@extends('theme.layout')

@section('css')
@endsection
@section('seo')
    <title>{{ $serverName }} - {{ $date }} 出寶查詢 - {{ config('app.name') }}</title>
    <meta content="🔥{{ $serverName }} - {{ $date }} 出寶查詢- {{ config('app.name') }}🔥" name="description" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $serverName }} - {{ $date }} 出寶查詢 - {{ config('app.name') }}">
    <meta property="og:description" content="🔥{{ $serverName }} - {{ $date }} 出寶查詢 - {{ config('app.name') }}🔥">
    <meta property="og:type" content="website">
{{--    <meta property="og:url" content="{{ $pageUrl }}">--}}
    <meta property="og:locale" content="zh_TW">
@endsection
@section('content')
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
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title mb-4">伺服器分區</h4>
                <ul class="nav nav-pills navtab-bg nav-justified">
                    @foreach ($layout_game_servers as $area => $area_servers)
                        <li class="nav-item">
                            <a href="#basictab{{ $area }}" data-toggle="tab" aria-expanded="false" class="nav-link">
                                {{ $area }}區
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($layout_game_servers as $area => $area_servers)
                        <div class="tab-pane fade" id="basictab{{ $area }}">
                            <div class="row">
                                @foreach ($area_servers as $area_serverId => $area_name)
                                    <div class="col-4">
                                        <a href="/{{ $date }}-{{ $area_serverId }}.html">
                                            [{{ $area_name }}]
                                        </a>
                                    </div> <!-- end col -->
                                @endforeach
                            </div> <!-- end row -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <h2>地點統計</h2>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                {{--                <h4 class="header-title">地點統計</h4>--}}
                <p class="sub-header">
                    亞丁大陸, 伊娃王國, 烈焰地監, 傲慢之塔, 龍之谷地監, 奇岩地監
                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>地點</th>
                            <th>數量</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data5 as $about => $item)
                            <tr class="table-active">
                                <td>{{ $about }}</td>
                                <td>{{ $item['total'] }}</td>
                            </tr>
                            @if (count($item['data']) > 1)
                                @foreach ($item['data'] as $location => $row)
                                    <tr>
                                        <td>{{ $location }}</td>
                                        <td>{{ $row }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card-box -->
        </div>
    </div>
    <h3>裝備, 武器, 道具, 技能書</h3>
    <div class="row">
        @foreach ($data1 as $item)
            @if($item['grade_cd'] == 4)
                <div class="col-12">
                    <p class="text-danger">
                        {{ $item['get_time'] }} <a
                            href="/search?serverId={{ $serverId }}&name={{ $item['role_name'] }}">
                            {{ $item['role_name'] }}
                        </a> {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 32)
                <div class="col-12">
                    <p class="text-warning">
                        {{ $item['get_time'] }} <a
                            href="/search?serverId={{ $serverId }}&name={{ $item['role_name'] }}">
                            {{ $item['role_name'] }}
                        </a> {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @elseif ($item['grade_cd'] == 5)
                <div class="col-12">
                    <p style="color:#563d7c !important;">
                        {{ $item['get_time'] }} <a
                            href="/search?serverId={{ $serverId }}&name={{ $item['role_name'] }}">
                            {{ $item['role_name'] }}
                        </a> {{ $item['land_nm'] }}  {{ $item['item_name'] }}
                    </p>
                </div>
            @else
                <div class="col-12">
                    <p>
                        {{ $item['get_time'] }} <a
                            href="/search?serverId={{ $serverId }}&name={{ $item['role_name'] }}">
                            {{ $item['role_name'] }}
                        </a> {{ $item['land_nm'] }}  {{ $item['item_name'] }}
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
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection

