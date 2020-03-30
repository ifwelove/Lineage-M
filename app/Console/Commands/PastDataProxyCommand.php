<?php

namespace App\Console\Commands;

use App\Games;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PastDataProxyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'past:data-proxy';

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
//        $game = Games::where('server_id', 1)->orderBy('date')->first();
        $date = '2020-02-04';
        $this->date = Carbon::parse($date)->subDays(1);
        dump($this->date);
//        Log::Info(['past:data' => $this->date]);
//        Log::Info(['start' => Carbon::now()]);
        $this->exec();
//        Log::Info(['end' => Carbon::now()]);
    }


    public function exec()
    {
        $servers = config('games');
        foreach ($servers as $serverId => $serverName) {
            $this->serverId = $serverId;
            dump($this->serverId);
//            $this->date = Carbon::today()->subDays(1);
            $this->page = 0;
            $this->totalpage = 0;
            $this->curl();
        }
    }

    public function curl()
    {
        $proxy = 'tps181.kdlapi.com'.":".'15818';
        $username   = "t18092039566770";
        $password   = "lz2o4a5p";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_PROXY => $proxy,
            CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
            CURLOPT_PROXYUSERPWD => "{$username}:{$password}",

            CURLOPT_URL => "https://event.beanfun.com/LineageM/api/DayItemSearch/GetData",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_CONNECTTIMEOUT => 10,
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
            sleep(1);
            $this->curl();
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
                }
                sleep(1);
                $this->curl();
            }
        }
        sleep(1);
    }
}

