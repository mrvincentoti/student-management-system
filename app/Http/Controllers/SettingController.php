<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Myclass;
use App\Section;
use App\Department;
use App\Faculty;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $school      = \Auth::user()->school;
        $classes     = Myclass::all();
        $sections    = Section::all();
        $faculty = Faculty::all()->where('school_id', \Auth::user()->school_id);
        $departments = Department::bySchool(\Auth::user()->school_id)->get();
        $teachers = User::select('departments.*', 'users.*')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->where('role', 'teacher')
            ->orderBy('name', 'ASC')
            ->where('active', 1)
            ->get();
        return view('settings.index', compact('school', 'classes', 'sections', 'departments', 'teachers', 'faculty'));
    }

    public function departmentTeachers($department)
    {
        $teachers['data'] = User::select('departments.*', 'users.*')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->where('role', 'teacher')
            ->where('department_id', $department)
            ->where('users.school_id', \Auth::user()->school_id)
            ->orderBy('name', 'ASC')
            ->where('active', 1)
            ->get();
        return response()->json($teachers);
    }
}
