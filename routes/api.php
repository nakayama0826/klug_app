<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsPostController;
use App\Http\Controllers\ReportsCheckController;
use App\Http\Controllers\ReportsCheckAdminController;
use App\Http\Controllers\DataDeleteController;
use App\Http\Controllers\UserEditController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth'])->group(function () {
	// 週報提出用のエンドポイント
	Route::get('/reportsPost', [ReportsPostController::class, 'index']);
	Route::post('/reportsPost/edit', [ReportsPostController::class, 'edit']);
	Route::post('/reportsPost/entry', [ReportsPostController::class, 'entry']);

	// 週報確認用のエンドポイント
	Route::get('/reportsCheck', [ReportsCheckController::class, 'index']);
	Route::post('/reportsCheck/search', [ReportsCheckController::class, 'search']);
	Route::post('/reportsCheck/edit', [ReportsCheckController::class, 'edit']);
	Route::post('/reportsCheck/comfirm', [ReportsCheckController::class, 'comfirmPost']);

	// 週報確認（管理者用）のエンドポイント
	Route::get('/reportsCheckAdmin', [ReportsCheckAdminController::class, 'index'])->middleware('check');
	Route::post('/reportsCheckAdmin/search', [ReportsCheckAdminController::class, 'search'])->middleware('check');
	Route::post('/reportsCheckAdmin/comfirmPost', [ReportsCheckAdminController::class, 'comfirmPost'])->middleware('check');

	// ユーザー編集のエンドポイント
	Route::get('/userEdit', [UserEditController::class, 'index'])->middleware('admin');
	Route::post('/userEdit/search', [UserEditController::class, 'search'])->middleware('admin');
	Route::post('/userEdit/edit', [UserEditController::class, 'edit'])->middleware('admin');
	Route::post('/userEdit/delete', [UserEditController::class, 'delete'])->middleware('admin');

	// データ削除のエンドポイント
	Route::get('/dataDelete', [DataDeleteController::class, 'index'])->middleware('admin');
	Route::post('/dataDelete/delete', [DataDeleteController::class, 'delete'])->middleware('admin');
});
