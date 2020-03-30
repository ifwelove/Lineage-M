@extends('theme.layout')

@section('css')
@endsection

@section('content')
    <div class="row">
        <h1>Boss</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/index.html">
                返回首頁
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2 col-sm-3 py-2">
            <a href="boss/reload" role="button" class="btn btn-outline-primary waves-effect waves-light">刷新</a>
        </div>
        <div class="col-xl-2 col-sm-3 py-2">
            <a href="boss/clear" role="button" class="btn btn-outline-primary waves-effect waves-light">清空</a>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 py-2">
            <form action="/boss/kill" >
            <div class="input-group mb-3">
                <button class="btn btn-outline-primary waves-effect waves-light" type="submit">
                    擊殺
                </button>
                <select name="name" class="form-control select2">
                    <option>Boss</option>
                    @foreach ($bossConfig as $item => $min)
                        <option value="{{ $item }}" style="color: #000000; !important;">{{ $item }}</option>
                    @endforeach
                </select>
                <input type="text" name="time" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>Boss名稱</th>
                            <th>下次出現時間</th>
{{--                            <th>紀錄死亡時間</th>--}}
                            <th>PASS次數</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bossList as $boss => $info)
                            <tr class="table-active">
                                <td>{{ $boss }}</td>
                                <td>{{ $info['nextTime'] }}</td>
{{--                                <td>{{ $info['killTime'] }}</td>--}}
                                <td>{{ $info['pass'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card-box -->
        </div>
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection

