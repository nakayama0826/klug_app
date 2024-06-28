@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsCheck.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; width:21.6px; color:rgb(149, 149, 149)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%;  color:rgb(149, 149, 149)"></i>
@endsection


@section('second_header')
    <div class="text-center bg-secondary text-white h4 py-2">
        <i class="fa-solid fa-file" style="font-size: 70%;"></i>
        週報データ削除
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

    <div class="header-table">
        <form action="{{ secure_route('dataDelete.delete') }}" method="POST">
            @csrf
            <div class="container mt-2">
                <input type="text" name="year_input_from" value="{{ old('year_input') }}" style="width: 60px"
                    maxlength="4" placeholder="YYYY" pattern="\d{4}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                <input type="text" name="month_input_from" value="{{ old('month_input') }}" style="width: 40px"
                    maxlength="2" placeholder="MM" pattern="\d{2}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
    ~
                <input type="text" name="year_input_to" value="{{ old('year_input') }}" style="width: 60px"
                    maxlength="4" placeholder="YYYY" pattern="\d{4}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                <input type="text" name="month_input_to" value="{{ old('month_input') }}" style="width: 40px"
                    maxlength="2" placeholder="MM" pattern="\d{2}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <button type="submit" class="btn-danger ml-2">削除</button>
            </div>
        </form>
    </div>

    @if ($msg !== '')
        <div class="alert alert-secondary">
            {{ $msg }}
        </div>
    @endif
@endsection
