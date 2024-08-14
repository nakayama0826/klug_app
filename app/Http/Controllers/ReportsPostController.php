<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\reportsPost;
use DateTime;

class ReportsPostController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
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

        $newPost = empty($reportsPost);

        // 編集時と登録時で表示する値を変更する
        if($newPost){
            $today = Carbon::now()->setTimezone('Asia/Tokyo')->format('Y年m月d日 H時i分');
        } else {
            $dateTime = new DateTime($reportsPost->reporting_time);
            // フォーマットの変換 YYYY/MM/DD HH:II
            $today = $dateTime->format('Y年m月d日H時i分');
        }

        $key_number = $this->get_key_number();

        return response()->json([
            'user' => $user,
            'today' => $today,
            'reportsPost' => $reportsPost,
            'key_number' => $key_number,
            'lastReports' => $lastReports,
            'newPost' => $newPost
        ]);
    }

    //週報提出のボタンが押されてからの処理
    public function entry(Request $request)
    {
        $reports_post_data = new reportsPost();
        $reports_post_data->name_id = $request->input('name_id'); // 投稿者ID
        $reports_post_data->name = $request->input('name'); // 投稿者
        $reports_post_data->key_number = $request->input('key_number'); // キー番号
        $reports_post_data->post = $request->input('post'); // 投稿
        $reports_post_data->concern = $request->input('concern'); // 懸念点
        $reports_post_data->schedule = $request->input('schedule'); // 来週の予定
        $reports_post_data->reporting_date = Carbon::now()->setTimezone('Asia/Tokyo'); // 報告日
        $reports_post_data->work_day1 = $request->input('work_day1'); // 出勤日1
        $reports_post_data->start_time1 = $request->input('start_time1'); // 出社時刻1
        $reports_post_data->end_time1 = $request->input('end_time1'); // 退社時刻1
        $reports_post_data->work_day2 = $request->input('work_day2'); // 出勤日2
        $reports_post_data->start_time2 = $request->input('start_time2'); // 出社時刻2
        $reports_post_data->end_time2 = $request->input('end_time2'); // 退社時刻2
        $reports_post_data->work_day3 = $request->input('work_day3'); // 出勤日3
        $reports_post_data->start_time3 = $request->input('start_time3'); // 出社時刻3
        $reports_post_data->end_time3 = $request->input('end_time3'); // 退社時刻3
        $reports_post_data->work_day4 = $request->input('work_day4'); // 出勤日4
        $reports_post_data->start_time4 = $request->input('start_time4'); // 出社時刻4
        $reports_post_data->end_time4 = $request->input('end_time4'); // 退社時刻4
        $reports_post_data->work_day5 = $request->input('work_day5'); // 出勤日5
        $reports_post_data->start_time5 = $request->input('start_time5'); // 出社時刻5
        $reports_post_data->end_time5 = $request->input('end_time5'); // 退社時刻5
        $reports_post_data->work_day6 = $request->input('work_day6'); // 出勤日6
        $reports_post_data->start_time6 = $request->input('start_time6'); // 出社時刻6
        $reports_post_data->end_time6 = $request->input('end_time6'); // 退社時刻6
        $reports_post_data->work_day7 = $request->input('work_day7'); // 出勤日7
        $reports_post_data->start_time7 = $request->input('start_time7'); // 出社時刻7
        $reports_post_data->end_time7 = $request->input('end_time7'); // 退社時刻7
        $reports_post_data->first_day = $request->input('first_day'); // 作業期間1
        $reports_post_data->last_day = $request->input('last_day'); // 作業期間2
        
        // 追加カラム
        $reports_post_data->work_style1 = $request->input('work_style1'); // 作業形態1
        $reports_post_data->work_style2 = $request->input('work_style2'); // 作業形態2
        $reports_post_data->work_style3 = $request->input('work_style3'); // 作業形態3
        $reports_post_data->work_style4 = $request->input('work_style4'); // 作業形態4
        $reports_post_data->work_style5 = $request->input('work_style5'); // 作業形態5
        $reports_post_data->work_style6 = $request->input('work_style6'); // 作業形態6
        $reports_post_data->work_style7 = $request->input('work_style7'); // 作業形態7
    
        $reports_post_data->reporting_time = Carbon::now()->setTimezone('Asia/Tokyo'); // 報告時間

        $reports_post_data->save();

        return response()->json(['message' => 'Data processed successfully'], 200);
    }

    //更新ボタンが押されてからの処理
    public function edit(Request $request)
    {
        reportsPost::where('name_id', $request->input('name_id'))
            ->where('name', $request->input('name'))
            ->where('key_number', $request->input('key_number'))
            ->update([
                'post' => $request->input('post'), // 投稿
                'concern' => $request->input('concern'), // 懸念点
                'schedule' => $request->input('schedule'), // 来週の予定
                'reporting_date' => Carbon::now()->setTimezone('Asia/Tokyo'), // 報告日
                'work_day1' => $request->input('work_day1'), // 出勤日1
                'start_time1' => $request->input('start_time1'), // 出社時刻1
                'end_time1' => $request->input('end_time1'), // 退社時刻1
                'work_day2' => $request->input('work_day2'), // 出勤日2
                'start_time2' => $request->input('start_time2'), // 出社時刻2
                'end_time2' => $request->input('end_time2'), // 退社時刻2
                'work_day3' => $request->input('work_day3'), // 出勤日3
                'start_time3' => $request->input('start_time3'), // 出社時刻3
                'end_time3' => $request->input('end_time3'), // 退社時刻3
                'work_day4' => $request->input('work_day4'), // 出勤日4
                'start_time4' => $request->input('start_time4'), // 出社時刻4
                'end_time4' => $request->input('end_time4'), // 退社時刻4
                'work_day5' => $request->input('work_day5'), // 出勤日5
                'start_time5' => $request->input('start_time5'), // 出社時刻5
                'end_time5' => $request->input('end_time5'), // 退社時刻5
                'work_day6' => $request->input('work_day6'), // 出勤日6
                'start_time6' => $request->input('start_time6'), // 出社時刻6
                'end_time6' => $request->input('end_time6'), // 退社時刻6
                'work_day7' => $request->input('work_day7'), // 出勤日7
                'start_time7' => $request->input('start_time7'), // 出社時刻7
                'end_time7' => $request->input('end_time7'), // 退社時刻7
                'first_day' => $request->input('first_day'), // 作業期間1
                'last_day' => $request->input('last_day'), // 作業期間2
                
                // 追加カラム
                'work_style1' => $request->input('work_style1'), // 労働形態1
                'work_style2' => $request->input('work_style2'), // 労働形態2
                'work_style3' => $request->input('work_style3'), // 労働形態3
                'work_style4' => $request->input('work_style4'), // 労働形態4
                'work_style5' => $request->input('work_style5'), // 労働形態5
                'work_style6' => $request->input('work_style6'), // 労働形態6
                'work_style7' => $request->input('work_style7'), // 労働形態7
            ]);

        return response()->json(['message' => 'Data processed successfully'], 200);
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
