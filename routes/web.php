<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 計算ビューの表示
Route::get('/calculates/calc1',[CalculateController::class,'calc1_show'])->name('calculates.calc1');
Route::get('/calculates/calc2',[CalculateController::class,'calc2_show'])->name('calculates.calc2');
Route::get('/calculates/calc1_test',[CalculateController::class,'calc1_show_test'])->name('calculates.calc1_test');

// アクセスしたら実行する（建物構造と築年数の内容によってデータベースから値を取得する様に設定する）
// 築年数の入力アクションで起動
Route::get('/data_building',[CalculateController::class,'data_building'])->name('data_building');