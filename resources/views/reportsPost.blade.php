@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsPost.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step"
        style="font-size: 140%; width:21.6px; color: {{ empty($reportsPost) ? '#198754' : '#ffc107' }}"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis"
        style="font-size: 140%; color: {{ empty($reportsPost) ? '#198754' : '#ffc107' }}"></i>
@endsection

@section('second_header')
    <div class="text-center text-white {{ empty($reportsPost) ? 'bg-success' : 'bg-warning' }} h4 py-2">
        <i class="fa-solid fa-file" style="font-size: 70%;"></i>
        週報提出{{ empty($reportsPost) ? '' : '(編集)' }}
    </div>
@endsection

@section('contents')
    {{-- バリデーションエラーを出力するためのエリア --}}
    @if ($errors->any())
        <div>
            <ul class="border border-danger border-pill text-danger">
                @foreach ($errors->all() as $error)
                    <li>・{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="post_container pt-0">
        <div class="form_info">
            <div class="h6">報告日：{{ $today }}</div>
            <div class="h6">報告者：{{ $user->name }}</div>
        </div>

        <form action="{{ empty($reportsPost) ? route('reportsPost.entry') : route('reportsPost.edit') }}" method="POST">
            <table>
                @csrf
                <tr>
                    <td><label class="badge badge-danger">必須</label>業務期間</td>
                </tr>
                <tr>
                    {{-- 提出済みか否かで分岐をする --}}
                    @if (empty($reportsPost))
                        <td><input id="first_day" type="date" class="border_input" name="first_day"
                                value="{{ old('first_day') }}"></td>
                        <td>～</td>
                        <td><input id="last_day" type="date" class="border_input" name="last_day"
                                value="{{ old('last_day') }}"></td>
                    @else
                        <td><input id="first_day" type="date" class="border_input" name="first_day"
                                value="{{ $reportsPost->first_day }}"></td>
                        <td>～</td>
                        <td><input id="last_day" type="date" class="border_input" name="last_day"
                                value="{{ $reportsPost->last_day }}"></td>
                    @endif
                </tr>
                <tr>
                    <td><label class="badge badge-danger">必須</label>業務内容</td>
                </tr>
                <tr>
                    <td colspan="3">
                        {{-- 提出済みか否かで分岐をする --}}
                        @if (empty($reportsPost))
                            <textarea class="border_textarea_post" name="post">{{ old('post', empty($lastReports) ? '' : $lastReports->post) }}</textarea>
                        @else
                            <textarea class="border_textarea_post" name="post">{{ $reportsPost->post }}</textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>懸念点</td>
                </tr>
                <tr>
                    <td colspan="3">
                        {{-- 提出済みか否かで分岐をする --}}
                        @if (empty($reportsPost))
                            <textarea class="border_textarea" name="concern">{{ old('concern', empty($lastReports) ? '' : $lastReports->concern) }}</textarea>
                        @else
                            <textarea class="border_textarea" name="concern">{{ $reportsPost->concern }}</textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>来週の予定・備考</td>
                </tr>
                <tr>
                    <td colspan="3">
                        {{-- 提出済みか否かで分岐をする --}}
                        @if (empty($reportsPost))
                            <textarea class="border_textarea" name="schedule">{{ old('schedule', empty($lastReports) ? '' : $lastReports->schedule) }}</textarea>
                        @else
                            <textarea class="border_textarea" name="schedule">{{ $reportsPost->schedule }}</textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>今週の作業時間</td>
                </tr>
            </table>

            {{-- 提出済みか否かで分岐をする --}}
            @if (empty($reportsPost))
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day1" type="date" name="work_day1"
                            value="{{ old('work_day1') }}"></div>
                    <div class="col-3"><input type="time" name="start_time1"
                            value="{{ old('start_time1', empty($lastReports) ? '' : $lastReports->start_time1) }}">
                    </div>
                    <div class="col-3"><input type="time" name="end_time1"
                            value="{{ old('end_time1', empty($lastReports) ? '' : $lastReports->end_time1) }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day2" type="date" name="work_day2"
                            value="{{ old('work_day2') }}"></div>
                    <div class="col-3"><input type="time" name="start_time2"
                            value="{{ old('start_time2', empty($lastReports) ? '' : $lastReports->start_time2) }}">
                    </div>
                    <div class="col-3"><input type="time" name="end_time2"
                            value="{{ old('end_time2', empty($lastReports) ? '' : $lastReports->end_time2) }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day3" type="date" name="work_day3"
                            value="{{ old('work_day3') }}"></div>
                    <div class="col-3"><input type="time" name="start_time3"
                            value="{{ old('start_time3', empty($lastReports) ? '' : $lastReports->start_time3) }}">
                    </div>
                    <div class="col-3"><input type="time" name="end_time3"
                            value="{{ old('end_time3', empty($lastReports) ? '' : $lastReports->end_time3) }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day4" type="date" name="work_day4"
                            value="{{ old('work_day4') }}"></div>
                    <div class="col-3"><input type="time" name="start_time4"
                            value="{{ old('start_time4', empty($lastReports) ? '' : $lastReports->start_time4) }}"></div>
                    <div class="col-3"><input type="time" name="end_time4"
                            value="{{ old('end_time4', empty($lastReports) ? '' : $lastReports->end_time4) }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day5" type="date" name="work_day5"
                            value="{{ old('work_day5') }}"></div>
                    <div class="col-3"><input type="time" name="start_time5"
                            value="{{ old('start_time5', empty($lastReports) ? '' : $lastReports->start_time5) }}"></div>
                    <div class="col-3"><input type="time" name="end_time5"
                            value="{{ old('end_time5', empty($lastReports) ? '' : $lastReports->end_time5) }}">
                    </div>
                </div>
            @else
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day1" type="date" name="work_day1"
                            value="{{ $reportsPost->work_day1 }}"></div>
                    <div class="col-3"><input type="time" name="start_time1"
                            value="{{ $reportsPost->start_time1 }}"></div>
                    <div class="col-3"><input type="time" name="end_time1" value="{{ $reportsPost->end_time1 }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day2" type="date" name="work_day2"
                            value="{{ $reportsPost->work_day2 }}"></div>
                    <div class="col-3"><input type="time" name="start_time2"
                            value="{{ $reportsPost->start_time2 }}"></div>
                    <div class="col-3"><input type="time" name="end_time2" value="{{ $reportsPost->end_time2 }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day3" type="date" name="work_day3"
                            value="{{ $reportsPost->work_day3 }}"></div>
                    <div class="col-3"><input type="time" name="start_time3"
                            value="{{ $reportsPost->start_time3 }}"></div>
                    <div class="col-3"><input type="time" name="end_time3" value="{{ $reportsPost->end_time3 }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day4" type="date" name="work_day4"
                            value="{{ $reportsPost->work_day4 }}"></div>
                    <div class="col-3"><input type="time" name="start_time4"
                            value="{{ $reportsPost->start_time4 }}"></div>
                    <div class="col-3"><input type="time" name="end_time4" value="{{ $reportsPost->end_time4 }}">
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5"><input id="work_day5" type="date" name="work_day5"
                            value="{{ $reportsPost->work_day5 }}"></div>
                    <div class="col-3"><input type="time" name="start_time5"
                            value="{{ $reportsPost->start_time5 }}"></div>
                    <div class="col-3"><input type="time" name="end_time5" value="{{ $reportsPost->end_time5 }}">
                    </div>
                </div>
            @endif

            <input type="hidden" name="name_id" value="{{ $user->id }}">
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="reporting_date" value="{{ preg_replace('/[年月日]/', '', $today) }}">
            <input type="hidden" name="key_number" value="{{ $key_number }}">
            <div>
                <button type="submit"
                    class="btn  mt-2 buttonW {{ empty($reportsPost) ? 'btn-success' : 'btn-secondary' }}"
                    {{ empty($reportsPost) ? '' : 'disabled' }}>提出</button>
                <button type="submit"
                    class="btn mt-2 buttonW {{ empty($reportsPost) ? 'btn-secondary' : 'btn-warning' }}"
                    {{ empty($reportsPost) ? 'disabled' : '' }}>更新</button>
        </form>
    </div>
@endsection
