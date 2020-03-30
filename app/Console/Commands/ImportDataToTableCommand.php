<?php

namespace App\Console\Commands;

use App\Games;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportDataToTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

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
        $start = Carbon::now();
//        ini_set('memory_limit', '2048M');
        ini_set('memory_limit', '1024M');
        ignore_user_abort(true);
        set_time_limit(3600);
        //        $data = file(storage_path('100.csv'));
        //        $data = file(storage_path('all.csv'));
        $data = file(storage_path('games/1.csv'));
        $batch    = [];
        foreach ($data as $key => $item) {
            $info = explode(';', str_replace('"', '', trim($item)));
            $b['server_id'] = $info[0];
            $b['date']      = $info[1];
            $b['type']      = $info[2];
            $b['grade_cd']  = $info[3];
            $b['row_num']   = $info[4];
            $b['get_time']  = $info[5];
            $b['role_name'] = $info[6];
            $b['item_name'] = $info[7];
            $b['land_nm']   = $info[8];
            $batch[]            = $b;
            if (count($batch) >= 1999) {
                Games::insert($batch);
                $batch = [];
            }
        }
        Games::insert($batch);
//        dd(count($data));
        //        $parts = (array_chunk($data, 100000));
        //        $i = 1;
        //        foreach($parts as $line) {
        //            $filename = storage_path('games/'.$i.'.csv');
        //            file_put_contents($filename, $line);
        //            $i++;
        //        }
        //        dd(count($data));
        //        dd(count($result));
        //        $result = array_map(function($val) {
        ////            dd(explode(';', trim($val)));
        //            return explode(';', trim($val));
        //        }, $data);
        //        dd(count($result));
        //        $data = array_map('trim', $data);
        $end  = Carbon::now();
        $diff = $start->diffInSeconds($end);
        //        dump(count($data));
        dd($diff);
    }
}

