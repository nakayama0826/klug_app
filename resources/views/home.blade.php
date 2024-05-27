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
    <div class="text-center page_title h4 py-2">
        <i class="fa-solid fa-home" style="font-size: 70%;"></i>
        トップページ
    </div>
@endsection

@section('contents')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="wrapper">
        <main>
            <div id="member_info" class="container text-center">
                <table border="1" width="100%">
                    <tr>
                        <th>氏名</th>
                        <th>所属部署</th>
                    </tr>
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->Department }}</td>
                    </tr>
                </table>
            </div>
            <button type="button" class="btn btn-success mb-2 buttonW"
                onclick="location.href='http://application.gulk.co.jp/reportsPost'"><i class="fa-solid fa-file"></i>
                週報提出</button><br>
            <button type="button" class="btn btn-success mb-2 buttonW"
                onclick="location.href='http://localhost/klug_app/public/reportsCheck'"><i class="fa-solid fa-file"></i>
                週報確認</button><br>
            <button type="button" class="btn btn-success mb-2 buttonW"
                onclick="location.href='http://localhost/klug_app/public/reportsCheckAdmin'">　　　　　　<i class="fa-solid fa-file-import"></i> 週報確認（管理者用）</button>
            <button type="button" class="btn buttonW"
                onclick="location.href='http://localhost/klug_app/public/admin'"><i class="fa-solid fa-gear"></i>管理者用トップページへ</button>
        </main>
    </div>
@endsection
