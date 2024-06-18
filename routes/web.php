<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsCheckController;
use App\Http\Controllers\ReportsCheckAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataDeleteController;
use App\Http\Controllers\ReportsPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserEditController;
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

Route::get('/api/reportsPost', [ReportsPostController::class, 'index']);

Route::get('/api/reportsPost', [ReportsPostController::class, 'index']);
Route::post('/api/reportsPost/edit', [ReportsPostController::class, 'edit']);
Route::post('/api/reportsPost/entry', [ReportsPostController::class, 'entry']);

Route::get('/api/reportsCheck', [ReportsCheckController::class, 'index']);
Route::post('/api/reportsCheck/search', [ReportsCheckController::class, 'search']);
Route::post('/api/reportsCheck/edit', [ReportsCheckController::class, 'edit']);

Route::post('/api/reportsCheck/comfirm', [ReportsCheckController::class, 'comfirmPost']);

Route::get('/api/reportsCheckAdmin', [ReportsCheckAdminController::class, 'index']);
Route::post('/api/reportsCheckAdmin/search', [ReportsCheckAdminController::class, 'search']);
Route::post('/api/reportsCheckAdmin/comfirmPost', [ReportsCheckAdminController::class, 'comfirmPost']);

Route::get('/api/userEdit', [UserEditController::class, 'index']);
Route::post('/api/userEdit/search', [UserEditController::class, 'search']);
Route::post('/api/userEdit/edit', [UserEditController::class, 'edit']);
Route::post('/api/userEdit/delete', [UserEditController::class, 'delete']);

Route::get('/api/dataDelete', [DataDeleteController::class, 'index']);
Route::post('/api/dataDelete/delete', [DataDeleteController::class, 'delete']);

Route::get('/getUser', function () {
    return response()->json(Auth::user());
});

Route::middleware('auth:sanctum')->get('/getUser', function () {
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
