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

    //-------- MAIN --------//
    Route::group(['name' => 'main.', 'prefix' => 'main', 'namespace' => 'Main'], function () {

        //-------- DASHBOARD --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        });

        //-------- CALENDAR --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('calendar', 'CalendarController@index')->name('calendar');
        });
    });

    //-------- ACADEMIC --------//
    Route::group(['name' => 'academic.', 'prefix' => 'academic', 'namespace' => 'Academic'], function () {

        //-------- CLASS ACTIVATION --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('class-activation/activation', 'ClassActivationController@index')->name('class-activation');
        });

        //-------- LESSONS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('lessons/new', 'LessonsController@new')->name('new-lesson');
            Route::get('lessons/lesson-plan', 'LessonsController@lessonPlan')->name('lesson-plan');
            Route::get('lessons/archives', 'LessonsController@archives')->name('archives');
            Route::get('lessons/view/{id}', 'LessonsController@view')->name('view-lesson');
            //-------- AJAX REQUEST FOR LESSONS --------//
            Route::post('lessons/store', 'LessonsController@store')->name('store-lesson');
            Route::post('lessons/getClasses', 'LessonsController@getClasses')->name('get-classes');
            Route::get('lessons/filter', 'LessonsController@filter')->name('filter-lessons');
        });

        //-------- ASSIGNMENTS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('assignments/new', 'AssignmentsController@new')->name('new-assignment');
            Route::get('assignments/recent', 'AssignmentsController@recent')->name('recent-assignment');
            Route::get('assignments/archives', 'AssignmentsController@archives')->name('archives-assignment');
            Route::get('assignments/view/{id}', 'AssignmentsController@view')->name('view-assignment');
            //-------- AJAX REQUEST FOR ASSIGNMENTS --------//
            Route::post('assignments/store', 'AssignmentsController@store')->name('store-lesson');
            Route::post('assignments/getClasses', 'AssignmentsController@getClasses')->name('get-classes');
            Route::get('assignments/filter', 'AssignmentsController@filter')->name('filter-lessons');
        });

        //-------- PROJECTS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('projects/new', 'ProjectsController@new')->name('new-project');
            Route::get('projects/recent', 'ProjectsController@recent')->name('recent-project');
            Route::get('projects/archives', 'ProjectsController@archives')->name('archives-project');
            //-------- AJAX REQUEST FOR PROJECTS --------//
            Route::post('projects/store', 'ProjectsController@store')->name('store-project');
            Route::post('projects/getClasses', 'ProjectsController@getClasses')->name('get-classes');
            Route::get('projects/filter', 'ProjectsController@filter')->name('filter-projects');
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

    //-------- SETUP --------//
    Route::group(['name' => 'setup.', 'prefix' => 'setup', 'namespace' => 'Setup'], function () {

        //-------- CLASS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('class/index', 'ClassController@index')->name('class');
            Route::get('class/new', 'ClassController@new')->name('new-class');
            Route::get('class/edit', 'ClassController@edit')->name('edit-class');
            Route::get('class/archives', 'ClassController@archives')->name('archives-class');
        });
    });
});
