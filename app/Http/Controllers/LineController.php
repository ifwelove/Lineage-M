<?php

namespace App\Http\Controllers;

use App\Games;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

class LineController extends Controller
{
    private $client;
    private $bot;
    private $channel_access_token;
    private $channel_secret;
    private $breakLine = "\n";

    public function __construct()
    {
    }

    public function webhook(Request $request)
    {
        //        $this->channel_access_token = env('CHANNEL_ACCESS_TOKEN');
        $this->channel_access_token = 'iY6yicI75nexoiZUNAPcQb1s7TFn3HwJbSbT/uyYavvFDLnWhBcTpXkkzIkcuppxVFqwz0Uh5/Q2oyE1+tJLa+9NbhH3V9CF6sS5r0kompdZ4LwkiuboV0daQJef/H1pOGhXEg/dto2iNzr5PJR8WQdB04t89/1O/w1cDnyilFU=';
        //        $this->channel_secret       = env('CHANNEL_SECRET');
        $this->channel_secret = 'f2cb6122e0767ebb3661e39f728edab7';
        //        1653903026
        $httpClient   = new CurlHTTPClient($this->channel_access_token);
        $this->bot    = new LINEBot($httpClient, ['channelSecret' => $this->channel_secret]);
        $this->client = $httpClient;

        $bot       = $this->bot;
        $signature = $request->header(\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        $body      = $request->getContent();

        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        foreach ($events as $event) {
            $replyToken = $event->getReplyToken();
            if ($event instanceof MessageEvent) {
                //                Log::info([$event]);
                $message_type = $event->getMessageType();
                $groupId      = $event->getGroupId();
                switch ($message_type) {
                    case 'text':
                        $text = $event->getText();
                        $this->tv($text, $replyToken);
                        $this->boy($text, $replyToken);
                        $this->tagAll($text, $replyToken);
                        $this->boss($text, $replyToken, $groupId);
                        break;
                }
            }
        }
    }

    public function webhook2(Request $request)
    {
        //        $this->channel_access_token = env('CHANNEL_ACCESS_TOKEN');
        $this->channel_access_token = 'p8Sc2Nbew/ATMShtizxLUUcDK4+VRXjVe3vxImc7+h3ziTZjv9D3EoBJzs1+0YiKfLn3SGqR8cJ038/1sENJF9yTwcbbfrzDGUM4Dzy+sEUA5bpMtjpdh2I9keb51HGDrHB2FMuMy591uchAzQPCWgdB04t89/1O/w1cDnyilFU=';
        //        $this->channel_secret       = env('CHANNEL_SECRET');
        $this->channel_secret = '4f0e1cf13513b321e42ffe5f5b292c54';
        //        1653903026
        $httpClient   = new CurlHTTPClient($this->channel_access_token);
        $this->bot    = new LINEBot($httpClient, ['channelSecret' => $this->channel_secret]);
        $this->client = $httpClient;

        $bot       = $this->bot;
        $signature = $request->header(\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        $body      = $request->getContent();

        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        foreach ($events as $event) {
            $replyToken = $event->getReplyToken();
            if ($event instanceof MessageEvent) {
                $message_type = $event->getMessageType();
                $groupId      = $event->getGroupId();
                switch ($message_type) {
                    case 'text':
                        $text = $event->getText();
                        $this->tv($text, $replyToken);
                        $this->boy($text, $replyToken);
                        $this->tagAll($text, $replyToken);
                        $this->boss($text, $replyToken, $groupId);
                        break;
                }
            }
        }
    }

    private function tv($text, $replyToken)
    {
        $text = strtolower($text);
        switch ($text) {
            case 'tv list' :
                $games   = Config::get('games');
                $message = '點我看更多' . url('/') . $this->breakLine;
                $message .= 'TV 頻道列表' . $this->breakLine;
                foreach ($games as $id => $name) {
                    $message .= $name . ' ' . ' [ ' . $id . ' ] ' . $this->breakLine;
                }
                $this->bot->replyText($replyToken, $message);
                break;
            case (((strpos($text, 'tv') !== false)) && mb_strlen($text) <= 4) :
                $date = Carbon::yesterday()
                    ->format('Y-m-d');
                if (Carbon::now()->hour >= 0 && Carbon::now()->hour <= 10) {
                    $date = Carbon::yesterday()
                        ->subDay()
                        ->format('Y-m-d');
                }
                $channel = explode('tv', $text);
                $message = \Illuminate\Support\Facades\Cache::get(sprintf('tv%d', $channel[1]));
                if (is_null($message)) {
                    $message = $date . $this->breakLine;
                    $message .= '點我看更多' . url('/') . $this->breakLine;
                    $games   = Games::where('server_id', $channel[1])
                        ->where('date', $date)
                        ->orderBy('id', 'ASC')
                        ->get();
                    foreach ($games as $item) {
                        if ($item->item_name == '歐林的日記') {
                            continue;
                        }
                        $message .= Carbon::createFromFormat('H:i:s', $item->get_time)
                                ->format('H:i') . ' ' . $item->role_name . ' ' . $item->item_name . ' ' . $this->breakLine;
                    }
                    \Illuminate\Support\Facades\Cache::put(sprintf('tv%d', $channel[1]), $message, 60);
                }

                $this->bot->replyText($replyToken, mb_substr($message, 0, 1900, "utf-8"));
                break;
            case ((strpos($text, 'tv') !== false)) :
                //todo cache
                $parser  = explode('tv', $text);
                $info    = explode(' ', $parser[1]);
                $channel = $info[0];
                $name    = $info[1];
                $games   = Games::where('server_id', $channel)
                    ->where('role_name', $name)
                    ->orderBy('date', 'ASC')
                    ->get();
                $message = '誕生至今 ' . $info[1] . ' 上了 [ ' . $games->count() . ' ] 次' . $this->breakLine;
                foreach ($games->take(10) as $key => $item) {
                    if ($key === 0) {
                        $message .= $info[1] . ' 的第一次' . $item->date . ' ' . $item->item_name . ' ' . $this->breakLine;
                    } else {
                        $message .= $item->date . ' ' . $item->item_name . ' ' . $this->breakLine;
                    }
                }
                $message .= '點我看更多' . $this->breakLine . url(sprintf('search?serverId=%s&name=%s', $channel, $name));
                $this->bot->replyText($replyToken, $message);
                break;
        }
    }

    private function boss($text, $replyToken, $groupId)
    {
        switch (1) {
            case ($text === '重生' || $text === '重生時間') :
                $message    = '點我看更多' . url('/') . $this->breakLine;
                $bossConfig = Config::get('boss');
                foreach ($bossConfig as $name => $min) {
                    $message .= $name . ' ' . ($min) . ' 分 ' . $this->breakLine;
                }
                $this->bot->replyText($replyToken, $message);

                break;
            case ($text === '王列表') :
                $message  = '點我看更多' . url('/') . $this->breakLine;
                $message  .= '王 標籤ㄧ覽：' . $this->breakLine;
                $bossTags = Config::get('boss-tags');
                foreach ($bossTags as $name => $tags) {
                    $message .= $name . ' : ' . implode(', ', $tags) . $this->breakLine;
                }
                $this->bot->replyText($replyToken, $message);

                break;
            case ($text === '出' || $text === '出王') :
                Artisan::call('boss:list', [
                    '--groupId' => $groupId,
                ]);
                $bossList = \Illuminate\Support\Facades\Cache::get($groupId);
                $message  = '點我看更多' . url('/') . $this->breakLine;
                $message  .= '出王時間表：' . $this->breakLine;
                if (! is_null($bossList)) {
                    foreach ($bossList as $name => $info) {
                        $message .= Carbon::createFromFormat('Y-m-d H:i:s', $info['nextTime'])
                                ->format('H:i') . ' ' . $name . ' ' . '[過' . $info['pass'] . ']' . $this->breakLine;
                    }
                }
                $this->bot->replyText($replyToken, $message);
                break;
            case (preg_match('/^([0-1][0-9]|[2][0-3])([0-5][0-9])([0-5][0-9])? .{1,18}$/', $text)) :
                $boss     = Config::get('boss');
                $bossTags = Config::get('boss-tags');
                $bossMaps = Config::get('boss-maps');
                $list     = [];
                foreach ($bossTags as $name => $tags) {
                    foreach ($tags as $tag) {
                        $list[$tag] = $name;
                    }
                }
                $text    = preg_replace('/\s(?=\s)/', '', $text);
                $info    = explode(' ', $text);
                $name    = $info[1];
                $options = [
                    '--groupId' => $groupId,
                    '--name'    => $info[1],
                ];

                $tt                = str_pad($info[0], 6, '0');
                $options['--time'] = $tt;
                $time              = Carbon::createFromFormat('His', $tt);
                $now               = Carbon::now();
                $pass              = 0;
                if ($time->gt($now)) {
                    $time->subDay();
//                    $killTime = $time->format('m/d H:i:s');
//                    $nextTime = $time->addMinutes($boss[$list[$name]])
//                        ->format('m/d H:i:s');
//                    $min      = $now->diffInMinutes($nextTime);
//                    $pass     = intval($min / $boss[$list[$name]]) + 1;
                }
//                else {
                    $killTime = $time->format('m/d H:i:s');
                    $nextTime = $time->addMinutes($boss[$list[$name]])
                        ->format('m/d H:i:s');
//                }
//                if ($pass > 0) {
//                    $nextTime = $time->addMinutes($boss[$list[$name]] * $pass)
//                        ->format('m/d H:i:s');
//                }
                Artisan::call('boss:kill', $options);
                $maps    = implode(', ', $bossMaps[$list[$name]]);
                $message = '點我看更多' . url('/') . $this->breakLine;
                $message .= sprintf('已紀錄 %s 時間 %s', $info[1], $this->breakLine);
                $message .= sprintf('地圖：%s %s', $maps, $this->breakLine);
                $message .= sprintf('死亡時間 %s %s', $killTime, $this->breakLine);
//                if ($pass === 0) {
                    $message .= sprintf('下次出現 %s', $nextTime);
//                } else {
//                    $message .= sprintf('下次出現 [過%s] %s', $pass, $nextTime);
//                }

                $this->bot->replyText($replyToken, $message);

                break;
            case ($text === 'clear' || $text === '重置王表') :
                Artisan::call('boss:clear', [
                    '--groupId' => $groupId,
                ]);
                $this->bot->replyText($replyToken, '已清除王表');

                break;

        }
    }

    private function wawa($text, $replyToken)
    {
        //        if (strtolower($text) == '抽娃娃') {
        //            $this->bot->replyMessage($replyToken, new ImageMessageBuilder('https://game.bixone.com/ha.jpg', 'https://game.bixone.com/ha.jpg'));
        //        }
    }

    private function boy($text, $replyToken)
    {
        $rand     = rand(1, 20);
        $url      = url("jason/{$rand}.jpg");
        $keywords = ['抽白痴', '抽笨蛋', '抽醜男', '抽猛男', '抽帥哥'];
        if (in_array($text, $keywords)) {
            //            $this->bot->replyMessage($replyToken, new ImageMessageBuilder($url, $url));
        }
    }

    private function lds($text, $replyToken)
    {
        //        if (strtolower($text) == 'jason') {
        //            $this->bot->replyText($replyToken, 'jason死娘砲');
        //        }
        //        if (strtolower($text) == '513') {
        //            $this->bot->replyText($replyToken, '彰化最清純');
        //        }
        //        if (strtolower($text) == '韓粉') {
        //            $this->bot->replyText($replyToken, '韓粉好棒棒');
        //        }
        //        if (strtolower($text) == '樂樂') {
        //            $this->bot->replyText($replyToken, '莫再提');
        //        }
        //        if (strtolower($text) == '修') {
        //            $this->bot->replyText($replyToken, '修幹拉');
        //        }
        //        if (strtolower($text) == '登輝') {
        //            $this->bot->replyText($replyToken, '地方媽媽救星');
        //        }
        //        if (strtolower($text) == '牛佬') {
        //            $this->bot->replyText($replyToken, '使用者請付費');
        //        }
        //        if (strtolower($text) == '賣鑽') {
        //            $this->bot->replyText($replyToken, '1:1.7');
        //        }
        //        if (strtolower($text) == '米蘭') {
        //            $this->bot->replyText($replyToken, '無敵87玩家');
        //        }
        //        if (strtolower($text) == '山豬') {
        //            $this->bot->replyText($replyToken, '大肌肌');
        //        }
        //        if (strtolower($text) == '愛貓') {
        //            $this->bot->replyText($replyToken, '大咪咪');
        //        }
        //        if (strtolower($text) == '蹤影') {
        //            $this->bot->replyText($replyToken, '無敵邊緣人');
        //        }
        //        if (strtolower($text) == '咖啡') {
        //            $this->bot->replyText($replyToken, '別回收了');
        //        }
        //        if (strtolower($text) == '蔡小蓁') {
        //            $this->bot->replyText($replyToken, 'ＢＯＳＳ今晚睡不睡呢');
        //        }
        //        if (strtolower($text) == '館長') {
        //            $this->bot->replyText($replyToken, '長肉不長腦');
        //        }
        //        if (strtolower($text) == '彭新福' || strtolower($text) == '彭') {
        //            $this->bot->replyText($replyToken, '我要去洗澡了');
        //        }
    }

    private function help($text, $replyToken)
    {

    }

    private function tagAll($text, $replyToken)
    {
        if (strtolower($text) == '標註') {
            $this->bot->replyText($replyToken, '@莊小玲 qqqq');
        }
    }
}
