<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        // ユーザー情報を取得
        $user = Auth::user();
        // 管理ユーザーでなければリダイレクト
        if(!($user->adminAuth == 1)) {
            return redirect()->route('home');
        }

        return view('admin', ['user' => $user]);
    }
}
