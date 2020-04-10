<?php

namespace App\Http\Controllers;

use App\Course;
use App\CurriculumItem;
use App\Student;
use App\Semester;
use App\Enrollment;
use App\StudentCourse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $enrollments = Enrollment::whereStudentId($request->student_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'all enrollments for this student',
            'data' => $enrollments->load('curriculum_items')
        ], 201);
    }

    public function enrollCourses(Request $request)
    {
        //
        $student = Student::find($request->student_id);
        if (!$student)
            return response()->json([
                'status' => true,
                'message' => 'No such student',
                'data' => null
            ], 201);

        $selectedCurriculumItemIds = [1];
        $selectedCurriculumItems = CurriculumItem::findMany($selectedCurriculumItemIds)->load('curriculumable');

        // $selectedCoursesIds = json_decode($request->course_ids);
        // $items = $selectedCurriculumItems->curriculumable();
        // dd($selectedCurriculumItems);

        // $selectedCourses = Course::findMany($selectedCoursesIds);
        // dd($selectedCourses);


        $enrollment = new Enrollment();
        $enrollment->student_id = $request->student_id;
        $enrollment->semester_id = $request->semester_id;
        $enrollment->approval_status = false;

        $enrollment->save();

        $enrollment->curriculum_items()->attach($selectedCurriculumItemIds);
        // $enrollment = Enrollment::find(1);
        // dd($enrollment, $student);

        foreach ($selectedCurriculumItems as $v => $curriculum_item) {
            # code...
            $student_course = new StudentCourse();
            $student_course->semester_id = Semester::latest()->first()->id;
            $student_course->student_id = $request->student_id;
            $student_course->course_id = $curriculum_item->curriculumable()->id;
            $student_course->curriculum_id = $curriculum_item->id;
            // $student_course->credit_unit = ;

            $student_course->save();
        }

        // $student->courses()->attach();

        return response()->json([
            'status' => true,
            'message' => 'successfully enrolled courses',
            'data' => $enrollment->load('curriculum_items')
        ], 201);
    }

    public function approveenrollCourses()
    {
        //

    }

    public function addOrDropCourses()
    {
        //

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Enrollment $enrollment)
    {
        //

    }

    public function getEnrolledCourses(Request $request)
    {
        //
        $enrollments = Enrollment::whereStudentId($request->student_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'all enrollments',
            'data' => $enrollments->load('curriculum_items')
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
