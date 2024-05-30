<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\reportsPost;

class ReportsCheckController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        // ユーザー情報の取得
        $user = Auth::user();
        $datetime = Carbon::now();
        // 今年の値を取得する（例）2024
        $year = $datetime->format('Y');
        // 今月の値を取得する（例）05
        $month = $datetime->format('m');
        // 初期設定の値として今年度と今月の値を取得して出力
        $weekly_reports = DB::table('weekly_reports')
            ->where('name', $user->name)
            ->where('name_id', $user->id)
            ->where(DB::raw('SUBSTRING(reporting_date, 1, 4)'), '=', $year)
            ->where(DB::raw('SUBSTRING(reporting_date, 6, 2)'), '=', $month)
            ->orderBy('key_number', 'desc')->get();

        // 先週分の週報が提出されているか否かをチェックする
        $check = $this->get_befor_key_number($user->name, $user->id);
        // キー番号の取得
        $key_number = $this->get_key_number();
        // データが0件だった時に表示するメッセージ
        $msg = $weekly_reports->isEmpty() ? '・データが見つかりませんでした' : '';

        return view('reportsCheck', compact('weekly_reports', 'key_number', 'check', 'year', 'month', 'msg'));
    }

    // ヘッダーの入力項目で検索する処理
    public function search(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();
        $datetime = Carbon::now();
        // 入力された値を設定する（例）2024
        $year = $request->year_input;
        // 入力された値を設定する（例）06
        $month = $request->month_input;

        // フォームに入力された値で検索
        $weekly_reports = DB::table('weekly_reports')
            ->where('name', $user->name)
            ->where('name_id', $user->id)
            ->when(!empty($year), function ($query) use ($year) {
                return $query->where(DB::raw('SUBSTRING(reporting_date, 1, 4)'), '=', $year);
            })
            ->when(!empty($month), function ($query) use ($month) {
                return $query->where(DB::raw('SUBSTRING(reporting_date, 6, 2)'), '=', $month);
            })
            ->orderBy('key_number', 'desc')->get();

        // 先週分の週報が提出されているか否かをチェックする
        $check = $this->get_befor_key_number($user->name, $user->id);
        // キー番号の取得
        $key_number = $this->get_key_number();

        // データが0件だった時に表示するメッセージ
        $msg = $weekly_reports->isEmpty() ? '・データが見つかりませんでした' : '';

        return view('reportsCheck', compact('weekly_reports', 'key_number', 'check', 'year', 'month', 'msg'));
    }

    // 週報を編集する
    public function edit(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();
        // 週報確認画面から取得してきたキー番号
        if (empty($request->key_number)) {
            // 未提出の投稿を提出ボタンから渡ってきた場合はここを通る
            $key_number = $this->get_key_number() - 1;
        } else {
            $key_number = $request->key_number;
        }

        // 週報確認で選択された週報を取得する
        $reportsPost = reportsPost::where([
            ['name', '=', $user->name],
            ['name_id', '=', $user->id],
            ['key_number', '=', $request->key_number]
        ])->first();

        // 今日の日付をフォーマットして値を返却する
        $today = Carbon::today()->format('Y年m月d日');

        return view('reportsPost', compact('user', 'today', 'reportsPost', 'key_number'));
    }

    // 週報を確認する
    public function comfirmPost(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 週報確認で選択された週報を取得する
        $reportsPost = reportsPost::where([
            ['name', '=', $user->name],
            ['name_id', '=', $user->id],
            ['key_number', '=', $request->key_number]
        ])->first();

        return view('comfirmPost', compact('reportsPost'));
    }

    // キー番号を返す関数　YYYY＋週番号
    public function get_key_number()
    {
        $datetime = Carbon::now();
        $year = $datetime->format('Y');
        $weekNumber = $datetime->format('W');
        return $year . $weekNumber;
    }

    // 先週の週報が提出されているか確認する
    public function get_befor_key_number($name, $name_id)
    {
        $check = DB::table('weekly_reports')
            ->where('name', $name)
            ->where('name_id', $name_id)
            ->where('key_number', $this->get_key_number() - 1)
            ->exists();
        return $check;
    }
}
