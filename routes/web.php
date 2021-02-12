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

Route::get('{slug}', function() {
        return view('index');
    })
    ->middleware('auth')
   	->where('slug', '(?!admin)([A-z\d\-\/_.]+)?');



Route::get('admin', function (){
    return redirect()->intended(route('dashboard'));
});

Route::group(['name' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //-------- ACADEMIC --------//
    Route::group(['name' => 'academic.', 'prefix' => 'academic', 'namespace' => 'Academic'], function () {

        //-------- LESSONS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('lessons/new', 'LessonsController@new')->name('new-lesson');
            //-------- AJAX REQUEST FOR LESSONS --------//
            Route::post('lessons/store', 'LessonsController@store')->name('store-lesson');
            Route::post('lessons/getClasses', 'LessonsController@getClasses')->name('get-classes');
        });

    });
});
