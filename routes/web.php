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
            Route::get('lessons/edit/{id}', 'LessonsController@edit')->name('edit-lesson');

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
            Route::get('quizzes/view/{id}', 'QuizzesController@view')->name('view-quiz');
            //-------- AJAX REQUEST FOR QUIZZES --------//
            Route::post('quizzes/store', 'QuizzesController@store')->name('store-quiz');
            Route::post('quizzes/getClasses', 'QuizzesController@getClasses')->name('get-classes');
            Route::get('quizzes/filter', 'QuizzesController@filter')->name('filter-quizzes');
        });

        //-------- EXAMS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('exams/new', 'ExamsController@new')->name('new-exam');
            Route::get('exams/recent', 'ExamsController@recent')->name('recent-exam');
            Route::get('exams/archives', 'ExamsController@archives')->name('archives-exam');
            Route::get('exams/view/{id}', 'ExamsController@view')->name('view-exam');
            //-------- AJAX REQUEST FOR EXAMS --------//
            Route::post('exams/store', 'ExamsController@store')->name('store-exams');
            Route::post('exams/getClasses', 'ExamsController@getClasses')->name('get-classes');
            Route::get('exams/filter', 'ExamsController@filter')->name('filter-exams');
        });
    });

    //-------- SERVICES --------//
    Route::group(['name' => 'services.', 'prefix' => 'services', 'namespace' => 'Services'], function () {


        //-------- ENROLLMENT --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('enrollment', 'EnrollmentController@index')->name('enrollment-enroll_student');
            Route::get('enrollment/enroll-student', 'EnrollmentController@index')->name('enrollment-enroll_student');
            Route::get('enrollment/search', 'EnrollmentController@search')->name('enrollment-search');
            Route::get('enrollment/new/{id}', 'EnrollmentController@new')->name('enrollment-new');

            Route::post('enrollment/store', 'EnrollmentController@store')->name('store-enrollment');
        });

        //-------- BILLING --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('billing/newInvoice', 'BillingController@newInvoice')->name('new-invoice');
            Route::get('billing/invoices', 'BillingController@invoices')->name('invoices');
            Route::get('billing/newPayment', 'BillingController@newPayment')->name('new-payment');
            Route::get('billing/payments', 'BillingController@payments')->name('payments');
        });

        //-------- ASSESSMENT --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('assessment/new', 'AssessmentController@new')->name('new-assessment');
            Route::get('assessment/recent', 'AssessmentController@recent')->name('recent-assessment');
        });
    });

    //-------- SETUP --------//
    Route::group(['name' => 'setup.', 'prefix' => 'setup', 'namespace' => 'Setup'], function () {

        //-------- CLASS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('classes', 'ClassController@index')->name('classes');
            Route::get('classes/new', 'ClassController@new')->name('classes-new');
            Route::get('classes/view/{id}', 'ClassController@view')->name('classes-view');
            Route::get('classes/edit/{id}', 'ClassController@edit')->name('classes-edit');

            Route::post('classes/activate', 'ClassController@activate')->name('activate-class');
            Route::post('classes/close', 'ClassController@close')->name('close-class');
            Route::post('classes/store', 'ClassController@store')->name('store-class');
            Route::post('classes/update', 'ClassController@update')->name('update-class');
        });

        //-------- COURSES --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('courses', 'CoursesController@index')->name('courses');
            Route::get('courses/new', 'CoursesController@new')->name('courses-new');
            Route::get('courses/view/{id}', 'CoursesController@view')->name('courses-view');
            Route::get('courses/edit/{id}', 'CoursesController@edit')->name('courses-edit');

            Route::post('courses/store', 'CoursesController@store')->name('store-course');
            Route::post('courses/update', 'CoursesController@update')->name('update-course');
        });
    });

    //-------- USERS --------//
    Route::group(['name' => 'manage-users.', 'prefix' => 'manage-users', 'namespace' => 'Users'], function () {

        //-------- STUDENTS --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('students', 'StudentsController@index')->name('students');
            Route::get('students/new', 'StudentsController@new')->name('students-new');
            Route::get('students/view/{id}', 'StudentsController@view')->name('students-view');
            Route::get('students/edit/{id}', 'StudentsController@edit')->name('students-edit');
            //-------- AJAX REQUEST FOR STUDENTS --------//
            Route::post('students/store', 'StudentsController@store')->name('store-student');
            Route::post('students/update', 'StudentsController@update')->name('update-student');
        });

        //-------- ADMIN --------//
        Route::group(['middleware' => 'auth'], function () {
            Route::get('faculty', 'FacultyController@index')->name('faculty');
            Route::get('faculty/new', 'FacultyController@new')->name('faculty-new');
            Route::get('faculty/view/{id}', 'FacultyController@view')->name('faculty-view');
            Route::get('faculty/edit/{id}', 'FacultyController@edit')->name('faculty-edit');
            //-------- AJAX REQUEST FOR STUDENTS --------//
            Route::post('faculty/store', 'FacultyController@store')->name('store-faculty');
            Route::post('faculty/update', 'FacultyController@update')->name('student-faculty');
        });
    });
});
