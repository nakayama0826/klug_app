<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // 最初にページを開くときに呼び出されるメソッド
    public function index()
    {
        $user = Auth::user();

        // 権限の有無で画面の切り替えを行う
        $checkAuth = $user->checkAuth == 1 ? true : false;
        $adminAuth = $user->adminAuth == 1 ? true : false;

        return view('home', compact('user', 'checkAuth', 'adminAuth'));
    }
}
