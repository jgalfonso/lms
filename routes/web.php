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
        });

        //-------- ASSIGNMENTS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('assignments/new', 'AssignmentsController@new')->name('new-assignment');
            Route::get('assignments/recent', 'AssignmentsController@recent')->name('recent-assignment');
            Route::get('assignments/archives', 'AssignmentsController@archives')->name('archives-assignment');
        });

        //-------- QUIZZES --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('quizzes/new', 'QuizzesController@new')->name('new-quiz');
            Route::get('quizzes/recent', 'QuizzesController@recent')->name('recent-quiz');
            Route::get('quizzes/archives', 'QuizzesController@archives')->name('archives-quiz');
        });

        //-------- EXAMS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('exams/new', 'ExamsController@new')->name('new-exam');
            Route::get('exams/recent', 'ExamsController@recent')->name('recent-exam');
            Route::get('exams/archives', 'ExamsController@archives')->name('archives-exam');
        });
    });
});
