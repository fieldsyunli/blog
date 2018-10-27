<?php

namespace App\Http\Controllers;


use App\Model\GameRecordModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{

    private $player = [
        1 => '阿斗',
        2 => '白眼时代',
        3 => '见习',
        4 => 'pikalu',
    ];

    public function createRecord(Request $request)
    {
        $postUrl = route('gameStoreRecord');
        $today = Carbon::today()->toDateString();
        $data = compact('postUrl', 'today');
        return view('game.create_record', $data);
    }

    public function storeRecord(Request $request)
    {
        $postData = $request->all();
        $addData = [];
        foreach ($postData['kill_data'] as $key => $val) {
            $addData[] = [
                'date' => $postData['date'],
                'player' => $postData['person'],
                'kill' => $val,
                'death' => $postData['death_data'][$key],
                'assists' => $postData['assists_data'][$key],
                'out_put_damage' => $postData['out_put_damage_data'][$key],
                'accept_damage' => $postData['accept_damage_data'][$key],
            ];
        }
        GameRecordModel::insert($addData);
        $this->jsonMsg(['code' => 200, 'msg' => 'success']);
    }

    public function recordList(Request $request)
    {
        $list = GameRecordModel::get();
        $player = $this->player;
        $data = compact('list', 'player');
        return view('game.record_list', $data);
    }


    private function jsonMsg($data)
    {
        echo json_encode($data);
        exit;
    }

}
