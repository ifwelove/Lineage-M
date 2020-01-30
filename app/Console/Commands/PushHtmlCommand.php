<?php

namespace App\Console\Commands;

use App\Games;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
//        $files = Storage::allFiles();
//        dd($files);
//        foreach ($files as $file) {
//            if ($file != '.DS_Store') {
//                rename(storage_path(sprintf("games/%s", $file)),sprintf("../%s", $file));
//            }
//        }
        Log::Info([Carbon::now()]);
        $this->indexHtml();
        $this->serverDayReport();
        $this->serverMonthReport();
        $this->cardTime();
        $this->purpleItemTime();
        $this->redItemTime();
        $this->item();
        $this->wawa();
        Log::Info([Carbon::now()]);
//        dd('ok');
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
}

