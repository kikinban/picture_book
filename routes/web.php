<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\SpreadSheetController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\BookController;

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

// ユーザー関連
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// 管理者関連
Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin'])->name('dashboard');

    require __DIR__.'/admin.php';
});

// トップページ
Route::get('/top', [TopController::class, 'bookDetail']);

//  スプレッドシートデータインサート画面
Route::get('/store', [SpreadSheetController::class, 'store']);


Route::get('/vue', function () {
    return view('vue');
});

// 絵本詳細画面
Route::get('books/show/{id}', [BookController::class, 'show'])->name('book.show');


