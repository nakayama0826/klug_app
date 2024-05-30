@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsCheck.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; width:21.6px; color:rgb(106, 184, 99)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(106, 184, 99)"></i>
@endsection


@section('second_header')
    <div class="text-center page_title h4 py-2">
        <i class="fa-solid fa-file" style="font-size: 70%;"></i>
        週報一覧
    </div>
@endsection

@section('contents')
    <div class="header-table">
        <label for="year_input" class="ml-4 pt-1">年：</label>
        <form action="{{ route('reportsCheck.search') }}" method="POST">
            @csrf
            <input type="text" name="year_input" value="{{ old('year_input', $year) }}" style="width: 60px"
                maxlength="4" placeholder="YYYY" pattern="\d{4}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            <label for="month_input" class="ml-2 pt-1">/月：</label>
            <input type="text" name="month_input" value="{{ old('month_input', $month) }}" style="width: 40px"
                maxlength="2" placeholder="MM" pattern="\d{2}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            <button class="btn-success ml-2">検索</button>
        </form>
    </div>
    @if ($msg !== '')
        <div class="alert alert-success">
            {{ $msg }}
        </div>
    @endif

    <table class="text-center">
        <tr class="red-line"></tr>
        @if (!$check)
            <tr>
                <td>週報</td>
                <td colspan="3" class="text-danger">
                    ※先週分の週報が未提出です
                </td>
                <td>
                    <form action="{{ route('reportsCheck.edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="key_number" value="">
                        <button class="btn-danger mb-1">提出</button>
                    </form>
                </td>
            </tr>
            <tr class="red-line"></tr>
        @endif
        @foreach ($weekly_reports as $report)
            <tr>
                <td>週報</td>
                <td>
                    <div>{{ date('Y/m/d', strtotime($report->first_day)) }}</div>
                </td>
                <td>~</td>
                <td>
                    <div>{{ date('Y/m/d', strtotime($report->last_day)) }}</div>
                </td>
                <td>
                    <form action="{{ route('comfirmPost.reportsCheck') }}" method="POST">
                        @csrf
                        <input type="hidden" name="key_number" value="{{ $report->key_number }}">
                        <button class="btn-primary mb-1">確認</button>
                    </form>
                    {{-- 先々週分までの週報は編集できるようにする --}}
                    @if ($key_number - $report->key_number < 3)
                        <form action="{{ route('reportsCheck.edit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="key_number" value="{{ $report->key_number }}">
                            <button class="btn-warning">編集</button>
                        </form>
                    @endif
                </td>
            </tr>
            <tr class="red-line"></tr>
        @endforeach
    </table>
@endsection
