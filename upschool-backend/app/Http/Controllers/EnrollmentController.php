<?php

namespace App\Http\Controllers;

use App\Course;
use App\Program;
use App\Student;
use App\Semester;
use App\Enrollment;
use App\PendingCourse;
use App\StudentCourse;
use App\CurriculumItem;
use App\CurriculumBlock;
use App\ResultItem;
use App\StudentEnrollmentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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
        $student = Student::whereMatricNumber($request->student_id)->first();

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student does not exist',
                'data' => null
            ], 201);
        }

        $enrollments = Enrollment::whereStudentId($student->id)->get();

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

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'No such student',
                'data' => null
            ], 201);
        }

        $selectedCurriculumItemIds = json_decode($request->ids, true);
        $selectedCurriculumItems = CurriculumItem::findMany($selectedCurriculumItemIds)->load('curriculumable');

        $currentSemester = Semester::latest()->first();
        $existingEnrollment = Enrollment::whereStudentId($student->id)->whereSemesterId($currentSemester->id)->first();

        if (!$existingEnrollment) {
            $enrollment = new Enrollment();
            $enrollment->student_id = $student->id;
            $enrollment->semester_id = $currentSemester->id;
            $enrollment->approval_status = false;

            $enrollment->save();
        } else {
            if ($existingEnrollment->approval_status) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your courses have already been approved, you can\'t enroll again',
                    'data' => null
                ], 201);
            }
            $enrollment = $existingEnrollment;
        }

        $enrollment->curriculum_items()->sync($selectedCurriculumItemIds);

        foreach ($selectedCurriculumItems as $v => $curriculum_item) {
            # code...
            // $existing_student_course = StudentCourse::whereStudentId($request->student_id)->whereCourseId($curriculum_item->curriculumable()->id)->where('status', '!=',)->first();
            $existing_student_enrollment_item = StudentEnrollmentItem::whereStudentId($request->student_id)->whereCurriculumItemId($curriculum_item->id)->first();

            if (!$existing_student_enrollment_item) {
                $student_enrollment_item = new StudentEnrollmentItem();
                $student_enrollment_item->student_id = $request->student_id;
                $student_enrollment_item->curriculum_item_id = $curriculum_item->id;
            } else {
                $student_enrollment_item = $existing_student_enrollment_item;
            }

            $student_enrollment_item->status = 'ongoing';
            $student_enrollment_item->save();

            $student_course = new StudentCourse();
            $student_course->student_id = $request->student_id;
            $student_course->course_id = $curriculum_item->curriculumable->id;
            $student_course->curriculum_item_id = $curriculum_item->id;
            $student_course->semester_id = $currentSemester->id;

            $student_course->save();
        }

        $unselected = CurriculumItem::whereNotIn('id', $selectedCurriculumItemIds)->get();
        $unselected = $unselected->filter(function ($value, $key) use ($student) {
            return $value->curriculum_block->level == $student->level;
        });

        foreach ($unselected as $key => $curriculum_item) {
            # code...
            $student_enrollment_item = new StudentEnrollmentItem();
            $student_enrollment_item->student_id = $request->student_id;
            $student_enrollment_item->curriculum_item_id = $curriculum_item->id;

            $student_enrollment_item->status = 'pending';
            $student_enrollment_item->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'successfully enrolled courses and unselected courses are now pending',
            'data' => $enrollment->load('curriculum_items')
        ], 201);
    }

    public function approveCourses(Request $request)
    {
        //
        $enrollment = Enrollment::find($request->enrollment_id);

        if (!$enrollment) {
            return response()->json([
                'status' => false,
                'message' => 'enrollment does not exist',
                'data' => null
            ], 201);
        }

        $enrollment->approval_status = true;
        $enrollment->save();

        return response()->json([
            'status' => true,
            'message' => 'enrollment approved successfully',
        ], 201);
    }

    public function addAndDropCourses(Request $request)
    {
        //
        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'No such student',
                'data' => null
            ], 201);
        }

        $selectedCurriculumItemIds = json_decode($request->ids, true);
        $selectedCurriculumItems = CurriculumItem::findMany($selectedCurriculumItemIds)->load('curriculumable');

        $currentSemester = Semester::latest()->first();
        $existingEnrollment = Enrollment::whereStudentId($student->id)->whereSemesterId($currentSemester->id)->first();

        if (!$existingEnrollment) {
            return response()->json([
                'status' => false,
                'message' => 'You have to have enrolled before adding or dropping a course',
                'data' => null
            ], 201);
        }

        foreach ($selectedCurriculumItems as $key => $curriculum_item) {
            # code...
            $student_enrollment_item = StudentEnrollmentItem::whereStudentId($student->id)->whereCurriculumItemId($curriculum_item->id)->first();

            if ($student_enrollment_item) {
                if ($student_enrollment_item->status == 'failed' || $student_enrollment_item->status == 'pending') {
                    $student_course = new StudentCourse();
                    $student_course->student_id = $student->id;
                    $student_course->course_id = $curriculum_item->curriculumable->id;
                    $student_course->curriculum_item_id = $curriculum_item->id;
                    $student_course->semester_id = $currentSemester->id;

                    $student_course->save();
                }

                $student_enrollment_item->status = 'ongoing';
                $student_enrollment_item->save();
            }
        }

        $former_items = $existingEnrollment->curriculum_items();

        $unselected = $former_items->whereNotIn('curriculum_item_id', $selectedCurriculumItemIds)->get();
        // dd($unselected);

        foreach ($unselected as $key => $curriculum_item) {
            # code...
            $student_enrollment_item = StudentEnrollmentItem::whereStudentId($student->id)->whereCurriculumItemId($curriculum_item->id)->first();

            if ($student_enrollment_item) {
                $student_course  = StudentCourse::whereStudentId($student->id)->whereCourseId($curriculum_item->curriculumable->id)->whereSemesterId($currentSemester->id)->first();
                if ($student_course) {
                    $student_course->delete();
                }
                $student_enrollment_item->status = 'dropped';
                $student_enrollment_item->save();
            }
        }

        $existingEnrollment->curriculum_items()->sync($selectedCurriculumItemIds);

        return response()->json([
            'status' => true,
            'message' => 'Add and drop performed successfully',
            'data' => []
        ], 201);
    }

    public function pendingCourses(Request $request)
    {
        //
        $student = Student::find(1);
        $program = Program::find(1);
        // $courses = StudentCourse::whereStudentId($student->id)->get();
        // $courses->load('result_item');
        // $level = 100;
        // $arr = array();

        // $curriculum_blocks = CurriculumBlock::whereProgramId($program->id)->where('level', '<=', $level)->get();
        // $curriculum_blocks->load('curriculum_items');
        // // $rea = array_merge($curriculum_blocks->curriculum_items());
        // $res = array();
        // foreach ($curriculum_blocks->load('curriculum_items') as $key => $item) {
        //     # code...
        //     // array_merge($item->curriculum_items);
        //     if (count($item->curriculum_items) > 0)
        //         array_push($res, $item->curriculum_items);
        // }
        // $roo = array();
        // for ($i = 0; $i < count($res); $i++) {
        //     foreach ($res[$i] as $j => $item) {
        //         # code...
        //         array_push($roo, $item);
        //     }
        // }

        // // $results = 
        // $result_items = $student->result_items;


        // foreach ($roo as $key => $item_r) {
        //     $isPassed = false;
        //     $isEnrolled = false;
        //     // $result_items->filter(function ($item) {
        //     // $grade_pass = GradeScore::whereName($item->grade_score)->first()->is_pass_grade;
        //     //     return $item->student_course->id == '1';
        //     // });
        //     # code...
        //     // $student_course = StudentCourse::whereStudentId()->whereCourseId()->get();

        // }


        // foreach ($courses as $key => $course) {
        //     # code...
        //     $status = $course->result_item->status;
        // }
        // $program = Program::find(1);
        // $program->load('curriculum_blocks');
        // $enrollments = Enrollment::whereStudentId(1)->first();
        // // if (!$enrollments) $enrollments = [];
        // $blocks = $program->curriculum_blocks->load('curriculum_items');

        // $arr = array();
        // foreach ($blocks as $key => $block) {
        //     # code...


        // }

        // $student->courses();

        $selectedCurriculumItemIds = json_decode($request->ids, true);
        $selectedCurriculumItems = CurriculumItem::findMany($selectedCurriculumItemIds)->load('curriculumable');

        // $selectedCurriculumItemIds = trim($selectedCurriculumItemIds);
        $unselected = CurriculumItem::whereNotIn('id', $selectedCurriculumItemIds)->get();
        $unselected = $unselected->filter(function ($value, $key) use ($student) {
            return $value->curriculum_block->level == $student->level;
        });
        // $unselected = collect($unselected)->all();

        return response()->json([
            // 'status' => true,
            // 'message' => 'successfully enrolled courses',
            // 'courses' => $student->load('courses'),
            'data' => $unselected,
        ], 201);
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
        $student = Student::whereMatricNumber($request->student_id)->first();

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student does not exist',
                'data' => null
            ], 201);
        }

        $enrollments = Enrollment::whereStudentId($student->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'all enrolled courses',
            'data' => $enrollments->load('curriculum_items')
        ], 201);
    }

    public function getCurrentEnrollment(Request $request)
    {

        $student = Student::whereMatricNumber($request->student_id)->first();

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student does not exist',
                'data' => null
            ], 201);
        }

        $enrollment = Enrollment::whereStudentId($student->id)->whereSemesterId($request->semester_id)->first();

        if (!$enrollment) {
            return response()->json([
                'status' => false,
                'message' => 'Student has not yet enrolled for this semester',
                'data' => null
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'this is the student current enrollment',
            'data' => $enrollment->load('curriculum_items')
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
