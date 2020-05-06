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

Route::post('message', 'AcademicSessionController@test');

Route::group([], function ($router) {
    Route::get('courses', 'CourseController@index');
    Route::post('courses', 'CourseController@store');
    Route::get('courses/{id}', 'CourseController@show');
    Route::get('courses-facilitators', 'CourseController@getFacilitatedCourses');
    Route::get('courses/{id}/participants', 'CourseController@indexParticipants');
    Route::get('courses-enrolled', 'CourseController@enrolledCourses');
});
Route::post('bulk/courses', 'CourseController@storeBulk');

Route::post('enroll', 'EnrollmentController@enrollCourses');
Route::post('enroll/student', 'EnrollmentController@index');

Route::post('enroll/staff', 'StaffController@enrollFacilitator');
Route::post('unenroll/staff', 'StaffController@unEnrollFacilitator');

Route::post('enroll/student-latest', 'EnrollmentController@getCurrentEnrollment');
Route::post('enroll/courses', 'EnrollmentController@getEnrolledCourses');
Route::post('add-and-drop', 'EnrollmentController@addAndDropCourses');
Route::post('pending', 'EnrollmentController@pendingCourses');
Route::patch('enroll', 'EnrollmentController@approveCourses');


Route::group([], function ($router) {
    Route::get('course-status', 'CourseStatusController@index');
    Route::post('course-status', 'CourseStatusController@store');
    Route::get('course-status/{status_id}', 'CourseStatusController@show');
    Route::post('course-status/{status_id}', 'CourseStatusController@update');
});

Route::group([], function ($router) {
    // Route::get('course-section', 'CourseSectionController@index');
    Route::post('course-section', 'CourseSectionController@store');
    Route::get('course-section/{section_id}', 'CourseSectionController@index');
    Route::post('course-section/{section_id}', 'CourseSectionController@update');
});

Route::group([], function ($router) {
    Route::get('subsection', 'SubsectionController@index');
    Route::post('subsection', 'SubsectionController@store');
    Route::get('subsection/{section_id}', 'SubsectionController@show');
    Route::post('subsection/{section_id}', 'SubsectionController@update');
});

Route::group([], function ($router) {
    Route::get('submission-list', 'SubmissionListController@index');
    Route::post('submission-list', 'SubmissionListController@store');
    Route::get('submission-list/{submission_id}', 'SubmissionListController@show');
    Route::post('submission-list/{submission_id}', 'SubmissionListController@update');

    Route::get('submissions/{submission_id}', 'SubmissionItemController@show');

    Route::post('submission-create', 'SubmissionItemController@submit');
    Route::post('submission-grade', 'SubmissionItemController@grade');

    Route::get('submission-user', 'SubmissionListController@getUserSubmission');
});

Route::group([], function ($router) {
    // Route::get('course-section', 'SubsectionController@index');
    Route::post('course-material', 'SubsectionController@store');
    // Route::get('course-material/{material_id}', 'SubsectionController@index');
    // Route::post('course-material/{material_id}', 'SubsectionController@update');
});

Route::group([], function ($router) {
    Route::get('course-ca/{course_id}', 'ContinuousAssessmentController@index');
    Route::post('course-ca', 'ContinuousAssessmentController@store');
    // Route::get('course-ca/{ca_id}', 'ContinuousAssessmentController@index');
    Route::post('course-ca/upload', 'ContinuousAssessmentController@upload_scores');
});

Route::group([], function ($router) {
    Route::get('gradelist', 'GradelistController@index');
    Route::get('gradelist/{id}', 'GradelistController@show');
    Route::post('gradelist', 'GradelistController@store');
    Route::post('gradelist-upload/{id}', 'GradelistController@upload');
    Route::delete('gradelist/{id}', 'GradelistController@destroy');
    // Route::get('course-assessment/{assessment_id}', 'ContinuousAssessmentController@index');
    // Route::post('course-assessment/upload', 'ContinuousAssessmentController@upload_scores');
});

Route::post('test', 'CurriculumItemController@test');

Route::group([], function ($router) {
    Route::get('course-assessment-student/{student_course_id}', 'GradeItemController@index');
    Route::post('course-assessment-student/{student_course_id}', 'GradeItemController@store');
});

Route::group([], function ($router) {
    Route::get('school-assessment', 'SchoolAssessmentController@index');
    Route::post('school-assessment', 'SchoolAssessmentController@store');
    Route::post('school-assessment-upload', 'SchoolAssessmentController@upload');

    Route::post('school-assessment-course', 'SchoolAssessmentController@storeCourse');
    Route::get('school-assessment-course', 'SchoolAssessmentController@getCourse');

    Route::get('school-assessment-items', 'SchoolAssessmentItemController@show');
    Route::get('school-assessment-student', 'SchoolAssessmentItemController@getStudentAssessments');
    // Route::get('course-assessment/{assessment_id}', 'ContinuousAssessmentController@index');
    // Route::post('course-assessment/upload', 'ContinuousAssessmentController@upload_scores');
});

Route::group([], function ($router) {
    Route::get('result/{student_id}', 'ResultController@studentIndex');
    Route::get('result', 'ResultController@index');
    // Route::post('courses', 'CourseController@store');
    // Route::get('courses/{id}', 'CourseController@show');
    // Route::get('courses/{id}/participants', 'CourseController@indexParticipants');
});

Route::group([], function ($router) {
    Route::get('curriculum-item', 'CurriculumItemController@index');
    Route::post('curriculum-item/{block_id}', 'CurriculumItemController@store');
    Route::get('curriculum-item/{item_id}', 'CurriculumItemController@show');
    // Route::post('curriculum-item/{item_id}', 'CurriculumItemController@update');
});

Route::group([], function ($router) {
    Route::get('curriculum', 'CurriculumController@index');
    Route::post('curriculum', 'CurriculumController@store');
    Route::get('curriculum/{curriculum_id}', 'CurriculumController@show');
    Route::post('curriculum/{curriculum_id}', 'CurriculumController@update');
});

Route::group([], function ($router) {
    Route::get('curriculum-block', 'CurriculumBlockController@index');
    Route::post('curriculum-block', 'CurriculumBlockController@store');
    Route::get('curriculum-block/{program_id}', 'CurriculumBlockController@show');
    Route::get('curriculum-block-student/{student_id}', 'CurriculumBlockController@getEnrollableItems');
    // Route::post('curriculum-block/{curriculum_id}', 'CurriculumBlockController@update');
});

Route::group([], function ($router) {
    Route::get('academic-session', 'AcademicSessionController@index');
    Route::post('academic-session', 'AcademicSessionController@store');
    Route::get('academic-session-current', 'AcademicSessionController@getCurrent');
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
    Route::delete('news/{news_id}', 'NewsController@destroy');
});

Route::group([], function ($router) {
    Route::get('event', 'EventController@index');
    Route::post('event', 'EventController@store');
    Route::get('event/{event_id}', 'EventController@show');
    Route::post('event/{event_id}', 'EventController@update');
});

Route::group([], function ($router) {
    Route::get('schedule', 'ScheduleItemController@show');
    // Route::post('event', 'EventController@store');
    // Route::get('event/{event_id}', 'EventController@show');
    // Route::post('event/{event_id}', 'EventController@update');
});

Route::group([], function ($router) {
    Route::post('user-event', 'UserEventController@getUserEvents');
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

// Route::group([], function ($router) {
//     Route::get('fee', 'FeeController@index');
//     Route::post('fee', 'FeeController@store');
//     Route::get('fee/{fee_id}', 'FeeController@show');
//     Route::post('fee/{fee_id}', 'FeeController@update');
// });

Route::group([], function ($router) {
    Route::get('student', 'StudentController@index');
    Route::post('student', 'StudentController@store');
    Route::get('student/{student_id}', 'StudentController@show');
    Route::post('student/{student_id}', 'StudentController@update');
});

Route::group([], function ($router) {
    Route::get('staff-advisees', 'StaffController@getAdvisees');
    Route::get('staff', 'StaffController@index');
    Route::post('staff', 'StaffController@store');
    Route::get('staff/{staff_id}', 'StaffController@show');
    Route::post('staff/{staff_id}', 'StaffController@update');
});

Route::post('/send', 'EmailController@send');

Route::group([], function ($router) {
    Route::get('roomtype', 'RoomTypeController@index');
    Route::post('roomtype', 'RoomTypeController@store');
    Route::get('roomtype/{roomtype_id}', 'RoomTypeController@show');
    Route::post('roomtype/{roomtype_id}', 'RoomTypeController@update');
});

Route::group([], function ($router) {
    Route::get('room', 'RoomController@index');
    Route::post('room', 'RoomController@store');
    Route::get('room/{room_id}', 'RoomController@show');
    Route::post('room/{room_id}', 'RoomController@update');
    Route::delete('room/{room_id}', 'RoomController@destroy');

    Route::post('room-bulk', 'RoomController@storeBulk');

    Route::post('room-allocation', 'StudentRoomController@store');
    Route::get('room-current', 'StudentRoomController@show');
    Route::get('room-allocation', 'StudentRoomController@index');
});

Route::group([], function ($router) {
    Route::get('hall', 'HallController@index');
    Route::post('hall', 'HallController@store');
    Route::get('hall/{hall_id}', 'HallController@show');
    Route::post('hall/{hall_id}', 'HallController@update');
    Route::delete('hall/{hall_id}', 'HallController@destroy');

    Route::post('halls-bulk', 'HallController@storeBulk');
});

Route::get('allocation-settings', 'AllocationSettingController@index');

Route::group([], function ($router) {
    Route::get('conversation', 'ConversationController@index');
    Route::post('messages', 'MessageController@store');
});
