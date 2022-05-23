<?php

namespace App\Imports;

use App\Grade;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class GradesImport implements ToModel, WithStartRow
{
    use Importable;


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $grade = Grade::updateOrCreate(
            [
                'course_id' => Session::get('course_id'),
                'student_id' => $this->getStudentByMatricNumber($row[1]),
                'exam_id' => Session::get('exam_id')
            ],
            [
                'marks' => 0.00,
                'gpa' => 0.00,
                'attendance' => 0.00,
                'quiz1' => 0.00,
                'quiz2' => 0.00,
                'quiz3' => 0.00,
                'quiz4' => 0.00,
                'quiz5' => 0.00,
                'ct1' => $row[2],
                'ct2' => 0.00,
                'ct3' => 0.00,
                'ct4' => 0.00,
                'ct5' => 0.00,
                'assignment1' => 0.00,
                'assignment2' => 0.00,
                'assignment3' => 0.00,
                'written' => $row[3],
                'mcq' => 0.00,
                'practical' => 0.00,
                'exam_id' => Session::get('exam_id'),
                'student_id' => $this->getStudentByMatricNumber($row[1]), // get student ID
                'teacher_id' => Session::get('teacher_id'),
                'course_id' => Session::get('course_id'),
                'user_id' => Auth::user()->id,
            ]
        );

        return $grade;
    }

    public function getStudentByMatricNumber($matricnumber)
    {
        $student = User::where('student_code', $matricnumber)->get()->first();
        return $student->id;
    }

    public function startRow(): int
    {
        return 2;
    }
}
