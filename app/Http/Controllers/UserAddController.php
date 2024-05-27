<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAddController extends Controller
{
    // トップページを最初に表示した際に呼び出される処理
    public function index()
    {
        return view('userAdd');
    }
}
