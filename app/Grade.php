<?php

namespace App;

use App\Model;

class Grade extends Model
{
    protected $fillable = [
        'marks',
        'gpa',
        'attendance',
        'quiz1',
        'quiz2',
        'quiz3',
        'quiz4',
        'quiz5',
        'ct1',
        'ct2',
        'ct3',
        'ct4',
        'ct5',
        'assignment1',
        'assignment2',
        'assignment3',
        'written',
        'mcq',
        'practical',
        'exam_id',
        'student_id',
        'teacher_id',
        'course_id',
        'user_id'
    ];
    /**
     * Get the course record associated with the user.
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    /**
     * Get the student record associated with the user.
     */
    public function student()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the teacher record associated with the user.
     */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the exam name record associated with the exam.
     */
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
