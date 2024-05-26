<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsCheckController;
use App\Http\Controllers\ReportsCheckAdminController;
use App\Http\Controllers\ReportsPostController;
use App\Http\Controllers\HomeController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // トップページ用のルート
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // 週報提出用のルート
    Route::get('/reportsPost', [ReportsPostController::class, 'index']);
    Route::post('/reportsPost/entry', [ReportsPostController::class, 'entry'])->name('reportsPost.home');
    Route::post('/reportsPostEdit/edit', [ReportsPostController::class, 'edit'])->name('reportsPostEdit.home');
    
    // 週報確認用のルート
    Route::get('/reportsCheck', [ReportsCheckController::class, 'index']);
    Route::post('/reportsCheck/search', [ReportsCheckController::class, 'search'])->name('search.reportsCheck');
    Route::post('/reportsCheck/edit', [ReportsCheckController::class, 'edit'])->name('edit.reportsCheck');
    Route::post('/comfirmPost/reportsCheck', [ReportsCheckController::class, 'comfirmPost'])->name('comfirmPost.reportsCheck');
    
    // 週報確認（管理者用）のルート
    Route::get('/reportsCheckAdmin', [ReportsCheckAdminController::class, 'index']);
    Route::post('/reportsCheckAdmin/search', [ReportsCheckAdminController::class, 'search'])->name('reportsCheckAdmin.search');
    Route::post('/reportsCheckAdmin/edit', [ReportsCheckAdminController::class, 'edit'])->name('reportsCheckAdmin.edit');
    Route::post('/comfirmPostAdmin', [ReportsCheckAdminController::class, 'comfirmPost'])->name('comfirmPostAdmin');
    
    // Route::get('/admin', function () {
    //     return view('admin');
    // });
    // Route::get('/userAdd', function () {
    //     return view('userAdd');
    // });
    // Route::get('/userEdit', function () {
    //     return view('userEdit');
    // });
    // Route::get('/dataDelete', function () {
    //     return view('dataDelete');
    // });
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
