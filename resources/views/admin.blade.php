@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('left_tab')
    <i id="logout_btn" class="fa-solid fa-door-open" style="font-size: 120%; color:rgb(149, 149, 149)"></i>
    <form id="logout_form" method="POST" action="{{ route('logout') }}" class="inline" style="display: none;">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2"></button>
    </form>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(149, 149, 149)"></i>
@endsection

@section('second_header')
    <div class="text-center bg-secondary text-white h4 py-2">
        <i class="fa-solid fa-key" style="font-size: 70%;"></i>
        Admin
    </div>
@endsection

@section('contents')
    <div class="wrapper">
        <main>
            <div id="member_info" class="container text-center">
                <table border="1" width="100%">
                    <tr>
                        <th class="bg-secondary text-white">氏名</th>
                        <th class="bg-secondary text-white">所属部署</th>
                    </tr>
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->Department }}</td>
                    </tr>
                </table>
            </div>
            <button type="button" class="btn btn-secondary mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/userAdd'"><i class="fa-solid fa-users"></i>
                ユーザー追加</button> <br>
            <button type="button" class="btn btn-secondary mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/userEdit'"><i
                    class="fa-solid fa-pen-to-square"></i>
                ユーザー編集</button><br>
            <button type="button" class="btn btn-secondary mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/dataDelete'"><i
                    class="fa-solid fa-delete-left"></i>
                データ削除</button>
            <button type="button" class="btn buttonW"
                onclick="location.href='http://application.gulk.co.jp/home'">トップページへ</button>
        </main>
    </div>
@endsection
