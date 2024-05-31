<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\reportsPost;

class DataDeleteController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        // ユーザー情報を取得
        $user = Auth::user();

        // msg
        $msg = '';

        return view('dataDelete', compact('msg'));
    }

    // 削除ボタンが押されてからの処理
    public function delete(Request $request)
    {
        // バリデーション
        $request->validate([
            'year_input_from' => 'required|digits:4',
            'month_input_from' => 'required|digits:2',
            'year_input_to' => 'required|digits:4',
            'month_input_to' => 'required|digits:2',
        ]);

        // 入力されたデータを取得
        $yearFrom = $request->input('year_input_from');
        $monthFrom = $request->input('month_input_from');
        $yearTo = $request->input('year_input_to');
        $monthTo = $request->input('month_input_to');

        // 範囲の開始日と終了日を設定
        $dateFrom = Carbon::createFromDate($yearFrom, $monthFrom, 1)->startOfMonth();
        $dateTo = Carbon::createFromDate($yearTo, $monthTo, 1)->endOfMonth();

        // 指定された範囲の日付を持つレコードを削除
        $deleted = reportsPost::whereBetween('reporting_date', [$dateFrom, $dateTo])->delete();

        // msg
        $msg = $deleted ?  $deleted .'件削除されました' : '対象のレポートが見つかりませんでした';

        return view('dataDelete', compact('msg'));
    }
}
