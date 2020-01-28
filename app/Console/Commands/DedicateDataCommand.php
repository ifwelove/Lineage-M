<?php

namespace App\Console\Commands;

use App\Games;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DedicateDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dedicate:data';

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
        Log::Info([Carbon::now()]);
        $this->exec();
        Log::Info([Carbon::now()]);
    }


    public function exec()
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

