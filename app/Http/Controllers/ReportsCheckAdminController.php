<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\reportsPost;
use DateTime;

class reportsCheckAdminController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        // ユーザー情報の取得
        $user = Auth::user();
        // name
        $name = "";
        // year
        $year = "";
        // month
        $month = "";
        // inputCheck
        $inputCheck = true;
        // 初期設定の値として今年度と今月の値を取得して出力
        $weekly_reports = DB::table('weekly_reports')
            ->where(function ($query) {
                $query->where('key_number', '=', $this->get_key_number())
                    ->orWhere('key_number', '=', $this->get_key_number() - 1);
            })
            ->orderBy('key_number', 'desc')->get();

        // 先週分の週報が提出されているか否かをチェックする
        $check = $this->check_befor_key_number($user->name, $user->id);
        // キー番号の取得
        $key_number = $this->get_key_number();
        // データが0件だった時に表示するメッセージ
        $msg = $weekly_reports->isEmpty() ? '・データが見つかりませんでした' : '';

        return response()->json([
            'weekly_reports' => $weekly_reports,
            'key_number' => $key_number,
            'check' => $check,
            'name' => $name,
            'year' => $year,
            'month' => $month,
            'msg' => $msg,
            'inputCheck' => $inputCheck,
        ]);
    }

    // ヘッダーの入力項目で検索する処理
    public function search(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();
        // 入力された名前で検索
        $name = $request->input('name');
        // 入力された値を設定する（例）2024
        $year = $request->input('year_input');
        // 入力された値を設定する（例）06
        $month = $request->input('month_input');
        // inputのチェック状態
        $inputCheck = $request->input('last_week');

        // フォームに入力された値で検索
        $weekly_reports = DB::table('weekly_reports')
            // 名前が入力されていれば検索をかける
            ->when(!empty($name), function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            // 年（YYYY）が入力されていれば検索をかける
            ->when(!empty($year), function ($query) use ($year) {
                return $query->where(DB::raw('SUBSTRING(reporting_date, 1, 4)'), '=', $year);
            })
            // 月（MM）が入力されていれば検索をかける
            ->when(!empty($month), function ($query) use ($month) {
                return $query->where(DB::raw('SUBSTRING(reporting_date, 6, 2)'), '=', $month);
            })
            // チェックが入れられたら先週分までの情報を取得する
            ->when($request->input('last_week'), function ($query) {
                return $query->where(function ($query) {
                    $query->where('key_number', '=', $this->get_key_number())
                        ->orWhere('key_number', '=', $this->get_key_number() - 1);
                });
            })
            ->orderBy('key_number', 'desc')->get();

        // キー番号の取得
        $key_number = $this->get_key_number();

        // データが0件だった時に表示するメッセージ
        $msg = $weekly_reports->isEmpty() ? '・データが見つかりませんでした' : '';

        // return view('reportsCheckAdmin', compact('weekly_reports', 'key_number', 'name', 'year', 'month', 'msg', 'inputCheck'));
        return response()->json([
            'weekly_reports' => $weekly_reports,
            'key_number' => $key_number,
            'name' => $name,
            'year' => $year,
            'month' => $month,
            'msg' => $msg,
            'inputCheck' => $inputCheck,
        ]);
    }

    // 週報を確認する
    public function comfirmPost(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 週報確認で選択された週報を取得する
        $reportsPost = reportsPost::where([
            ['name', '=', $request->input('name')],
            ['name_id', '=', $request->input('id')],
            ['key_number', '=', $request->input('key_number')]
        ])->first();

        $dateTime = new DateTime($reportsPost->reporting_time);
        // フォーマットの変換 YYYY/MM/DD HH:II
        $today = $dateTime->format('Y年m月d日H時i分');

        // 普通のユーザーと共通のbaldeへと返す
        return response()->json([
            'reportsPost' => $reportsPost,
            'today' => $today,
        ]);
    }


    // キー番号を返す関数　YYYY＋週番号
    public function get_key_number()
    {
        $datetime = Carbon::now();
        $year = $datetime->format('Y');
        $weekNumber = $datetime->format('W');
        // 年と週番号を結合する
        return $year . $weekNumber;
    }

    // 先週の週報が提出されているか確認する
    public function check_befor_key_number($name, $name_id)
    {
        $check = DB::table('weekly_reports')
            ->where('name', $name)
            ->where('name_id', $name_id)
            ->where('key_number', $this->get_key_number() - 1)
            ->exists();
        return $check;
    }
}
