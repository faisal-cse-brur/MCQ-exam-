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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/routine', 'UserController@routine')->name('routine');
Route::get('/pdfroutine', 'UserController@pdfroutine')->name('pdfroutine');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/addSubject', 'AdminController@addSubject')->name('addSubject');
Route::post('/storeSubject', 'AdminController@storeSubject')->name('storeSubject');
Route::get('/showSubject', 'AdminController@showSubject')->name('showSubject');


Route::get('/editSubject/{id}', 'AdminController@editSubject')->name('editSubject');
Route::post('/updateSubject/{id}', 'AdminController@updateSubject')->name('updateSubject');

Route::delete('/deleteSubject/{id}', 'AdminController@deleteSubject')->name('deleteSubject');

Route::get('/addExam', 'AdminController@addExam')->name('addExam');
Route::post('/storeExam', 'AdminController@storeExam')->name('storeExam');
Route::get('/showExam', 'AdminController@showExam')->name('showExam');
// Edit baki
Route::post('/deleteExam/{id}', 'AdminController@deleteExam')->name('deleteExam');



// Q&A Route
Route::get('/addQuestion', 'AdminController@addQuestion')->name('addQuestion');
Route::post('/storeQuestion', 'AdminController@storeQuestion')->name('storeQuestion');
Route::get('/showQuestion', 'AdminController@showQuestion')->name('showQuestion');

Route::get('/getQuestionDetails', 'AdminController@getQuestionDetails')->name('getQuestionDetails');

Route::post('/updateQnA', 'AdminController@updateQnA')->name('updateQnA');
Route::get('/deleteAnswer', 'AdminController@deleteAnswer')->name('deleteAnswer');

Route::post('/deleteQna/{id}', 'AdminController@deleteQna')->name('deleteQna');
Route::post('/importQna', 'AdminController@importQna')->name('importQna');
//Marks
Route::get('/marks', 'AdminController@viewmarks')->name('marks');
Route::get('/loadmarks', 'AdminController@loadmarks')->name('loadmarks');
Route::get('/editMarks/{id}', 'AdminController@editMarks')->name('editMarks');
Route::post('/updateMarks/{id}', 'AdminController@updateMarks')->name('updateMarks');
//Exam Review
Route::get('/examreview', 'AdminController@examReview')->name('examReview');
Route::get('/showreviewexam', 'AdminController@showreviewexam')->name('showreviewexam');
Route::get('/reviewqna/{id}', 'AdminController@reviewqna')->name('reviewqna');
Route::post('/approve-qna', 'AdminController@approvedQna')->name('approveQna');


// STUDENT DESHBORD
Route::get('/admin/student', 'AdminController@StudentIndex')->name('StudentIndex');
Route::get('/admin/student/show', 'AdminController@studentsDeshbord')->name('AdminStudent');
Route::post('/admin/addStudent', 'AdminController@addStudent')->name('addStudent');

Route::get('/admin/get-questions', 'AdminController@getQuestions')->name('getQuestions');

Route::post('/admin/add-questions', 'AdminController@addQuestions')->name('addQuestions');
Route::get('/admin/get-exam-questions', 'AdminController@getExamQuestions')->name('getExamQuestions');
Route::get('/admin/delete-exam-questions', 'AdminController@deleteExamQuestions')->name('deleteExamQuestions');


// USER PART

Route::get('/user', 'UserController@index')->name('user');
Route::get('/student-exam', 'UserController@StudentExam')->name('StudentExam');

Route::get('/subject', 'UserController@subject')->name('subject');
Route::get('/all-subject', 'UserController@AllSubject')->name('AllSubject');

Route::get('/chepter', 'UserController@chepter')->name('chepter');
Route::get('/show-chepter', 'UserController@showchepter')->name('showchepter');
Route::get('/exam/{id}', 'UserController@examDeshbord')->name('examDeshbord');
Route::post('/exam-submit', 'UserController@examSubmit')->name('examSubmit');

