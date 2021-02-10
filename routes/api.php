<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
	Route::post('sign-in', 'AuthController@in');	
	Route::post('sign-out', 'AuthController@out');
});

Route::group(['prefix' => 'classes', 'middleware' => 'auth:api'], function() {
	Route::get('get-enrolled', 'ClassesController@getEnrolled');
	Route::get('get-class', 'ClassesController@getClass');
	Route::get('get-class-forapproval', 'ClassesController@getClassForApproval');
	Route::get('get-overview', 'ClassesController@getOverview');
	Route::get('get-announcements', 'ClassesController@getAnnouncements');
	Route::get('get-lessons', 'ClassesController@getLessons');


	Route::get('get-lesson-byid', 'ClassesController@getLessonByID');
	Route::get('get-attendance', 'ClassesController@getAttendance');
	Route::get('get-assignments', 'ClassesController@getAssignments');
	Route::get('get-assignment-byid', 'ClassesController@getAssignmentByID');
	Route::get('get-submitted_assignment-byid', 'ClassesController@getSubmittedAssignment');
	Route::get('get-projects', 'ClassesController@getProjects');
	Route::get('get-project-byid', 'ClassesController@getProjectByID');
	Route::get('get-submitted_project-byid', 'ClassesController@getSubmittedProject');
	Route::get('get-quizzes', 'ClassesController@getQuizzes');
	Route::get('get-quiz-byid', 'ClassesController@getQuizByID');
	Route::get('get-quizchoices-byid', 'ClassesController@getQuizChoicesByID');
	Route::get('get-quizresult-byid', 'ClassesController@getQuizResultByID');
	Route::get('get-exams', 'ClassesController@getExams');
	Route::get('get-exam-byid', 'ClassesController@getExamByID');
	Route::get('get-participants', 'ClassesController@getParticipants');
    Route::post('join', 'ClassesController@join');
    Route::post('attach-assignment', 'ClassesController@attachAssignment');
    Route::post('attach-project', 'ClassesController@attachProject');
    Route::post('take-quiz', 'ClassesController@takeQuiz');
    Route::post('answer-quiz', 'ClassesController@answerQuiz');
    Route::post('submit-quiz', 'ClassesController@submitQuiz');
});

Route::group(['prefix' => 'students', 'middleware' => 'auth:api'], function() {
	Route::get('get-byid', 'StudentsController@getByID');
});

Route::group(['prefix' => 'announcements', 'middleware' => 'auth:api'], function() {
	Route::get('get-announcements-byid', 'AnnouncementsController@getAnnouncementByID');
});

Route::group(['prefix' => 'comments', 'middleware' => 'auth:api'], function() {
	Route::get('get-comments-byreferenceid', 'CommentsController@getByReferenceID');
	Route::post('add', 'CommentsController@store');
	Route::post('delete', 'CommentsController@delete');
});