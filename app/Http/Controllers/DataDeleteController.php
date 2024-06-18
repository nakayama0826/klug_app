<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\reportsPost;

class DataDeleteController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index(Request $request)
    {
        return response()->json([
            'sYear' => '',
            'sMonth' => '',
            'eYear' => '',
            'eMonth' => '',
            'msg' => '',
        ]);
    }

    // 削除ボタンが押されてからの処理
    public function delete(Request $request)
    {
        // 入力されたデータを取得
        $sYear = $request->input('sYear');
        $sMonth = $request->input('sMonth');
        $eYear = $request->input('eYear');
        $eMonth = $request->input('eMonth');

        // 範囲の開始日と終了日を設定
        $dateFrom = Carbon::createFromDate($sYear, $sMonth, 1)->startOfMonth();
        $dateTo = Carbon::createFromDate($eYear, $eMonth, 1)->endOfMonth();

        // 指定された範囲の日付を持つレコードを削除
        $deleted = reportsPost::whereBetween('reporting_date', [$dateFrom, $dateTo])->delete();

        // msg
        $msg = $deleted ?  '・週報が'. $deleted .'件削除されました' : '・対象範囲の週報が見つかりませんでした';

        return response()->json([
            'sYear' => $sYear,
            'sMonth' => $sMonth,
            'eYear' => $eYear,
            'eMonth' => $eMonth,
            'msg' => $msg,
        ]);
        
    }
}
