@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/reportsCheck.css') }}">
@endpush

@section('left_tab')
    <i id="back_btn" class="fa-solid fa-backward-step" style="font-size: 120%; width:21.6px; color:rgb(149, 149, 149)"></i>
@endsection

@section('right_tab')
    <i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(149, 149, 149)"></i>
@endsection


@section('second_header')
    <div class="text-center bg-secondary text-white h4 py-2">
        <i class="fa-solid fa-file" style="font-size: 70%;"></i>
        ユーザー編集
    </div>
@endsection

@section('contents')
    <div class="header-table ml-3">
        <form action="{{ secure_route('userEdit.search') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" style="width: 80px" maxlength="24"
                placeholder="名前">

            <button class="btn-secondary ml-2">検索</button>
        </form>
    </div>

    @if ($msg !== '')
        <div class="alert alert-secondary">
            {{ $msg }}
        </div>
    @endif

    <table class="text-center mt-2">
        <tr class="red-line"></tr>
        <thead>
            <tr>
                <th>名前</th>
                <th>管理権限</th>
                <th>確認権限</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($users as $user)
            <tr>
                <td class="pl-0 pr-0">
                    <div>{{ $user->name }}</div>
                </td>
                <form action="{{ secure_route('userEdit.edit') }}" method="POST">
                    @csrf
                    <td>
                        <input type="checkbox" name="AdminAuth" {{ $user->adminAuth == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="CheckAuth" {{ $user->checkAuth == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn-secondary mb-1 w-100">権限変更</button>
                </form>
                <form action="{{ secure_route('userEdit.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button class="btn-danger mb-1 w-100">削除</button>
                </form>
                </td>
            </tr>
            <tr class="red-line"></tr>
        @endforeach
    </table>
@endsection
