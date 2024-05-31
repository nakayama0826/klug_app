<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsCheckController;
use App\Http\Controllers\ReportsCheckAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataDeleteController;
use App\Http\Controllers\ReportsPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserEditController;

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

Route::middleware(['auth'])->group(function () {
    // トップページ用のルート
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 週報提出用のルート
    Route::get('/reportsPost', [ReportsPostController::class, 'index']);
    Route::get('/reportsPost/entry', [ReportsPostController::class, 'index'])->name('reportsPost.entry');
    Route::post('/reportsPost/entry', [ReportsPostController::class, 'entry'])->name('reportsPost.entry');
    Route::get('/reportsPostEdit/edit', [ReportsPostController::class, 'index'])->name('reportsPost.edit');
    Route::post('/reportsPostEdit/edit', [ReportsPostController::class, 'edit'])->name('reportsPost.edit');

    // 週報確認用のルート
    Route::get('/reportsCheck', [ReportsCheckController::class, 'index']);
    Route::get('/reportsCheck/search', [ReportsCheckController::class, 'index'])->name('reportsCheck.search');
    Route::post('/reportsCheck/search', [ReportsCheckController::class, 'search'])->name('reportsCheck.search');
    Route::get('/reportsCheck/edit', [ReportsCheckController::class, 'index'])->name('reportsCheck.edit');
    Route::post('/reportsCheck/edit', [ReportsCheckController::class, 'edit'])->name('reportsCheck.edit');
    Route::get('/comfirmPost/reportsCheck', [ReportsCheckController::class, 'index'])->name('comfirmPost.reportsCheck');
    Route::post('/comfirmPost/reportsCheck', [ReportsCheckController::class, 'comfirmPost'])->name('comfirmPost.reportsCheck');

    // 週報確認（管理者用）のルート
    Route::get('/reportsCheckAdmin', [ReportsCheckAdminController::class, 'index'])->middleware('check')->name('reportsCheckAdmin');
    Route::get('/reportsCheckAdmin/search', [ReportsCheckAdminController::class, 'index'])->middleware('check')->name('reportsCheckAdmin.search');
    Route::post('/reportsCheckAdmin/search', [ReportsCheckAdminController::class, 'search'])->middleware('check')->name('reportsCheckAdmin.search');
    Route::get('/reportsCheckAdmin/edit', [ReportsCheckAdminController::class, 'index'])->middleware('check')->name('reportsCheckAdmin.edit');
    Route::post('/reportsCheckAdmin/edit', [ReportsCheckAdminController::class, 'edit'])->middleware('check')->name('reportsCheckAdmin.edit');
    Route::get('/comfirmPostAdmin', [ReportsCheckAdminController::class, 'index'])->middleware('check')->name('comfirmPostAdmin');
    Route::post('/comfirmPostAdmin', [ReportsCheckAdminController::class, 'comfirmPost'])->middleware('check')->name('comfirmPostAdmin');

    // 管理者用画面のルート
    Route::get('/admin', [AdminController::class, 'index'])->middleware('admin')->name('admin');

    // ユーザー編集のルート
    Route::get('/userEdit', [UserEditController::class, 'index'])->middleware('admin')->name('userEdit');
    Route::get('/userEdit/search', [UserEditController::class, 'index'])->middleware('admin')->name('userEdit.search');
    Route::post('/userEdit/search', [UserEditController::class, 'search'])->middleware('admin')->name('userEdit.search');
    Route::get('/userEdit/edit', [UserEditController::class, 'index'])->middleware('admin')->name('userEdit.edit');
    Route::post('/userEdit/edit', [UserEditController::class, 'edit'])->middleware('admin')->name('userEdit.edit');
    Route::get('/userEdit/delete', [UserEditController::class, 'index'])->middleware('admin')->name('userEdit.delete');
    Route::post('/userEdit/delete', [UserEditController::class, 'delete'])->middleware('admin')->name('userEdit.delete');
    
    // データ削除のルート
    Route::get('/dataDelete', [DataDeleteController::class, 'index'])->middleware('admin')->name('dataDelete');
    Route::get('/dataDelete/delete', [DataDeleteController::class, 'index'])->middleware('admin')->name('dataDelete.delete');
    Route::post('/dataDelete/delete', [DataDeleteController::class, 'delete'])->middleware('admin')->name('dataDelete.delete');

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
