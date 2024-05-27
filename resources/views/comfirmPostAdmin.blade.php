@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsPost.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; color:rgb(17, 132, 255)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(17, 132, 255)"></i>
@endsection

@section('second_header')
    <div class="text-center text-white bg-primary h4 py-2">
        <i class="fa-solid fa-file" style="font-size: 70%;"></i>
        週報確認
    </div>
@endsection

@section('contents')
    <div class="post_container pt-0">
        <div class="form_info">
            <div class="h6">報告日：{{ $reportsPost->reporting_date }}</div>
            <div class="h6">報告者：{{ $reportsPost->name }}</div>
        </div>

        <table>
            <tr>
                <td><label class="badge badge-danger">必須</label>業務期間</td>
            </tr>
            <tr>
                <td><input id="first_day" type="date" class="border_input" name="first_day"
                        value="{{ $reportsPost->first_day }}" disabled></td>
                <td>～</td>
                <td><input id="last_day" type="date" class="border_input" name="last_day"
                        value="{{ $reportsPost->last_day }}" disabled></td>
            </tr>
            <tr>
                <td><label class="badge badge-danger">必須</label>業務内容</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="border_textarea_post" name="post" disabled>{{ $reportsPost->post }}</textarea>
                </td>
            </tr>
            <tr>
                <td>懸念点</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="border_textarea" name="concern" disabled>{{ $reportsPost->concern }}</textarea>
                </td>
            </tr>
            <tr>
                <td>来週の予定・備考</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="border_textarea" name="schedule" disabled>{{ $reportsPost->schedule }}</textarea>
                </td>
            </tr>
            <tr>
                <td>今週の作業時間</td>
            </tr>
        </table>
        <div class="row pb-2">
            <div class="col-5"><input id="work_day1" type="date" name="work_day1" value="{{ $reportsPost->work_day1 }}" disabled>
            </div>
            <div class="col-3"><input type="time" name="start_time1" value="{{ $reportsPost->start_time1 }}" disabled></div>
            <div class="col-3"><input type="time" name="end_time1" value="{{ $reportsPost->end_time1 }}" disabled>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input id="work_day2" type="date" name="work_day2"
                    value="{{ $reportsPost->work_day2 }}" disabled></div>
            <div class="col-3"><input type="time" name="start_time2" value="{{ $reportsPost->start_time2 }}" disabled></div>
            <div class="col-3"><input type="time" name="end_time2" value="{{ $reportsPost->end_time2 }}" disabled>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input id="work_day3" type="date" name="work_day3"
                    value="{{ $reportsPost->work_day3 }}" disabled></div>
            <div class="col-3"><input type="time" name="start_time3" value="{{ $reportsPost->start_time3 }}" disabled></div>
            <div class="col-3"><input type="time" name="end_time3" value="{{ $reportsPost->end_time3 }}" disabled>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input id="work_day4" type="date" name="work_day4"
                    value="{{ $reportsPost->work_day4 }}" disabled></div>
            <div class="col-3"><input type="time" name="start_time4" value="{{ $reportsPost->start_time4 }}" disabled></div>
            <div class="col-3"><input type="time" name="end_time4" value="{{ $reportsPost->end_time4 }}" disabled>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input id="work_day5" type="date" name="work_day5"
                    value="{{ $reportsPost->work_day5 }}" disabled></div>
            <div class="col-3"><input type="time" name="start_time5" value="{{ $reportsPost->start_time5 }}" disabled></div>
            <div class="col-3"><input type="time" name="end_time5" value="{{ $reportsPost->end_time5 }}" disabled>
            </div>
        </div>
        <button class="btn btn-primary buttonW" onclick="history.back()">戻る</button>
    @endsection
