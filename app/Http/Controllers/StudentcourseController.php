<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studentcourse;
use Illuminate\Support\Facades\Auth;
use Log;
use Exception;
use App\User;
use App\Jobs\SendCourseRegistrationNotification;

class StudentcourseController extends Controller
{
  public function saveStudentCourses(Request $request)
  {
    foreach ($request->courses as $course) {
      try {
        $studentcourse = new Studentcourse;
        $studentcourse->user_id = \Auth::user()->id;
        $studentcourse->course_id = $course;
        $studentcourse->level = \Auth::user()->level;
        $studentcourse->save();
      } catch (\Illuminate\Database\QueryException $ex) {
        $ex->getMessage();
      }
    }
    return redirect()->back();
  }

  public function removeCourse(Request $request)
  {
    $id = $request->id;
    $studentcourse = Studentcourse::find($id);
    $studentcourse->delete();
    return redirect()->back();
  }

  public function myCourse($id)
  {
    $user = User::select(
      "users.id as id",
      "users.student_code",
      "users.course_id as course_id",
      "users.level as level",
      "users.session",
      "users.surname",
      "users.firstname",
      "users.othername",
      "users.email",
      "faculties.name as faculty",
      "departments.department_name as department",
      "classes.class_number as course"
    )
      ->join("faculties", "faculties.id", "=", "users.faculty_id")
      ->join("departments", "departments.id", "=", "users.department_id")
      ->join("classes", "classes.id", "=", "users.course_id")
      ->where('users.id', $id)
      ->get()
      ->first();

    $fs = Studentcourse::select(
      "studentcourses.id as sid",
      "studentcourses.status as status",
      "courses.course_code as course_code",
      "courses.credit_unit as credit_unit",
      "courses.course_name as course_name",
      "courses.course_type as course_type",
      "sections.section_number as semester",
      "users.name as lecturer",
      // "classes.class_number",
      // "departments.department_name",
      // "faculties.name",
    )
      ->join("courses", "courses.id", "=", "studentcourses.course_id")
      // ->join("classes", "classes.id", "=", "courses.class_id")
      // ->join("departments", "departments.id", "=", "classes.department_id")
      // ->join("faculties", "faculties.id", "=", "departments.faculty_id")
      ->join("sections", "sections.id", "=", "courses.section_id")
      ->join("users", "users.id", "=", "courses.teacher_id")
      ->where('courses.class_id', $user->course_id)
      ->where('courses.level', $user->level)
      ->where('studentcourses.user_id', $user->id)
      ->where(strtolower('sections.section_number'), strtolower('First Semester'))
      ->orderBy('sections.id', 'ASC')
      ->get();


    $ss = Studentcourse::select(
      "studentcourses.id as sid",
      "studentcourses.status as status",
      "courses.course_code as course_code",
      "courses.credit_unit as credit_unit",
      "courses.course_name as course_name",
      "courses.course_type as course_type",
      "sections.section_number as semester",
      "users.name as lecturer",
      // "classes.class_number",
      // "departments.department_name",
      // "faculties.name",
    )
      ->join("courses", "courses.id", "=", "studentcourses.course_id")
      // ->join("classes", "classes.id", "=", "courses.class_id")
      // ->join("departments", "departments.id", "=", "classes.department_id")
      // ->join("faculties", "faculties.id", "=", "departments.faculty_id")
      ->join("sections", "sections.id", "=", "courses.section_id")
      ->join("users", "users.id", "=", "courses.teacher_id")
      ->where('courses.class_id', $user->course_id)
      ->where('courses.level', $user->level)
      ->where('studentcourses.user_id', $user->id)
      ->where(strtolower('sections.section_number'), strtolower('Second Semester'))
      ->orderBy('sections.id', 'ASC')
      ->get();

    return view(
      'course.student-courses',
      [
        'firstsemesters' => $fs,
        'secondsemesters' => $ss,
        'creditunitfs' => $fs->sum('credit_unit'),
        'creditunitss' => $ss->sum('credit_unit'),
        'user' => $user
      ]
    );
  }

  public function declineCourse(Request $request)
  {
    if (empty($request->title) || empty($request->reason)) {
      $details = [
        "email" => $request->demail,
        "title" => "Course Approved",
        "reason" => "Your courses have been approved"
      ];
      try {
        Studentcourse::whereIn('id', $request->courseid)->update(['status' => 2, 'approved_by' => \Auth::user()->name]);
      } catch (\Exception $e) {
      }
    } else {
      $details = [
        "email" => $request->demail,
        "title" => $request->title,
        "reason" => $request->reason
      ];
      try {
        Studentcourse::whereIn('id', $request->courseid)->update(['status' => 3, 'approved_by' => \Auth::user()->name]);
      } catch (\Exception $e) {
      }
    }
    try {
      dispatch(new SendCourseRegistrationNotification($details));
    } catch (\Exception $e) {
    }
    return redirect()->route('students/courses');
  }

  public static function checkCourseRegistration($student_id, $level)
  {
    return Studentcourse::query()->where('status', 2)
      ->where('level', $level)
      ->where('user_id', $student_id)->count();
  }

  public static function doesStudentHaveCourse($student_id, $level)
  {
    return Studentcourse::query()->where('user_id', $student_id)->where('level', $level)->count();
  }

  public static function isRegistrationApproved($student_id, $level)
  {
    return Studentcourse::query()
      ->where('user_id', $student_id)
      ->where('level', $level)
      ->where('status', 1)
      ->orWhere('status', 3)
      ->count();
  }

  public static function approvingOfficer($student_id, $level)
  {
    $officer = Studentcourse::query()
      ->where('user_id', $student_id)
      ->where('level', $level)
      ->first();
    return $officer->approved_by;
  }

  public static function approvingDate($student_id, $level)
  {
    $officer = Studentcourse::query()
      ->where('user_id', $student_id)
      ->where('level', $level)
      ->first();
    return $officer->created_at;
  }
}
