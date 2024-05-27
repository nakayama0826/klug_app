@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsCheck.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; color:rgb(106, 184, 99)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(106, 184, 99)"></i>
@endsection


@section('second_header')
    <div class="text-center page_title h4 py-2">
        <i class="fa-solid fa-file" style="font-size: 70%;"></i>
        週報一覧（管理者用）
    </div>
@endsection

@section('contents')
    <div class="header-table ml-3">
        <form action="{{ route('reportsCheckAdmin.search') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name', $name) }}" style="width: 80px" maxlength="24"
                placeholder="名前">
            <label for="year_input" class="pt-1"></label>
            <input type="text" name="year_input" value="{{ old('year_input', $year) }}" style="width: 60px"
                maxlength="4" placeholder="YYYY" pattern="\d{4}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">

            <input type="text" name="month_input" value="{{ old('month_input', $month) }}" style="width: 40px"
                maxlength="2" placeholder="MM" pattern="\d{2}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">

            <input type="checkbox" id="last_week" name="last_week" {{ old('last_week', $inputCheck) ? 'checked' : '' }} />
            <label for="last_week" class="small mb-0">直近の週報を取得</label>

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
        @foreach ($weekly_reports as $report)
            <tr>
                <td class="pl-0 pr-0">
                    <div>週報：{{ $report->name }}</div>
                </td>
                <td>
                    <div>{{ date('Y/m/d', strtotime($report->first_day)) }}</div>
                    ~
                    <div>{{ date('Y/m/d', strtotime($report->last_day)) }}</div>
                </td>

                <td>
                    <form action="{{ route('comfirmPostAdmin') }}" method="POST">
                        @csrf
                        <input type="hidden" name="key_number" value="{{ $report->key_number }}">
                        <button class="btn-primary mb-1">確認</button>
                    </form>
                </td>
            </tr>
            <tr class="red-line"></tr>
        @endforeach
    </table>
@endsection
