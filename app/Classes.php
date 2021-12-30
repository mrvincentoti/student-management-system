<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function sections()
    {
        return $this->hasMany('App\Section', 'class_id');
    }
}
