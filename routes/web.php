<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::name('question.')
    ->group(function () {

        // Route::get('/question/index','QuestionController@index')->name('index');
        Route::get('/home','QuestionController@index')->name('index');
        Route::get('/question/{question}/show','QuestionController@show')->name('show');
        //質問を投稿
        Route::get('/question/create','QuestionController@create')->name('create');
        Route::post('/question/store','QuestionController@store')->name('store');
        //質問編集
        Route::get('/question/{question}/edit','QuestionController@edit')->name('edit');
        Route::put('/question/{question}/update','QuestionController@update')->name('update');
        //質問削除
        Route::delete('/question/{question}/delete','QuestionController@destroy')->name('destroy');
    });

Route::name('answer.')
    ->group(function () {
         //質問に回答
         Route::get('/answer/{question}/create','AnswerController@create')->name('create');
         Route::post('/answer/{question}/store','AnswerController@store')->name('store');

        //ベベストアンサー
         Route::put('/answer/{answer}/best_answer','AnswerController@best_answer_store')->name('best_answer');

        //いいね機能
         Route::post('/favorite/{answer}/store','LikeController@store')->name('favorites');
         Route::post('/favorite/{answer}/destroy','LikeController@destroy')->name('unfavorites');

    });

Route::name('mypage.')
    ->group(function () {

        Route::get('/mypage/{user}/answer','HomeController@myanswer')->name('answer');
    });

