<?php

namespace App\Observers;

use App\Semester;
use App\GradeItem;
use App\Gradelist;
use App\StudentCourse;

class GradelistObserver
{

    public function created(Gradelist $gradelist)
    {
        //
        $currentSemester = Semester::latest()->first();

        $student_courses = StudentCourse::whereCourseId($gradelist->course_id)->whereSemesterId($currentSemester->id)->get();

        foreach ($student_courses as $key => $student_course) {
            # code...
            $grade_item = new GradeItem();
            $grade_item->gradelist_id = $gradelist->id;
            $grade_item->score = null;
            $grade_item->student_course_id = $student_course->id;
            $grade_item->save();
        }
    }

    /**
     * Handle the gradelist "updated" event.
     *
     * @param  \App\Gradelist  $gradelist
     * @return void
     */
    public function updated(Gradelist $gradelist)
    {
        //
    }

    /**
     * Handle the gradelist "deleted" event.
     *
     * @param  \App\Gradelist  $gradelist
     * @return void
     */
    public function deleted(Gradelist $gradelist)
    {
        //
        $currentSemester = Semester::latest()->first();

        $student_courses = StudentCourse::whereCourseId($gradelist->course_id)->whereSemesterId($currentSemester->id)->get();

        foreach ($student_courses as $key => $student_course) {
            # code...
            $grade_item = GradeItem::whereStudentCourseId($student_course->id)->first();
            $grade_item->delete();
        }
    }

    /**
     * Handle the gradelist "restored" event.
     *
     * @param  \App\Gradelist  $gradelist
     * @return void
     */
    public function restored(Gradelist $gradelist)
    {
        //
    }

    /**
     * Handle the gradelist "force deleted" event.
     *
     * @param  \App\Gradelist  $gradelist
     * @return void
     */
    public function forceDeleted(Gradelist $gradelist)
    {
        //
    }
}
