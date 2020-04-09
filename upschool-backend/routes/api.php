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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AccountController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([], function ($router) {
    Route::get('courses', 'CourseController@index');
    Route::post('courses', 'CourseController@store');
    Route::get('courses/{id}', 'CourseController@show');
    Route::get('courses/{id}/participants', 'CourseController@indexParticipants');
});

Route::post('enroll', 'EnrollmentController@enrollCourses');
Route::get('enroll', 'EnrollmentController@index');

Route::group([], function ($router) {
    Route::get('course-status', 'CourseStatusController@index');
    Route::post('course-status', 'CourseStatusController@store');
    Route::get('course-status/{status_id}', 'CourseStatusController@show');
    Route::post('course-status/{status_id}', 'CourseStatusController@update');
});

Route::group([], function ($router) {
    Route::get('curriculum-item', 'CurriculumItemController@index');
    Route::post('curriculum-item', 'CurriculumItemController@store');
    Route::get('curriculum-item/{item_id}', 'CurriculumItemController@show');
    Route::post('curriculum-item/{item_id}', 'CurriculumItemController@update');
});

Route::group([], function ($router) {
    Route::get('curriculum', 'CurriculumController@index');
    Route::post('curriculum', 'CurriculumController@store');
    Route::get('curriculum/{curriculum_id}', 'CurriculumController@show');
    Route::post('curriculum/{curriculum_id}', 'CurriculumController@update');
});

Route::group([], function ($router) {
    Route::get('academic-session', 'AcademicSessionController@index');
    Route::post('academic-session', 'AcademicSessionController@store');
    Route::get('academic-session/{session_id}', 'AcademicSessionController@show');
    Route::post('academic-session/{session_id}', 'AcademicSessionController@update');
});

Route::group([], function ($router) {
    Route::get('semester-type', 'SemesterTypeController@index');
    Route::post('semester-type', 'SemesterTypeController@store');
    Route::get('semester-type/{type_id}', 'SemesterTypeController@show');
    Route::post('semester-type/{type_id}', 'SemesterTypeController@update');
});

Route::group([], function ($router) {
    Route::get('semester', 'SemesterController@index');
    Route::post('semester', 'SemesterController@store');
    Route::get('semester/{semester_id}', 'SemesterController@show');
    Route::post('semester/{semester_id}', 'SemesterController@update');
});

Route::group([], function ($router) {
    Route::get('department', 'DepartmentController@index');
    Route::post('department', 'DepartmentController@store');
    Route::get('department/{department_id}', 'DepartmentController@show');
    Route::post('department/{department_id}', 'DepartmentController@update');
});

Route::group([], function ($router) {
    Route::get('college', 'CollegeController@index');
    Route::post('college', 'CollegeController@store');
    Route::get('college/{college_id}', 'CollegeController@show');
    Route::post('college/{college_id}', 'CollegeController@update');
});

Route::group([], function ($router) {
    Route::get('school', 'SchoolController@index');
    Route::post('school', 'SchoolController@store');
    Route::get('school/{school_id}', 'SchoolController@show');
    Route::post('school/{school_id}', 'SchoolController@update');
});

Route::group([], function ($router) {
    Route::get('program', 'ProgramController@index');
    Route::post('program', 'ProgramController@store');
    Route::get('program/{program_id}', 'ProgramController@show');
    Route::post('program/{program_id}', 'ProgramController@update');
});

Route::group([], function ($router) {
    Route::get('degree', 'DegreeController@index');
    Route::post('degree', 'DegreeController@store');
    Route::get('degree/{degree_id}', 'DegreeController@show');
    Route::post('degree/{degree_id}', 'DegreeController@update');
});

Route::group([], function ($router) {
    Route::get('news', 'NewsController@index');
    Route::post('news', 'NewsController@store');
    Route::get('news/{news_id}', 'NewsController@show');
    Route::post('news/{news_id}', 'NewsController@update');
});

Route::group([], function ($router) {
    Route::get('event', 'EventController@index');
    Route::post('event', 'EventController@store');
    Route::get('event/{event_id}', 'EventController@show');
    Route::post('event/{event_id}', 'EventController@update');
});

Route::group([], function ($router) {
    Route::get('school-event', 'SchoolEventController@index');
    Route::post('school-event', 'SchoolEventController@store');
    Route::get('school-event/{event_id}', 'SchoolEventController@show');
    Route::post('school-event/{event_id}', 'SchoolEventController@update');
});

Route::group([], function ($router) {
    Route::get('attendance', 'AttendanceController@index');
    Route::post('attendance', 'AttendanceController@store');
    Route::get('attendance/{attendance_id}', 'AttendanceController@show');
    Route::post('attendance/{attendance_id}', 'AttendanceController@update');
});

Route::group([], function ($router) {
    Route::get('fee', 'FeeController@index');
    Route::post('fee', 'FeeController@store');
    Route::get('fee/{fee_id}', 'FeeController@show');
    Route::post('fee/{fee_id}', 'FeeController@update');
});

Route::group([], function ($router) {
    Route::get('student', 'StudentController@index');
    Route::post('student', 'StudentController@store');
    Route::get('student/{student_id}', 'StudentController@show');
    Route::post('student/{student_id}', 'StudentController@update');
});

Route::group([], function ($router) {
    Route::get('staff', 'StaffController@index');
    Route::post('staff', 'StaffController@store');
    Route::get('staff/{staff_id}', 'StaffController@show');
    Route::post('staff/{staff_id}', 'StaffController@update');
});
