<?php
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email', function(){
   return view('email');
});

Route::get('/sms', function(){
    return view('sms');
});

Route::get('/rtc1', function(){
    return view('rtc');
});

Route::post('/sentEmail', "EmailController@sendEmail")->name('confirmedEmail');
Route::post('/sentSms', "SmsController@sendSms")->name('confirmedSms');