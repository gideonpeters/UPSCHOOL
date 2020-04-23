<?php

namespace App;

use App\Staff;
use App\Student;
use App\Category;
use App\Gradelist;
use App\CourseStatus;
use App\Prerequisite;
use App\SemesterType;
use App\CourseSection;
use App\CurriculumItem;
use App\SchoolAssessment;
use App\ContinuousAssessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Course extends Model
{
    //
    protected $with = ['semester_type',];

    public function semester_type()
    {
        return $this->belongsTo(SemesterType::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Student::class, 'student_courses')->using(StudentCourse::class);
    }

    public function curriculum_items()
    {
        return $this->morphMany(CurriculumItem::class, 'curriculumable');
    }

    public function facilitators()
    {
        return $this->belongsToMany(Staff::class, 'course_staff', 'course_id', 'staff_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'courses_course_categories', 'course_id', 'course_category_id');
    }

    public function gradelists()
    {
        return $this->hasMany(Gradelist::class);
    }

    public function school_assessments()
    {
        return $this->hasMany(SchoolAssessment::class);
    }

    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'prerequisite_course', 'course_id', 'prerequisite_id');
    }

    public function prerequisite_to_courses()
    {
        return $this->belongsToMany(Course::class, 'prerequisite_course', 'prerequisite_id', 'course_id',);
    }

    public function continuous_assessments()
    {
        return $this->hasMany(
            ContinuousAssessment::whereCourseId($this->id)
                ->whereContinuousAssessmentId(null)
                ->whereStudentCourseId(null)
                ->whereWeightedScore(null)
        );
    }

    // public function curriculum_items()
    // {
    //     return $this->belongsToMany(CurriculumItem::class, 'courses_curriculum_items', 'course_id', 'curriculum_item_id');
    // }
}
