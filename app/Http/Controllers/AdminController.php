<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    // トップページを最初に表示した際に呼び出される処理
    public function index()
    {
        $user = Auth::user();

        return view('admin', ['user' => $user]);
    }
}
