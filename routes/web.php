<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsCheckController;
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
    Route::get('/home', [HomeController::class,'index']);
    Route::get('/reportsCheck', [ReportsCheckController::class,'index']);
    Route::get('/reportsPost', function () {
        return view('reportsPost');
    }); 
    Route::get('/reportsCheckAdmin', function () {
        return view('reportsCheckAdmin');
    });
    Route::get('/reportsCheckAdmin', function () {
        return view('reportsCheckAdmin');
    });
    Route::get('/admin', function () {
        return view('admin');
    });
    Route::get('/userAdd', function () {
        return view('userAdd');
    });
    Route::get('/userEdit', function () {
        return view('userEdit');
    });
    Route::get('/dataDelete', function () {
        return view('dataDelete');
    });
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
