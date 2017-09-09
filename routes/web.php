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


Route::get('/', 'StaticWebsiteController@index')->name('lse');

Route::get('/events', 'StaticWebsiteController@events')->name('events');

Route::get('/about-thebirth', 'StaticWebsiteController@aboutBirth')->name('birth');

Route::get('/contact', 'StaticWebsiteController@contact')->name('contact');

Route::get('/about-mnv', 'StaticWebsiteController@aboutMnv')->name('mnv');

Route::get('/gallery', 'StaticWebsiteController@gallery')->name('gallery');

//Route::resource('manage/users', 'UsersController');

Route::get('manage/users', 'UsersController@index')->name('users.index');

Route::post('manage/users', 'UsersController@store')->name('users.store');

Route::put('manage/users/update', 'UsersController@update')->name('users.update');

Route::delete('manage/users/delete', 'UsersController@delete')->name('users.delete');
//
Route::get('manage/events', 'EventsController@index')->name('events.index');
Route::post('manage/events', 'EventsController@store')->name('events.store');
Route::put('manage/events/update', 'EventsController@update')->name('events.update');
Route::delete('manage/events/delete', 'EventsController@destroy')->name('events.delete');

Auth::routes();

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

Route::get('/User-home', 'UserHomeController@index');

Route::get('/Officer-home', 'OfficerHomeController@index');

Route::get('/Admin-home', 'AdminHomeController@index');

Route::get('view/registrations', 'RegistrationsController@index');

Route::get('announcements', 'AnnouncementsController@index');

Route::post('announcements', 'AnnouncementsController@sendAnnouncements')->name('sendAnnouncements');

Route::get('/portal', function(){
    return view('portal.portal-home');
});

Route::get('/portal2', function(){
    return view('portal.portal-home2');
});