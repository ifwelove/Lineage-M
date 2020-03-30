<?php

namespace App\Console\Commands;

use App\Games;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BossInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boss:load-local-data';

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
        $bossList = \Illuminate\Support\Facades\Cache::get(8888);
//        \Illuminate\Support\Facades\Cache::put(8888, []);
        $sorted = collect($bossList)->sort(function($a, $b) {
            $aNextTime = Carbon::createFromFormat('Y-m-d H:i:s', $a['nextTime']);
            $bNextTime = Carbon::createFromFormat('Y-m-d H:i:s', $b['nextTime']);
            if ($aNextTime->eq($bNextTime)) {
                return 0;
            }

            return ($aNextTime->gt($bNextTime)) ? 1 : -1;
        });
        dd($sorted);
//        if (Carbon::now()->hour >= 0 && Carbon::now()->hour <= 10) {
//
//        }
//        dd(Carbon::now()->hour);
//        LOAD DATA LOCAL INFILE '/home/gamebixo/tmp/phpErJeFS' INTO TABLE `games` FIELDS TERMINATED BY ';' ENCLOSED BY '\"' ESCAPED BY '\\' LINES TERMINATED BY '\n'
//        LOAD DATA INFILE '/home/gamebixo/tmp/php3zetad' INTO TABLE `games` FIELDS TERMINATED BY ';' ENCLOSED BY '\"' ESCAPED BY '\\' LINES TERMINATED BY '\n' IGNORE 1 LINES
//        if (file_exists(storage_path("app/public/100game.csv"))) {
//            dd(123);
//        }
        //        try
        //        {
//        LOAD DATA LOCAL INFILE '/home/gamebixo/tmp/php8PQz8U' INTO TABLE `games` FIELDS TERMINATED BY ';' ENCLOSED BY '\"' ESCAPED BY '\\' LINES TERMINATED BY '\r\n' (`(server_id`, `date`, `type`, `grade_cd`, `row_num`, `get_time`, `role_name`, `item_name`, `land_nm`, `created_at`, `updated_at`, `deleted_at)`)
//        $query  = "LOAD DATA LOCAL INFILE '" . storage_path("app/public/100game.csv") . "' INTO TABLE games CHARACTER SET UTF8 FIELDS TERMINATED BY ';' enclosed by '\"' lines terminated by '\n'  (server_id,date,type,grade_cd,row_num,get_time,role_name,item_name,land_nm,created_at,updated_at,deleted_at) ";
        $query  = "LOAD DATA LOCAL INFILE '" . storage_path("app/public/100game.csv") . "' INTO TABLE games CHARACTER SET UTF8 FIELDS TERMINATED BY ';' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' (server_id,date,type,grade_cd,row_num,get_time,role_name,item_name,land_nm,created_at,updated_at,deleted_at)";
        $pdo    = \DB::connection()
            ->getPdo();
        $result = $pdo->exec($query);
        dd($result);
    }
}

