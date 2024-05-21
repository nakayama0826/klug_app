@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsPost.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; color:rgb(106, 184, 99)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(106, 184, 99)"></i>
@endsection

@section('second_header')
    <div class="text-center page_title h4 py-2">
        <i class="fa-solid fa-home" style="font-size: 70%;"></i>
        週報提出
    </div>
@endsection

@section('contents')
    <div class="post_container pt-0">
	<div class="form_info">
		<div>報告日：2024/08/26</div>
		<div>報告者：幹太</div>
	</div>
        <table>
            <tr>
                <td>業務期間</td>
            </tr>
            <tr>
                <td><input type="date" class="border_input"></td>
                <td>～</td>
                <td><input type="date" class="border_input"></td>
            </tr>
            <tr>
                <td>業務内容</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="border_textarea_post"></textarea>
                </td>
            </tr>
            <tr>
                <td>懸念点</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="border_textarea"></textarea>
                </td>
            </tr>
            <tr>
                <td>来週の予定・備考</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="border_textarea"></textarea>
                </td>
            </tr>
            <tr>
                <td>今週の作業時間</td>
            </tr>
        </table>

        <div class="row pb-2">
            <div class="col-5"><input type="date"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input type="date"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input type="date"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input type="date"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
        </div>
        <div class="row pb-2">
            <div class="col-5"><input type="date"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
            <div class="col-3"><input type="time"></textarea></div>
        </div>
	<div>
		<button type="button" class="btn btn-success mt-2 buttonW"
                onclick="location.href='http://localhost/klug_app/public/reportsCheckAdmin'">提出</button>
	</div>
    </div>
@endsection
