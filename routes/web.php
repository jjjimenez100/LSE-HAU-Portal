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

Route::get('/User-home', 'UserHomeController@index')->name('default');

Route::get('/Officer-home', 'OfficerHomeController@index');

Route::get('/Admin-home', 'AdminHomeController@index');

Route::group(['prefix' => 'portal/'], function(){
    Route::group(['prefix' => 'manage/'], function(){
        Route::group(['prefix' => 'users/'], function(){
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::post('/', 'UsersController@store')->name('users.store');
            Route::put('update', 'UsersController@update')->name('users.update');
            Route::delete('delete', 'UsersController@delete')->name('users.delete');
        });

        Route::group(['prefix' => 'events/'], function(){
            Route::get('/', 'EventsController@index')->name('events.index');
            Route::post('/', 'EventsController@store')->name('events.store');
            Route::put('update', 'EventsController@update')->name('events.update');
            Route::delete('delete', 'EventsController@destroy')->name('events.delete');
        });
    });

    Route::get('view/registrations', 'RegistrationsController@index')->name('registrations');
    Route::post('register/event', 'RegistrationsController@store')->name('registerevent');

    Route::group(['prefix' => 'send/announcements'], function(){
        Route::get('/', 'AnnouncementsController@index')->name('announcements');
        Route::post('/', 'AnnouncementsController@sendAnnouncements')->name('sendAnnouncements');
    });

    //lahat to dapat may middleware
});

/*Route::get('manage/users', 'UsersController@index')->name('users.index');

Route::post('manage/users', 'UsersController@store')->name('users.store');

Route::put('manage/users/update', 'UsersController@update')->name('users.update');

Route::delete('manage/users/delete', 'UsersController@delete')->name('users.delete');
//
Route::get('manage/events', 'EventsController@index')->name('events.index');
Route::post('manage/events', 'EventsController@store')->name('events.store');
Route::put('manage/events/update', 'EventsController@update')->name('events.update');
Route::delete('manage/events/delete', 'EventsController@destroy')->name('events.delete');

Route::get('announcements', 'AnnouncementsController@index');

Route::post('announcements', 'AnnouncementsController@sendAnnouncements')->name('sendAnnouncements');*/