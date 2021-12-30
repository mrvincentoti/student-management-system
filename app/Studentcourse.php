<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentcourse extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function coursescomments()
    {
        return $this->hasMany(Coursescomment::class);
    }
}
