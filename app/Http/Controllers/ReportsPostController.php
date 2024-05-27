<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\reportsPost;

class ReportsPostController extends Controller
{
    //画面を開いた時に呼び出されるコントローラー
    public function index()
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 今週提出された週報を取得する
        $reportsPost = reportsPost::where([
            ['name', '=', $user->name],
            ['name_id', '=', $user->id],
            ['key_number', '=', $this->get_key_number()]
        ])->first();

        // 未提出の場合先週のレポートを表示させる
        $lastReports = reportsPost::where([
            ['name', '=', $user->name],
            ['name_id', '=', $user->id],
            ['key_number', '=', $this->get_key_number() - 1]
        ])->first();

        // 今日の日付をフォーマットして値を返却する
        $today = Carbon::today()->format('Y年m月d日');
        $key_number = $this->get_key_number();
        return view('reportsPost', compact('user', 'today', 'reportsPost', 'key_number', 'lastReports'));
    }


    //週報提出のボタンが押されてからの処理
    public function entry(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required'],
                'name_id' => ['required'],
                'post' => ['required'],
                'first_day' => ['required'],
                'last_day' => ['required'],
            ],
            [
                'name.required' => '投稿者は必須です。',
                'name_id.required' => '投稿者IDは必須です。',
                'post.required' => '作業内容は必須です。',
                'first_day.required' => '業務期間1は必須です。',
                'last_day.required' => '業務期間2は必須です。',
            ]
        );

        $reports_post_data = new reportsPost();
        $reports_post_data->name_id = $request->name_id; // 投稿者ID
        $reports_post_data->name = $request->name; // 投稿者
        $reports_post_data->key_number = $request->key_number; // キー番号
        $reports_post_data->post = $request->post; // 投稿
        $reports_post_data->concern = $request->concern; // 懸念点
        $reports_post_data->schedule = $request->schedule; // 来週の予定
        $reports_post_data->reporting_date = $request->reporting_date; // 報告日
        $reports_post_data->work_day1 = $request->work_day1; // 出勤日1
        $reports_post_data->start_time1 = $request->start_time1; // 出社時刻1
        $reports_post_data->end_time1 = $request->end_time1; // 退社時刻1
        $reports_post_data->work_day2 = $request->work_day2; // 出勤日2
        $reports_post_data->start_time2 = $request->start_time2; // 出社時刻2
        $reports_post_data->end_time2 = $request->end_time2; // 退社時刻2
        $reports_post_data->work_day3 = $request->work_day3; // 出勤日3
        $reports_post_data->start_time3 = $request->start_time3; // 出社時刻3
        $reports_post_data->end_time3 = $request->end_time3; // 退社時刻3
        $reports_post_data->work_day4 = $request->work_day4; // 出勤日4
        $reports_post_data->start_time4 = $request->start_time4; // 出社時刻4
        $reports_post_data->end_time4 = $request->end_time4; // 退社時刻4
        $reports_post_data->work_day5 = $request->work_day5; // 出勤日5
        $reports_post_data->start_time5 = $request->start_time5; // 出社時刻5
        $reports_post_data->end_time5 = $request->end_time5; // 退社時刻5
        $reports_post_data->first_day = $request->first_day; // 作業期間1
        $reports_post_data->last_day = $request->last_day; // 作業期間2

        $reports_post_data->save();

        return redirect()->route('home')->with('success', '・週報の提出が完了しました');
    }

    //更新ボタンが押されてからの処理
    public function edit(Request $request)
    {
        $validated = $request->validate(
            [
                'post' => ['required'],
                'first_day' => ['required'],
                'last_day' => ['required'],
            ],
            [
                'post.required' => '作業内容は必須です。',
                'first_day.required' => '業務期間1は必須です。',
                'last_day.required' => '業務期間2は必須です。',
            ]
        );

        reportsPost::where('name_id', $request->name_id)
            ->where('name', $request->name)
            ->where('key_number', $request->key_number)
            ->update([
                'post' => $request->post, // 投稿
                'concern' => $request->concern, // 懸念点
                'schedule' => $request->schedule, // 来週の予定
                'reporting_date' => $request->reporting_date, // 報告日
                'work_day1' => $request->work_day1, // 出勤日1
                'start_time1' => $request->start_time1, // 出社時刻1
                'end_time1' => $request->end_time1, // 退社時刻1
                'work_day2' => $request->work_day2, // 出勤日2
                'start_time2' => $request->start_time2, // 出社時刻2
                'end_time2' => $request->end_time2, // 退社時刻2
                'work_day3' => $request->work_day3, // 出勤日3
                'start_time3' => $request->start_time3, // 出社時刻3
                'end_time3' => $request->end_time3, // 退社時刻3
                'work_day4' => $request->work_day4, // 出勤日4
                'start_time4' => $request->start_time4, // 出社時刻4
                'end_time4' => $request->end_time4, // 退社時刻4
                'work_day5' => $request->work_day5, // 出勤日5
                'start_time5' => $request->start_time5, // 出社時刻5
                'end_time5' => $request->end_time5, // 退社時刻5
                'first_day' => $request->first_day, // 作業期間1
                'last_day' => $request->last_day, // 作業期間2
            ]);

        return redirect()->route('home')->with('success', '・週報を更新しました');;
    }

    // キー番号を返す関数
    public function get_key_number()
    {
        $datetime = Carbon::now();
        $year = $datetime->format('Y');
        $weekNumber = $datetime->format('W');
        return $year . $weekNumber;
    }
}
