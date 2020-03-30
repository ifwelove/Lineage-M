<?php

namespace App\Http\Controllers;

use App\Games;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class BossController extends Controller
{
    private function getLayoutConfig()
    {
        $layout_items        = config('game-item');
        $layout_servers      = config('games');
        $layout_game_servers = config('game-server');
        for ($i = 1; $i <= 7; $i++) {
            $date           = Carbon::today()
                ->subDays($i);
            $layout_dates[] = $date->format('Y-m-d');
        }

        return [
            'layout_dates'        => $layout_dates,
            'layout_today'        => Carbon::today()
                ->format('Y-m-d'),
            'layout_servers'      => $layout_servers,
            'layout_game_servers' => $layout_game_servers,
            'layout_items'        => $layout_items,
        ];
    }

    public function index(Request $request)
    {
        Artisan::call('boss:list');
        $bossConfig = Config::get('boss');
        $bossList   = \Illuminate\Support\Facades\Cache::get('bossList');

        return view('theme.layout-boss', $this->getLayoutConfig() + [
                'bossList'   => $bossList,
                'bossConfig' => $bossConfig,
            ]);
    }

    public function kill(Request $request)
    {
        $bossConfig = Config::get('boss');
        $name       = $request->get('name', null);
        $time       = $request->get('time', null);
        if (! isset($bossConfig[$name])) {
            redirect('boss');
        }
        Artisan::call('boss:kill', [
            '--name' => $name,
            '--time' => $time
        ]);

        return redirect('boss');
    }

    public function clear(Request $request)
    {
        Artisan::call('boss:clear');

        return redirect('boss');
    }

    public function reload(Request $request)
    {
        return redirect('boss');
    }
}
