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

//route group for main website
Route::group(['prefix' => '/'], function(){
    Route::get('', 'StaticWebsiteController@index')->name('lse');
    Route::get('events', 'StaticWebsiteController@events')->name('events');
    Route::get('about-thebirth', 'StaticWebsiteController@aboutBirth')->name('birth');
    Route::get('contact', 'StaticWebsiteController@contact')->name('contact');
    Route::get('about-mnv', 'StaticWebsiteController@aboutMnv')->name('mnv');
    Route::get('gallery', 'StaticWebsiteController@gallery')->name('gallery');
});

//authentication routes
Auth::routes();

Route::middleware(['role:head'])->group(function(){
    Route::group(['prefix' => 'portal/head/'], function(){

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

        Route::get('registrations/all', 'RegistrationsController@index')->name('registrations');

        Route::group(['prefix' => 'send/announcements'], function(){
            Route::get('/', 'AnnouncementsController@index')->name('announcements');
            Route::post('/', 'AnnouncementsController@sendAnnouncements')->name('sendAnnouncements');
        });

        Route::get('/rtc', 'RTCController@index')->name('rtcadmin');
    });
});
//routes for officer/admin portal layout


//routes for user portal
Route::middleware(['role:user'])->group(function() {
    Route::group(["prefix" => 'portal/user/'], function () {
        Route::group(['prefix' => 'registrations/'], function () {
            Route::get('', 'IndividualRegistrationsController@index')->name('individualregistrations');
            Route::post('', 'RegistrationsController@store')->name('registerevent');
            Route::delete('delete', 'RegistrationsController@destroy')->name('deleteregistration');
        });

        Route::group(['prefix' => 'profile/manage/'], function () {
            Route::get('', 'ProfileManagementController@index')->name('profile');
            Route::put('update', 'ProfileManagementController@updateProfile')->name('profile.update');
        });
        Route::get('/rtc', 'RTCController@index')->name('rtcuser');
    });
});

/*
 * Deprecated routes
 */

/*
 *
 *
Route::get('/rtc1', function(){
    return view('rtc');
});

Route::get('/test', function(){
    return view('rtcadmin');
});

Route::get('/user', function(){
    return view('rtcuser');
});
Route::post('/sentEmail', "EmailController@sendEmail")->name('confirmedEmail');
Route::post('/sentSms', "SmsController@sendSms")->name('confirmedSms');

Route::get('/User-home', 'UserHomeController@index')->name('default');

Route::get('/Officer-home', 'OfficerHomeController@index');

Route::get('/Admin-home', 'AdminHomeController@index');
 */


