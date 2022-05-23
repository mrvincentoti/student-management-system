<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamb extends Model
{
    //
    protected $fillable = [
        'jambregno', 'surname', 'middlename', 'firstname', 'student_id'
    ];
}
