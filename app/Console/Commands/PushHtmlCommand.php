<?php

namespace App\Console\Commands;

use App\Games;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PushHtmlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:html';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
//        $this->money();
//        dd(123);
        $this->indexHtml();
        $this->serverDayReport();
        $this->serverMonthReport();
        $this->cardTime();
        $this->purpleItemTime();
        $this->redItemTime();
        $this->item();
        $this->wawa();
        dd('ok');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function indexHtml()
    {
        set_time_limit(0);
        $items = config('game-item');
        $wawas = config('game-wawa');
        for ($i = 1; $i <= 90; $i++) {
            $date = Carbon::today()->subDays($i);
            $dates[] = $date->format('Y-m-d');
        }
        $contents = view('server-day-report-index')->with([
            'dates' => $dates,
            'items' => $items,
            'wawas' => $wawas,
        ])->render();
        file_put_contents(storage_path('games/index.html'),
            $contents);
    }

    public function wawaPage()
    {
        set_time_limit(0);
        $servers = config('games');
        $wawasConfig = config('game-wawa');
        $wawas = collect($wawasConfig)->pluck('item');
        $result = [];
        foreach ($wawas as $wawa) {
            for ($i = 0; $i < 24; $i++) {
                $start = Carbon::today()->hours($i)->format('H:i');
                $end = Carbon::today()->hours($i)->minutes(59)->format('H:i');
                $result[$start . '-' . $end][$wawa] = 0;
            }
        }
        foreach ($wawas as $wawa) {
            $data = Games::where('type', 1)->where('grade_cd', 4)->where('item_name', $wawa);
            $data = $data->get();
            $data = $data->toArray();

            foreach ($data as $item) {
                list($time) = explode(':', $item['get_time']);
                $time = $time . ':00-' . $time . ':59';
                $result[$time][$wawa]++;
            }
        }
        $output = [];
        foreach ($result as $time => $items) {
            $tempTotal = collect($items)->sum();
            foreach ($items as $wawaName => $num) {
                $output[$time][$wawaName] = round($num * 100 / $tempTotal, 2);
            }
        }
        foreach ($output as $time => &$item) {
            arsort($item);
//            dd($item);
//            $output[$time] = $item;
        }
        $contents = view('wawa-time')->with([
            'servers' => $servers,
            'result' => $output,
        ])->render();
        file_put_contents(storage_path('games/' . 'wawa' . '.html'),
            $contents);
//        foreach ($wawasConfig as $wawa) {
//            $contents = view('wawa-time')->with([
//                'servers' => $servers,
//                'result' => $output,
//                'template_name' => $wawa['item'],
//                'unit' => $wawa['unit'],
//            ])->render();
//
//            file_put_contents(storage_path('games/' . $wawa['item'] . '.html'),
//                $contents);
//        }
    }

    public function itemPage($template_name = null, $item_name = null, $land_nm = null, $unit = null)
    {
        set_time_limit(0);
        $servers = config('games');
        //@all
        $data = Games::where('item_name', $item_name);
        if (!is_null($land_nm)) {
            $data = $data->where('land_nm', $land_nm);
        }
        $data = $data->get();
        $total = $data->count();
        $data = $data->toArray();
        $result = [];
        for ($i = 0; $i < 24; $i++) {
            $start = Carbon::today()->hours($i)->format('H:i');
            $end = Carbon::today()->hours($i)->minutes(59)->format('H:i');
            $result[$start . '-' . $end]['num'] = 0;
            $result[$start . '-' . $end]['percent'] = 0;
        }
        foreach ($data as $item) {
            list($time) = explode(':', $item['get_time']);
            $time = $time . ':00-' . $time . ':59';
            $result[$time]['num']++;
        }
        foreach ($result as $time => &$item) {
            $item['time'] = $time;
            $item['percent'] = round($item['num'] * 100 / $total, 2);
        }
        $percent = array_column($result, 'percent');
        array_multisort($percent, SORT_DESC, $result);
        //@50
        $data50 = Games::where('item_name', $item_name);
        if (!is_null($land_nm)) {
            $data50 = $data50->where('land_nm', $land_nm);
        }
        $data50 = $data50->take(50)->get();
        $total50 = $data50->count();
        $data50 = $data50->toArray();
        $result50 = [];
        for ($i = 0; $i < 24; $i++) {
            $start = Carbon::today()->hours($i)->format('H:i');
            $end = Carbon::today()->hours($i)->minutes(59)->format('H:i');
            $result50[$start . '-' . $end]['num'] = 0;
            $result50[$start . '-' . $end]['percent'] = 0;
        }
        foreach ($data50 as $item50) {
            list($time) = explode(':', $item50['get_time']);
            $time = $time . ':00-' . $time . ':59';
            $result50[$time]['num']++;
        }
        foreach ($result50 as $time => &$item50) {
            $item50['time'] = $time;
            $item50['percent'] = round($item50['num'] * 100 / $total50, 2);
        }
        $percent = array_column($result50, 'percent');
        array_multisort($percent, SORT_DESC, $result50);
        //@20
        $data20 = Games::where('item_name', $item_name);
        if (!is_null($land_nm)) {
            $data20 = $data20->where('land_nm', $land_nm);
        }
        $data20 = $data20->take(20)->get();
        $total20 = $data20->count();
        $data20 = $data20->toArray();
        $result20 = [];
        for ($i = 0; $i < 24; $i++) {
            $start = Carbon::today()->hours($i)->format('H:i');
            $end = Carbon::today()->hours($i)->minutes(59)->format('H:i');
            $result20[$start . '-' . $end]['num'] = 0;
            $result20[$start . '-' . $end]['percent'] = 0;
        }
        foreach ($data20 as $item20) {
            list($time) = explode(':', $item20['get_time']);
            $time = $time . ':00-' . $time . ':59';
            $result20[$time]['num']++;
        }
        foreach ($result20 as $time => &$item20) {
            $item20['time'] = $time;
            $item20['percent'] = round($item20['num'] * 100 / $total20, 2);
        }
        $percent = array_column($result20, 'percent');
        array_multisort($percent, SORT_DESC, $result20);
        $contents = view('item-time')->with([
            'servers' => $servers,
            'result' => array_slice(array_values($result), 0, 10),
            'result50' => array_slice(array_values($result50), 0, 5),
            'result20' => array_slice(array_values($result20), 0, 5),
            'total' => $total,
            'template_name' => $template_name,
            'unit' => $unit,
        ])->render();

        file_put_contents(storage_path('games/' . $template_name . '.html'),
            $contents);
    }

    public function item()
    {
        set_time_limit(0);
        $items = config('game-item');
        foreach ($items as $item) {
            $this->itemPage($item['item'], $item['item'], $item['nm'], $item['unit']);
        }
    }

    public function wawa()
    {
        set_time_limit(0);
        $this->wawaPage();

    }

    public function serverMonthReport()
    {
        set_time_limit(0);
        $servers = config('games');
        foreach ($servers as $serverId => $serverName) {
            $end = Carbon::today()->subDays(1)->endOfDay();
            $start = Carbon::today()->subDays(30)->startOfDay();
            $data = Games::where('server_id', $serverId)->whereBetween('date',
                array($start, $end))->get();
            $grouped = $data->groupBy(function ($item, $key) {
                return $item['role_name'];
            });
            $groupCount = $grouped->map(function ($item, $key) {
                return collect($item)->count();
            });
            $result = $groupCount->toArray();
            arsort($result);
            $result = array_slice($result, 0, 30);
            $data = [];
            foreach ($result as $name => $num) {
                $row['name'] = $name;
                $row['num'] = $num;
                $data[] = $row;
            }
            $contents = view('near-month-report')->with([
                'servers' => $servers,
                'serverName' => $serverName,
                'result' => $data,
            ])->render();

            file_put_contents(storage_path('games/near-month-report' . '-' . $serverId . '.html'),
                $contents);
        }
    }

    public function serverDayReport()
    {
        set_time_limit(0);
//        $serverId = 25;
        $servers = config('games');
        foreach ($servers as $serverId => $serverName) {
//            $serverName = $servers[$serverId];
//            for ($i = 2; $i <= 90; $i++) {
//                $date = Carbon::today()->subDays($i);
            $date = Carbon::today()->subDays(1);
            dump($date);
            $data = Games::where('server_id', $serverId)->where('date', $date)->orderBy('id')->get();
            $filtered1 = $data->filter(function ($item, $key) {
                return $item->type == 3 && $item->land_nm !== '[組隊副本][歐林]追隨者 一般' && (strpos($item->item_name,
                            '刻印') === false);
            })->all();
            $filtered2 = $data->filter(function ($item, $key) {
                return $item->type == 3 && (strpos($item->item_name, '刻印') !== false);
            })->all();
            $filtered3 = $data->filter(function ($item, $key) {
                return $item->type == 1;
            })->all();
            $filtered4 = $data->filter(function ($item, $key) {
                return $item->type == 3 && $item->land_nm === '[組隊副本][歐林]追隨者 一般';
            })->all();
            $filtered5 = [];
            foreach ($data as $item) {
                switch (true) {
                    case ((strpos($item->land_nm,
                            '烈焰地監') !== false)):
                        $location = '烈焰地監';
                        if (!isset($filtered5[$location])) {
                            $filtered5[$location]['total'] = 1;
                        } else {
                            $filtered5[$location]['total']++;
                        }
                        if (!isset($filtered5[$location]['data'][$item->land_nm])) {
                            $filtered5[$location]['data'][$item->land_nm] = 1;
                        } else {
                            $filtered5[$location]['data'][$item->land_nm]++;
                        }
                        break;
                    case (is_null($item->land_nm) || $item->land_nm === ''):
                        break;
                    case ((strpos($item->land_nm,
                            '組隊副本') !== false)):
                        break;
                    case ((strpos($item->land_nm,
                            '世界首領') !== false)):
                        break;
                    case ((strpos($item->land_nm,
                            '亞丁大陸') !== false)):
                        $location = '亞丁大陸';
                        if (!isset($filtered5[$location])) {
                            $filtered5[$location]['total'] = 1;
                        } else {
                            $filtered5[$location]['total']++;
                        }
                        if (!isset($filtered5[$location]['data'][$item->land_nm])) {
                            $filtered5[$location]['data'][$item->land_nm] = 1;
                        } else {
                            $filtered5[$location]['data'][$item->land_nm]++;
                        }
                        break;
                    case ((strpos($item->land_nm,
                            '伊娃王國') !== false)):
                        $location = '伊娃王國';
                        if (!isset($filtered5[$location])) {
                            $filtered5[$location]['total'] = 1;
                        } else {
                            $filtered5[$location]['total']++;
                        }
                        if (!isset($filtered5[$location]['data'][$item->land_nm])) {
                            $filtered5[$location]['data'][$item->land_nm] = 1;
                        } else {
                            $filtered5[$location]['data'][$item->land_nm]++;
                        }
                        break;
                    case ((strpos($item->land_nm,
                            '傲慢之塔') !== false)):
                        $location = '傲慢之塔';
                        if (!isset($filtered5[$location])) {
                            $filtered5[$location]['total'] = 1;
                        } else {
                            $filtered5[$location]['total']++;
                        }
                        if (!isset($filtered5[$location]['data'][$item->land_nm])) {
                            $filtered5[$location]['data'][$item->land_nm] = 1;
                        } else {
                            $filtered5[$location]['data'][$item->land_nm]++;
                        }
                        break;
                    case ((strpos($item->land_nm,
                            '奇岩地監') !== false)):
                        $location = '奇岩地監';
                        if (!isset($filtered5[$location])) {
                            $filtered5[$location]['total'] = 1;
                        } else {
                            $filtered5[$location]['total']++;
                        }
                        if (!isset($filtered5[$location]['data'][$item->land_nm])) {
                            $filtered5[$location]['data'][$item->land_nm] = 1;
                        } else {
                            $filtered5[$location]['data'][$item->land_nm]++;
                        }
                        break;
                    case ((strpos($item->land_nm,
                            '龍之谷地監') !== false)):
                        $location = '龍之谷地監';
                        if (!isset($filtered5[$location])) {
                            $filtered5[$location]['total'] = 1;
                        } else {
                            $filtered5[$location]['total']++;
                        }
                        if (!isset($filtered5[$location]['data'][$item->land_nm])) {
                            $filtered5[$location]['data'][$item->land_nm] = 1;
                        } else {
                            $filtered5[$location]['data'][$item->land_nm]++;
                        }
                        break;

                }
            }
            ksort($filtered5);
            $contents = view('server-day-report')->with([
                'servers' => $servers,
                'date' => $date->format('Y-m-d'),
                'serverName' => $serverName,
                'data1' => $filtered1,
                'data2' => $filtered2,
                'data3' => $filtered3,
                'data4' => $filtered4,
                'data5' => $filtered5,
            ])->render();

            file_put_contents(storage_path('games/' . $date->format('Y-m-d') . '-' . $serverId . '.html'),
                $contents);
//            }
        }
    }

    public function purpleItemTime()
    {
        set_time_limit(0);
        ini_set('memory_limit', '4096M');
        $servers = config('games');
        $end = Carbon::today()->subDays(1)->endOfDay();
        $start = Carbon::today()->subDays(7)->startOfDay();
        $result = Games::where('type', 3)->where('grade_cd', 5)->whereBetween('date',
            array($start, $end))->orderBy('id', 'desc')->get();
        $contents = view('purple-item-time')->with([
            'servers' => $servers,
            'result' => $result,
        ])->render();

        file_put_contents(storage_path('games/purple-item-time' . '.html'),
            $contents);
    }

    public function redItemTime()
    {
        set_time_limit(0);
        ini_set('memory_limit', '4096M');
        $servers = config('games');
        $end = Carbon::today()->subDays(1)->endOfDay();
        $start = Carbon::today()->subDays(7)->startOfDay();
        $result = Games::where('type', 3)->where('grade_cd', 4)->whereBetween('date',
            array($start, $end))->orderBy('id', 'desc')->get();
        $contents = view('red-item-time')->with([
            'servers' => $servers,
            'result' => $result,
        ])->render();

        file_put_contents(storage_path('games/red-item-time' . '.html'),
            $contents);
    }

    public function cardTime()
    {
        set_time_limit(0);
        ini_set('memory_limit', '4096M');
        $servers = config('games');

        $yellow_result = [];
        $yellow_result = Games::where('type', 1)->where('grade_cd', 32)->orderBy('id')->get();

        $purple_result = [];
        $purple_total = 0;
        for ($i = 0; $i < 24; $i++) {
            $start = Carbon::today()->hours($i)->format('H:i:s');
            $end = Carbon::today()->hours($i)->minutes(59)->format('H:i:s');
            $purple = [];
            $purple = Games::where('type', 1)->whereBetween('get_time',
                array($start, $end))->where('grade_cd', 5)->orderBy('id')->get();
            $sum = $purple->count();
            $purple_result[$start . '-' . $end]['total'] = $sum;
            $purple_result[$start . '-' . $end]['percent'] = 0;
            $purple_total += $sum;
        }
        foreach ($purple_result as $time => &$data) {
            $data['percent'] = round($data['total'] * 100 / $purple_total, 2);
        }
        $percent = array_column($purple_result, 'percent');
        array_multisort($percent, SORT_DESC, $purple_result);

        $all_result = [];
        $all_total = 0;
        for ($i = 0; $i < 24; $i++) {
            $start = Carbon::today()->hours($i)->format('H:i:s');
            $end = Carbon::today()->hours($i)->minutes(59)->format('H:i:s');
            $red = [];
            $red = Games::where('type', 1)->whereBetween('get_time',
                array($start, $end))->orderBy('id')->get();
            $sum = $red->count();
            $all_result[$start . '-' . $end]['total'] = $sum;
            $all_result[$start . '-' . $end]['percent'] = 0;
            $all_total += $sum;
        }
        foreach ($all_result as $time => &$data) {
            $data['percent'] = round($data['total'] * 100 / $all_total, 2);
        }
        $percent = array_column($all_result, 'percent');
        array_multisort($percent, SORT_DESC, $all_result);
        $contents = view('card-time')->with([
            'servers' => $servers,
            'all_result' => array_slice($all_result, 0, 5),
            'purple_result' => array_slice($purple_result, 0, 5),
            'yellow_result' => $yellow_result->toArray(),
        ])->render();

        file_put_contents(storage_path('games/card-time' . '.html'),
            $contents);
    }



    public function money()
    {
        $servers = config('games');
        foreach ($servers as $serverId => $serverName) {
            $this->serverId = $serverId;
            dump($this->serverId);
            $this->date = Carbon::today()->subDays(1);
//            for ($i = 1; $i < 31; $i++) {
//                $this->date = sprintf('2019-09-%s', $i);
            $this->page = 0;
            $this->totalpage = 0;
            $this->mapping = [
                '亞丁大陸' => ['總數' => 0],
                '傲慢之塔' => ['總數' => 0],
                '伊娃王國' => ['總數' => 0],
                '龍之谷地監' => ['總數' => 0],
                '奇岩地監' => ['總數' => 0],
                '烈焰地監' => ['總數' => 0],
            ];
            $this->curl();
//            }
        }
//        dump($this->mapping);
//        collect($this->mapping)->each(function ($value, $key) {
//            dump($key . ' : ' . $value . ' 個');
//        });
    }

    public function curl()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://event.beanfun.com/LineageM/api/DayItemSearch/GetData",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"page\":\"$this->page\",\"date\":\"$this->date\",\"serverid\":\"$this->serverId\",\"searchall\":1,\"grade_cd\":[\"3\",\"4\",\"5\"],\"itemgroupname\":[\"Buff_Polymorph\",\"Buff_MagicDoll\",\"weapon\",\"armor\",\"accessory\",\"spellbook\",\"other\"]}",
//            CURLOPT_POSTFIELDS => "{\"page\":0,\"date\":\"$this->date\",\"serverid\":\"$serverId\",\"charactername\":\"$this->name\",\"searchall\":1,\"grade_cd\":[\"3\",\"4\",\"5\"],\"itemgroupname\":[\"Buff_Polymorph\",\"Buff_MagicDoll\",\"weapon\",\"armor\",\"accessory\",\"spellbook\",\"other\"]}",
//            CURLOPT_HTTPHEADER => array(
//                "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAwZDJmOTJhYTJkMDE4YTE4NWFlMzk2MDJiZTA4ZDI3OWQxYjdiMWU3MjYzNmRmN2UyYjFlZDgwNDhiMzkxZWFkOWE5ZDk2YjBhMzgyOTYwIn0.eyJhdWQiOiI2IiwianRpIjoiMDBkMmY5MmFhMmQwMThhMTg1YWUzOTYwMmJlMDhkMjc5ZDFiN2IxZTcyNjM2ZGY3ZTJiMWVkODA0OGIzOTFlYWQ5YTlkOTZiMGEzODI5NjAiLCJpYXQiOjE1NDc4ODg4NzEsIm5iZiI6MTU0Nzg4ODg3MSwiZXhwIjoxNTQ3OTc1MjcxLCJzdWIiOiIzIiwic2NvcGVzIjpbIioiXX0.RlPDFmJQKExCsM7eF_r1jqS6KkcoLufrkd6vBoyQL1diho1YAvujgi3U449g-qopIH6bzm-nZtI2sw5q-TiQUvtwv68mKt3ipbvkPuBaIu95vQ0azRrqsZ-9TUHYMWpH92joOCO8XSlJMTb6fVM9_fqajCfhadU0GJ77vOBuba2axzZG16txJ5s7XWstfPwRzoIkHU17V9LMrfNmMRoKt30pAwbNfnUgsY09Afrw5kO-AHZvDjfsiaVVj7dSn9xLBEHlK8hdsaxLRnTSKwLzvVFJc37ok1bs3mBmzolWGoTUfRRV45Tj4-QiIyuYGklkVAqkE-YnbKvoPdZEMuw1c-C9Lsj7AjCo2o1pixqTepsm-nmDJiRvc-d5QV0lK2-JWa_dSIPVeS8LcYYHXJl-f7r53M_jQXFeh8djnut2H3MemnU2E7rmcKg-Fw95-bkDnr5FDVzAbamlZGpMDv6kNOe5COY5SKLLqd5lssLAwF5BBM7pCs9ojd9BFV01AwPiooBNVwjQ8viEraDHBc_pEsqXb791ow9cZDtLTYKG7JILNdGtdYeKvTSeZ496qCGO0btWKwDFMww9g_jCJvyKPVzHeN6powJiGeZ12paMFuSR5qU6jYMcv0OwwORZUVass0sG1p5M2AffbzjXpm-8sgn28jG9O--Js1G4w_rC9gA",
//                "cache-control: no-cache",
//                "content-type: application/json",
//                "postman-token: 5642b56d-48fd-02ed-ef98-cede33b275dc"
//            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
//        dd($response);
        if ($err) {
            dump($err);
//            exit;
        } else {
//            exit;
            $data = json_decode($response);
            if ($this->page == 0) {
                $this->totalpage = $data->data->totalpage;
            }
            if ($this->totalpage > 0 && $this->page <= $this->totalpage) {
                $this->page++;
                foreach ($data->data->pagedata as $row) {
                    $item['server_id'] = $this->serverId;
                    $item['date'] = $this->date;
                    $item['get_time'] = $row->get_time;
                    $item['type'] = $row->type;
                    $item['role_name'] = $row->charactername;
                    $item['row_num'] = $row->rownum;
                    $item['grade_cd'] = $row->grade_cd;
                    $item['item_name'] = $row->itemname;
                    $item['land_nm'] = $row->land_nm;
//                    dump($item);
                    Games::create($item);
                    if ($this->serverId != 25) {
                        continue;
                    }
                    $txt = $row->get_time . ' ' . $row->charactername . ' ' . $row->land_nm . ' ' . $row->itemname;
                    if ($row->land_nm === '') {
                        continue;
                    }
                    if (strpos($txt, '刻印') !== false) {
                        continue;
                    }
                    if (strpos($txt, '歐林的日記') !== false) {
                        continue;
                    }
                    if (strpos($txt, '組隊副本') !== false) {
                        continue;
                    }
                    if (strpos($txt, '活動') !== false) {
                        continue;
                    }

                    if (strpos($txt, '亞丁大陸') !== false) {
                        ++$this->mapping['亞丁大陸']['總數'];
                    }
                    if (strpos($txt, '傲慢之塔') !== false) {
                        ++$this->mapping['傲慢之塔']['總數'];
                        if (!isset($this->mapping['傲慢之塔'][$row->land_nm])) {
                            $this->mapping['傲慢之塔'][$row->land_nm] = 0;
                        }
                        if (strpos($txt, $row->land_nm) !== false) {
                            ++$this->mapping['傲慢之塔'][$row->land_nm];
                        }
                    }
                    if (strpos($txt, '伊娃王國') !== false) {
                        ++$this->mapping['伊娃王國']['總數'];
                    }
                    if (strpos($txt, '龍之谷地監') !== false) {
                        ++$this->mapping['龍之谷地監']['總數'];
                        if (!isset($this->mapping['龍之谷地監'][$row->land_nm])) {
                            $this->mapping['龍之谷地監'][$row->land_nm] = 0;
                        }
                        if (strpos($txt, $row->land_nm) !== false) {
                            ++$this->mapping['龍之谷地監'][$row->land_nm];
                        }
                    }
                    if (strpos($txt, '奇岩地監') !== false) {
                        ++$this->mapping['奇岩地監']['總數'];
                        if (!isset($this->mapping['奇岩地監'][$row->land_nm])) {
                            $this->mapping['奇岩地監'][$row->land_nm] = 0;
                        }
                        if (strpos($txt, $row->land_nm) !== false) {
                            ++$this->mapping['奇岩地監'][$row->land_nm];
                        }
                    }
                    if (strpos($txt, '烈焰地監') !== false) {
                        ++$this->mapping['烈焰地監']['總數'];
                        if (!isset($this->mapping['烈焰地監'][$row->land_nm])) {
                            $this->mapping['烈焰地監'][$row->land_nm] = 0;
                        }
                        if (strpos($txt, $row->land_nm) !== false) {
                            ++$this->mapping['烈焰地監'][$row->land_nm];
                        }
                    }
//                    Log::Info($txt);
                    dump($txt);
                }
                sleep(rand(4, 6));
                $this->curl();
            }
        }
    }
}

