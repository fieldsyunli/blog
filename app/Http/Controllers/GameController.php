<?php

namespace App\Http\Controllers;


use App\Model\GameRecordModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{

    private $player = [
        1 => '斗战胜佛',
        2 => '白银时代',
        3 => '见习',
        4 => 'pikalu',
    ];

    private $prefixUrl = 'http://47.97.194.118:8080/lol/api/v1/';

    public function createRecord(Request $request)
    {
        $postUrl = route('gameStoreRecord');
        $today = Carbon::today()->toDateString();
        $player = $this->player;
        $data = compact('postUrl', 'today', 'player');
        return view('game.create_record', $data);
    }

    public function storeRecord(Request $request)
    {
        $postData = $request->all();
        $url = $this->prefixUrl . 'game/save';
        $res = $this->httpPost($url, $postData);
        $this->jsonMsg(['code' => $res['status'], 'msg' => $res['message']]);
    }

    public function recordList(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $date = $request->get('date', $today);
        $date = date('Y-m-d', strtotime($date));
        $url = $this->prefixUrl . 'mvp/result';
        $postData = [
            'date' => $date
        ];
        $res = $this->httpPost($url, $postData);
        $list = [];
        if (!empty($res) && $res['status'] == 200) {
            $list = $res['content'];
        }
        $player = $this->player;
        $data = compact('list', 'player', 'date');
        return view('game.record_list', $data);
    }


    private function jsonMsg($data)
    {
        echo json_encode($data);
        exit;
    }


    /**
     * post请求接口
     * @param string $url 请求地址
     * @param array $postData 提交参数
     * @return mixed
     */
    protected function httpPost($url, $postData = [])
    {
        $postData = json_encode($postData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($postData)
            )
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

    /**
     * 请求接口
     * @param string $url
     * @return mixed
     * @user yun.li
     * @time 2018/10/8 下午5:20
     */
    protected function httpGet($url = '')
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FAILONERROR, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            //https 请求
            if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            }
            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            return $result;
        } catch (\Exception $e) {
            $errorLog = [
                'msg' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => [
                    'url' => $url,
                ]
            ];
            echo '<pre>';
            print_r($errorLog);
            return null;
        }
    }

}
