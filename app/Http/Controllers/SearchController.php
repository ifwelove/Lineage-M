<?php

namespace App\Http\Controllers;

use App\Games;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getLayoutConfig()
    {
        $layout_items   = config('game-item');
        $layout_servers = config('games');
        for ($i = 1; $i <= 7; $i++) {
            $date           = Carbon::today()
                ->subDays($i);
            $layout_dates[] = $date->format('Y-m-d');
        }

        return [
            'layout_dates'   => $layout_dates,
            'layout_today'   => Carbon::today()
                ->format('Y-m-d'),
            'layout_servers' => $layout_servers,
            'layout_items'   => $layout_items,
        ];
    }

    public function indexOld(Request $request)
    {
        $serverId = $request->get('serverId');
        $name     = $request->get('name');
        $path     = public_path('role/' . $serverId);
        $url      = public_path('role/' . $serverId . '/' . $name . '.html');
        if (file_exists($url)) {
            return redirect('role/' . $serverId . '/' . $name . '.html');
        }

        $servers = config('games');
        $items   = Games::where('server_id', $serverId)
            ->where('role_name', $name)
            ->orderBy('date')
            ->get();

        if ($items->count() === 0) {
            return redirect('/');
        }

        $contents = view('name')
            ->with([
                'servers'    => $servers,
                'data'       => $items->toArray(),
                'name'       => $name,
                'serverName' => $servers[$serverId],
            ])
            ->render();

        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        file_put_contents($url, $contents);

        return redirect('role/' . $serverId . '/' . $name . '.html');
    }

    //    public function import(Request $request){
    //        $start = Carbon::now();
    //        ini_set('memory_limit', '2048M');
    //        ignore_user_abort(true);
    //        set_time_limit(3600);
    //        $data = file(storage_path(sprintf('games/%d.csv', $request->get('num'))));
    //        $batch    = [];
    //        foreach ($data as $key => $item) {
    //            $info = explode(';', str_replace('"', '', trim($item)));
    //            $b['server_id'] = $info[0];
    //            $b['date']      = $info[1];
    //            $b['type']      = $info[2];
    //            $b['grade_cd']  = $info[3];
    //            $b['row_num']   = $info[4];
    //            $b['get_time']  = $info[5];
    //            $b['role_name'] = $info[6];
    //            $b['item_name'] = $info[7];
    //            $b['land_nm']   = $info[8];
    //            $batch[]            = $b;
    //            if (count($batch) >= 1999) {
    //                Games::insert($batch);
    //                $batch = [];
    //            }
    //        }
    //        Games::insert($batch);
    //        $end  = Carbon::now();
    //        $diff = $start->diffInSeconds($end);
    //        dd($diff);
    //    }

    public function index(Request $request)
    {
        $serverId = $request->get('serverId');
        $name     = $request->get('name');
        $path     = public_path('role/' . $serverId);
        $url      = public_path('role/' . $serverId . '/' . $name . '.html');
        if (file_exists($url)) {
            return redirect('role/' . $serverId . '/' . $name . '.html');
        }
        $servers = config('games');
        $items   = Games::where('server_id', $serverId)
            ->where('role_name', $name)
            ->orderBy('date', 'desc')
            ->get();
        $total   = $items->count();
        if ($total === 0) {
            return redirect('/');
        }
        $last_month = Games::where('server_id', $serverId)
            ->where('role_name', $name)
            ->whereBetween('date', array(
                Carbon::now()
                    ->subMonths()
                    ->startOfMonth()
                    ->format('Y-m-d'),
                Carbon::now()
                    ->subMonths()
                    ->endOfMonth()
                    ->format('Y-m-d')
            ))
            ->count();
        $now_month  = Games::where('server_id', $serverId)
            ->where('role_name', $name)
            ->whereBetween('date', array(
                Carbon::now()
                    ->startOfMonth()
                    ->format('Y-m-d'),
                Carbon::now()
                    ->endOfMonth()
                    ->format('Y-m-d')
            ))
            ->count();
        if ($now_month != 0) {
            $percentage = round(($now_month - $last_month) * 100 / $now_month, 2);
        } else {
            $percentage = 0;
        }
        $last_6_month = [];
        for ($i = 0; $i <= 6; $i++) {
            $last_6_month[Carbon::now()
                ->subMonths($i)
                ->format('Y-m')] = 0;
        }
        $monthlyQuotes = $items->groupBy(function ($item) {
            return Carbon::createFromFormat('Y-m-d', $item->date)
                ->format('Y-m');
        })
            ->toArray();
        foreach ($last_6_month as $month => $value) {
            if (isset($monthlyQuotes[$month])) {
                $last_6_month[$month] = count($monthlyQuotes[$month]);
            }
        }
        ksort($last_6_month);
        $report_string = implode(',', $last_6_month);
        $contents      = view('theme.layout-name')
            ->with($this->getLayoutConfig() + [
                    'report_string' => $report_string,
                    'percentage'    => $percentage,
                    'total'         => $total,
                    'now_month'     => $now_month,
                    'last_month'    => $last_month,
                    'servers'       => $servers,
                    'data'          => $items->toArray(),
                    'date'          => $items->pluck('date')->first(),
                    'name'          => $name,
                    'serverName'    => $servers[$serverId],
                    'pageUrl'      => url('role/' . $serverId . '/' . $name . '.html'),
                ])
            ->render();
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        file_put_contents($url, $contents);

        return redirect('role/' . $serverId . '/' . $name . '.html');
    }
}
