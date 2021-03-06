<?php

namespace App\Exports;

use App\User;
use Illuminate\Validation\Rules\In;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use Log;

class RegisteredExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $headings = [
        'Firstname',
        'Surname',
        'Othername',
        'Email',
        'Phone Number',
        'Gender',
        'Matric Number',
        'Jamb Number',
        'Faculty',
        'Department',
        'Course',
    ];
    //full name,, Gender, Jamb registration number, Matriculation Number, 
    //Department/course, Email and Phone number.

    public function __construct(int $year, $department)
    {
        $this->year = $year;
        $this->department = $department;
    }

    public function query()
    {
        return User::query()->select('users.firstname', 'users.surname', 'users.othername', 'users.email', 'users.phone_number', 'users.gender', 'users.student_code', 'users.jambregno', 'faculties.name', 'departments.department_name', 'classes.class_number')
            ->where('users.school_id', auth()->user()->school_id)
            ->where('users.role', 'student')
            ->where('users.active', 1)
            ->where('users.course_id', $this->department)
            ->join('classes', 'users.course_id', '=', 'classes.id')
            ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->join('departments', 'users.department_id', '=', 'departments.id');
    }

    public function headings(): array
    {
        return $this->headings;    //english
    }

    public function collection()
    {
        return User::all();
    }
}
