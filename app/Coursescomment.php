<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursescomment extends Model
{
    public function studentcourses()
    {
        return $this->belongsTo(Studentcourse::class);
    }
}
