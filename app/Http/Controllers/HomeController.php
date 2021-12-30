<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Faculty;
use App\Classes;
use Redirect;
use Crypt;
use App\FeeHead;
use App\Payment;
use App\Jamb;
use App\Syllabus;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    if (\Auth::user()->role != 'master') {
      $minutes = 1440; // 24 hours = 1440 minutes
      $school_id = \Auth::user()->school->id;
      $classes = \Cache::remember('classes-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Myclass::bySchool($school_id)
          ->pluck('id')
          ->toArray();
      });
      $totalStudents = \Cache::remember('totalStudents-' . $school_id, $minutes, function () use ($school_id) {
        return \App\User::bySchool($school_id)
          ->where('role', 'student')
          ->where('active', 1)
          ->count();
      });
      $totalTeachers = \Cache::remember('totalTeachers-' . $school_id, $minutes, function () use ($school_id) {
        return \App\User::bySchool($school_id)
          ->where('role', 'teacher')
          ->where('active', 1)
          ->count();
      });
      $totalBooks = \Cache::remember('totalBooks-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Book::bySchool($school_id)->count();
      });
      $totalClasses = \Cache::remember('totalClasses-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Myclass::bySchool($school_id)->count();
      });
      $totalSections = \Cache::remember('totalSections-' . $school_id, $minutes, function () use ($classes) {
        return \App\Section::whereIn('class_id', $classes)->count();
      });
      $notices = \Cache::remember('notices-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Notice::bySchool($school_id)
          ->where('active', 1)
          ->get();
      });
      $events = \Cache::remember('events-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Event::bySchool($school_id)
          ->where('active', 1)
          ->get();
      });
      $routines = \Cache::remember('routines-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Routine::bySchool($school_id)
          ->where('active', 1)
          ->get();
      });
      // $syllabuses = \Cache::remember('syllabuses-' . $school_id, $minutes, function () use ($school_id) {
      //   return \App\Syllabus::bySchool($school_id)
      //     ->where('active', 1)
      //     ->get();
      // });

      $syllabuses = Syllabus::all()
        ->where('class_id', \Auth::user()->course_id)
        ->where('active', 1);


      $exams = \Cache::remember('exams-' . $school_id, $minutes, function () use ($school_id) {
        return \App\Exam::bySchool($school_id)
          ->where('active', 1)
          ->get();
      });

      $countries = Country::all();
      $states = State::all();
      $cities = City::all();
      $departments = Department::all();
      $faculties = Faculty::all();
      $classes = Classes::all();
      //$faculty = Faculty::query()->where('id', $user->faculty_id)->get()->first();
      //$department = Department::query()->where('id', $user->department_id)->get()->first();
      //$course = Classes::query()->where('id', $user->course_id)->get()->first();
      $user = User::query()->where('id', Auth::user()->id)->get()->first();
      // if(\Auth::user()->role == 'student')
      //   $messageCount = \App\Notification::where('student_id',\Auth::user()->id)->count();
      // else
      //   $messageCount = 0;

      return view('home', [
        'totalStudents' => $totalStudents,
        'totalTeachers' => $totalTeachers,
        'totalBooks' => $totalBooks,
        'totalClasses' => $totalClasses,
        'totalSections' => $totalSections,
        'notices' => $notices,
        'events' => $events,
        'routines' => $routines,
        'syllabuses' => $syllabuses,
        'exams' => $exams,
        'countries' => $countries,
        'states' => $states,
        'cities' => $cities,
        'faculties' => $faculties,
        'departments' => $departments,
        'classes' => $classes,
        'user' => $user,
        //'messageCount'=>$messageCount,
      ]);
    } else {
      return redirect('/masters');
    }
  }
}
