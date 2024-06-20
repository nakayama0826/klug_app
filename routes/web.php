<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth:sanctum')->get('/getUser', function () {
    return response()->json(Auth::user());
});

Route::middleware('admin')->get('/getUserAdmin', function () {
    return response()->json(Auth::user());
});

Route::middleware(['auth'])->group(function () {
    Route::get('{all}', function () {
        return view('index');
    })->where(['all' => '.*']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
