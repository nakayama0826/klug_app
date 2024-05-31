@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('left_tab')
    <i id="logout_btn" class="fa-solid fa-door-open" style="font-size: 120%; color:rgb(106, 184, 99)"></i>
    <form id="logout_form" method="POST" action="{{ route('logout') }}" class="inline" style="display: none;">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2"></button>
    </form>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(106, 184, 99)"></i>
@endsection

@section('second_header')
    <div class="text-center bg-success text-white h4 py-2 mb-0">
        <i class="fa-solid fa-home" style="font-size: 70%;"></i>
        トップページ
    </div>
@endsection

@section('contents')
    @if (session('success'))
        <div class="alert alert-success mb-0">
            {{ session('success') }}
        </div>
    @endif
    <div class="wrapper">
        <main>
            <div id="member_info" class="container text-center">
                <table border="1" width="100%">
                    <tr class="text-center">
                        <th class="bg-success text-white">氏名</th>
                        <th class="bg-success text-white">所属部署</th>
                    </tr>
                    <tr class="text-center">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->Department }}</td>
                    </tr>
                </table>
            </div>
            <button type="button" class="btn btn-success mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/reportsPost'"><i class="fa-solid fa-pen-to-square"></i>
                週報提出</button><br>
            <button type="button" class="btn btn-success mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/reportsCheck'"><i class="fa-solid fa-file"></i>
                週報確認</button><br>
            <button type="button" class="btn btn-success mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/reportsCheckAdmin'" {{ !$checkAuth ? 'style=display:none' : '' }} {{ !$checkAuth ? 'disabled' : '' }}>　　　　　　<i class="fa-solid fa-file-import"></i> 週報確認（管理者用）</button>
            <button type="button" class="btn buttonW"
                onclick="location.href='http://application.gulk.co.jp/admin'" {{ !$checkAuth ? 'style=display:none' : '' }} {{ !$checkAuth ? 'disabled' : '' }}><i class="fa-solid fa-key"></i>管理者用ページへ</button>
        </main>
    </div>
@endsection
