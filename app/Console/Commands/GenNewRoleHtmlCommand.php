<?php

namespace App\Console\Commands;

use App\Games;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenNewRoleHtmlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:new-role-html';

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
        ini_set('memory_limit', '2048M');
        ignore_user_abort(true);
        set_time_limit(1200);
        $first   = Games::where('server_id', 1)
            ->orderBy('date', 'desc')
            ->first();
        $servers = config('games');
        Games::where('date', $first->date)
            ->chunk(200, function ($games) use ($servers) {
                foreach ($games as $game) {
                    $serverId = $game->server_id;
                    $name     = $game->role_name;
                    $path     = public_path('role/' . $serverId);
                    $url      = public_path('role/' . $serverId . '/' . $name . '.html');


                    $items = Games::where('server_id', $serverId)
                        ->where('role_name', $name)
                        ->orderBy('date')
                        ->get();

                    $contents = view('theme.layout-name')
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
                }
            });
    }
}

