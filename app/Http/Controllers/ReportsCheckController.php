<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsCheckController extends Controller
{
    public function index(){
        $items = DB::select('select * from users');
        return view('reportsCheck',['items' => $items]);
    }
}