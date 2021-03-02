<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;

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

// 最新Laravelの書き方
Route::get('tests/test', [TestController::class, 'index']);

// Route::resource('contacts', ContactFormController::class)->only([
//     'index', 'show'
// ]);

//左の'contact/index'部分でルーティング
// 右の'index'の部分で対応するコントローラーメソッド
// Route::get('contact/index', [ContactFormController::class, 'index']);
// Route::get('contact/create', [ContactFormController::class, 'create']);
// Route::get('contact/show', [ContactFormController::class, 'create']);
// Route::get('contact/create', [ContactFormController::class, 'create']);

Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function () {
    Route::get('index', [ContactFormController::class, 'index'])->name('contact.index');
    Route::get('create', [ContactFormController::class, 'create'])->name('contact.create');
    Route::post('store', [ContactFormController::class, 'store'])->name('contact.store');
    Route::post('dlcsv', [ContactFormController::class, 'DLCsv'])->name('contact.dlcsv');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
