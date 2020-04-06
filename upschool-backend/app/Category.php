<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_course_categories', 'course_category_id', 'course_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }
}
