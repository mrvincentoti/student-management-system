<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::middleware(['auth', 'master'])->group(function () {
    //Route::get('/masters', 'MasterController@index')->name('masters.index');
    Route::resource('/masters', 'SchoolController')->only(['index', 'edit', 'store', 'update']);
    Route::resource('/schools', 'SchoolController')->only(['index', 'edit', 'store', 'update']);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    // Route::get('/view-attendance/section/{section_id}',function($section_id){
    //   if($section_id > 0){
    //     $attendances = App\Attendance::with(['student'])->where('section_id', $section_id)->get();
    //   }
    // });
    Route::get('attendances/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'AttendanceController@addStudentsToCourseBeforeAtt')->middleware(['teacher']);
    Route::get('attendances/{section_id}/{student_id}/{exam_id}', 'AttendanceController@index');
    Route::get('attendances/{section_id}', 'AttendanceController@sectionIndex')->middleware(['teacher']);
    Route::post('attendance/take-attendance', 'AttendanceController@store')->middleware(['teacher']);
    Route::get('attendance/adjust/{student_id}', 'AttendanceController@adjust')->middleware(['teacher']);
    Route::post('attendance/adjust', 'AttendanceController@adjustPost')->middleware(['teacher']);
});

Route::middleware(['auth', 'teacher'])->prefix('grades')->group(function () {
    Route::get('all-exams-grade', 'GradeController@allExamsGrade');
    Route::get('section/{section_id}', 'GradeController@gradesOfSection');
    Route::get('t/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@tindex')->name('teacher-grade');
    Route::get('c/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@cindex');
    Route::post('calculate-marks', 'GradeController@calculateMarks');
    Route::post('save-grade', 'GradeController@update');
    Route::post('upload-grade', 'GradeController@uploadResult');
});

Route::middleware(['auth'])->group(function () {
    Route::get('view/acceptance/{id}', 'UserController@aview')->name('view-acceptance');
    Route::get('approve/acceptance/{id}', 'UserController@aapprove')->name('approve-acceptance');
    Route::get('decline/acceptance/{id}', 'UserController@adecline')->name('decline-acceptance');
    Route::post('decline', 'UserController@declinePost')->name('decline');
    Route::get('generate-matric-number/{id}', 'UserController@generateMatric')->name('generate-matric-number');
});

Route::get('grades/{student_id}', 'GradeController@index')->middleware(['auth', 'teacher.student']);
Route::get('grades/cgpa/{student_id}', 'GradeController@cgpa')->middleware(['auth', 'teacher.student']);

Route::middleware(['auth', 'accountant'])->prefix('fees')->name('fees.')->group(function () {
    Route::get('all', 'FeeController@index');
    Route::get('create', 'FeeController@create');
    Route::post('create', 'FeeController@store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::get('gpa/create-gpa', 'GradesystemController@create');
    Route::post('create-gpa', 'GradesystemController@store');
    Route::post('gpa/delete', 'GradesystemController@destroy');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('gpa/all-gpa', 'GradesystemController@index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('students/courses', 'UserController@departmentStudents')->name('students/courses');
    Route::post('students/courses', 'UserController@departmentStudentsPost');
});

Route::middleware(['auth'])->group(function () {
    if ('production' != config('app.env')) {
        Route::get('user/config/impersonate', 'UserController@impersonateGet');
        Route::post('user/config/impersonate', 'UserController@impersonate');
    }
    Route::get('users/{school_code}/{student_code}/{teacher_code}', 'UserController@index');
    Route::get('users/{school_code}/{role}', 'UserController@indexOther');
    Route::get('user/{user_code}', 'UserController@show');
    Route::get('user/config/change_password', 'UserController@changePasswordGet');
    Route::post('user/config/change_password', 'UserController@changePasswordPost');
    Route::get('section/students/{section_id}', 'UserController@sectionStudents');

    Route::get('courses/{teacher_id}/{section_id}', 'CourseController@index');
    Route::get('student/course-registration', 'CourseController@register');
    Route::get('student/student-courses/{id}', 'StudentcourseController@myCourse');
    Route::post('/courses/get-semester-courses', 'CourseController@getSemesterCourses');
    Route::post('student/send-course-email', 'StudentcourseController@declineCourse');
    Route::post('save-student-courses', 'StudentcourseController@saveStudentCourses')->name('save-student-courses');
    Route::post('remove-student-course', 'StudentcourseController@removeCourse')->name('remove-student-course');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('course/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'CourseController@course');
    Route::post('courses/create', 'CourseController@create');
    // Route::post('courses/save-under-exam', 'CourseController@update');
    Route::post('courses/store', 'CourseController@store');
    Route::post('courses/save-configuration', 'CourseController@saveConfiguration');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('file-import-export', 'JambController@fileImportExport');
    Route::post('file-import', 'JambController@fileImport')->name('file-import');
    Route::get('file-export', 'JambController@fileExport')->name('file-export');
    Route::get('students/{school_id}/{dummy}', 'UserController@sindex')->name('s');
    Route::post('students/{school_id}/{dummy}', 'UserController@sindexPost');

    // hostel
    Route::get('hostels', 'HostelController@index');
    Route::post('hostel/create', 'HostelController@create')->name('hostel/create');
});

Route::post('exported', 'UserController@export');
Route::post('academic/syllabus/add', 'SyllabusController@add');
Route::middleware(['auth', 'admin'])->prefix('academic')->name('academic.')->group(function () {
    Route::get('syllabus', 'SyllabusController@index');
    Route::get('syllabus/{class_id}', 'SyllabusController@create');
    Route::get('notice', 'NoticeController@create');
    Route::get('event', 'EventController@create');
    Route::get('certificate', 'CertificateController@create');
    Route::get('routine', 'RoutineController@index');

    Route::get('routine/{section_id}', 'RoutineController@create');
    Route::prefix('remove')->name('remove.')->group(function () {
        Route::get('syllabus/{id}', 'SyllabusController@update');
        Route::get('notice/{id}', 'NoticeController@update');
        Route::get('event/{id}', 'EventController@update');
        Route::get('certificate/{id}', 'CertificateController@update');
        Route::get('routine/{id}', 'RoutineController@update');
    });
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('user/{id}/notifications', 'NotificationController@index');
    Route::get('academic/student/certificates', 'CertificateController@index');
});

Route::middleware(['auth', 'admin'])->prefix('exams')->name('exams.')->group(function () {
    Route::get('/', 'ExamController@index');
    Route::get('create', 'ExamController@create');
    Route::post('create', 'ExamController@store');
    Route::post('activate-exam', 'ExamController@update');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('exams/active', 'ExamController@indexActive');
    Route::get('school/sections', 'SectionController@index');
});

Route::middleware(['auth', 'librarian'])->namespace('Library')->group(function () {
    Route::prefix('library')->name('library.')->group(function () {
        Route::resource('books', 'BookController');
    });
});

Route::middleware(['auth', 'librarian'])->prefix('library')->name('library.issued-books.')->group(function () {
    Route::get('issue-books', 'IssuedbookController@create')->name('create');
    Route::post('issue-books', 'IssuedbookController@store')->name('store');
    Route::get('issued-books', 'IssuedbookController@index')->name('index');
    Route::post('save_as_returned', 'IssuedbookController@update');
});

Route::middleware(['auth', 'accountant'])->prefix('accounts')->name('accounts.')->group(function () {
    Route::get('sectors', 'AccountController@sectors')->name('sectors.index');
    Route::post('create-sector', 'AccountController@storeSector')->name('sectors.create');
    Route::get('edit-sector/{sector}', 'AccountController@editSector')->name('sectors.edit');
    Route::patch('update-sector/{sector}', 'AccountController@updateSector')->name('sectors.update');
    //Route::get('delete-sector/{sector}','AccountController@deleteSector')->name('sectors.delete');

    Route::get('income', 'AccountController@income');
    Route::post('create-income', 'AccountController@storeIncome');
    Route::get('income-list', 'AccountController@listIncome');
    Route::post('list-income', 'AccountController@postIncome');
    Route::get('edit-income/{id}', 'AccountController@editIncome');
    Route::post('update-income', 'AccountController@updateIncome');
    Route::get('delete-income/{id}', 'AccountController@deleteIncome');

    Route::get('expense', 'AccountController@expense');
    Route::post('create-expense', 'AccountController@storeExpense');
    Route::get('expense-list', 'AccountController@listExpense');
    Route::post('list-expense', 'AccountController@postExpense');
    Route::get('edit-expense/{id}', 'AccountController@editExpense');
    Route::post('update-expense', 'AccountController@updateExpense');
    Route::get('delete-expense/{id}', 'AccountController@deleteExpense');
});

Route::middleware(['auth', 'master'])->group(function () {
    Route::get('register/admin/{id}/{code}', function ($id, $code) {
        session([
            'register_role' => 'admin',
            'register_school_id' => $id,
            'register_school_code' => $code,
        ]);

        return redirect()->route('register');
    });
    Route::post('register/admin', 'UserController@storeAdmin');
    Route::get('master/activate-admin/{id}', 'UserController@activateAdmin');
    Route::get('master/deactivate-admin/{id}', 'UserController@deactivateAdmin');
    Route::get('school/admin-list/{school_id}', 'SchoolController@show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users/add-custom-users/{school_code}', 'UserController@addCustomUsers');
    Route::post('users/add-custom-user', 'UserController@addCustomUserPost');
    Route::post('users/delete-custom-user', 'UserController@deleteCustomUserPost');
    Route::prefix('school')->name('school.')->group(function () {
        Route::post('add-class', 'MyclassController@store');
        Route::post('add-section', 'SectionController@store');
        Route::post('add-department', 'SchoolController@addDepartment');
        Route::get('promote-students/{section_id}/{class_id}', 'UserController@promoteSectionStudents');
        Route::post('promote-students', 'UserController@promoteSectionStudentsPost');
        Route::post('theme', 'SchoolController@changeTheme');
        Route::post('set-ignore-sessions', 'SchoolController@setIgnoreSessions');
    });

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('student', 'UserController@redirectToRegisterStudent');
        Route::get('teacher', function () {
            $departments = \App\Department::where('school_id', \Auth::user()->school_id)->get();
            $classes = \App\Myclass::where('school_id', \Auth::user()->school->id)->pluck('id');
            $sections = \App\Section::with('class')->whereIn('class_id', $classes)->get();
            session([
                'register_role' => 'teacher',
                'departments' => $departments,
                'register_sections' => $sections,
            ]);

            return redirect()->route('register');
        });

        Route::get('accountant', function () {
            session(['register_role' => 'accountant']);

            return redirect()->route('register');
        });
        Route::get('librarian', function () {
            session(['register_role' => 'librarian']);

            return redirect()->route('register');
        });
        Route::post('student', 'UserController@store');
        Route::post('teacher', 'UserController@storeTeacher');
        Route::post('accountant', 'UserController@storeAccountant');
        Route::post('librarian', 'UserController@storeLibrarian');
    });
    Route::get('edit/course/{id}', 'CourseController@edit');
    Route::post('edit/course/{id}', 'CourseController@updateNameAndTime');
});

//use PDF;
Route::middleware(['auth', 'master.admin'])->group(function () {
    Route::get('edit/user/{id}', 'UserController@edit');
    Route::post('edit/user', 'UserController@update');
    Route::post('upload/file', 'UploadController@upload');
    Route::post('users/import/user-xlsx', 'UploadController@import');
    Route::get('users/export/students-xlsx', 'UploadController@export');
    Route::get('users/export/registered-xlsx', 'UploadController@exportregistered');
    //   Route::get('pdf/profile/{user_id}',function($user_id){
    //     $data = App\User::find($user_id);
    //     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
    //     $pdf = PDF::loadView('pdf.profile-pdf', ['user' => $data]);
    // 		return $pdf->stream('profile.pdf');
    //   });
    //   Route::get('pdf/result/{user_id}/{exam_id}',function($user_id, $exam_id){
    //     $data = App\User::find($user_id);
    //     $grades = App\Grade::with('exam')->where('student_id', $user_id)->where('exam_id',$exam_id)->latest()->get();
    //     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
    //     $pdf = PDF::loadView('pdf.result-pdf', ['grades' => $grades, 'user'=>$data]);
    // 		return $pdf->stream('result.pdf');
    //   });
});
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::post('calculate-marks', 'GradeController@calculateMarks');
    Route::post('message/students', 'NotificationController@store');
});
// Route::middleware(['auth'])->group(function (){
//   Route::get('download/pdf', function(){
//     $pathToFile = public_path('storage/Bano-EducationandAspiration.pdf');
//     return response()->download($pathToFile);
//   });
// });

// View Emails - in browser
Route::prefix('emails')->group(function () {
    // Welcome Email
    Route::get('/welcome', function () {
        $user = App\User::find(1);
        $password = 'ABCXYZ';

        return new App\Mail\SendWelcomeEmailToUser($user, $password);
    });
});

Route::middleware(['auth', 'student'])->prefix('stripe')->group(function () {
    Route::get('charge', 'CashierController@index');
    Route::post('charge', 'CashierController@store');
    Route::get('receipts', 'PaymentController@index');
});

// Applicant route
Route::get('/fill-acceptance-form', 'UserController@acceptanceFormGet')->name('fill-acceptance-form');
Route::post('/acceptance-form', 'UserController@acceptanceFormPost')->name('acceptance-form');
Route::get('/acceptance-success/{id}', 'UserController@acceptanceSuccess')->name('acceptance-success');

Route::get('/update-details/{id}', 'UserController@updateDetails')->name('update-details');
Route::post('/update-details-post', 'UserController@updateDetailsPost')->name('update-details-post');

Route::get('/update-matriculation-number', 'UserController@updateMatricNumber')->name('update-matriculation-number');
Route::get('/students-in-department/{id}', 'UserController@studentInDepartment')->name('students-in-department');

Route::get('/student-verification', 'UserController@studentVerificationGet')->name('student-verification');
Route::post('/student-verification-post', 'UserController@studentVerificationPost')->name('student-verification-post');
Route::get('/update-applicant/{id}', 'UserController@updateApplicantGet')->name('update-applicant');
Route::post('/applicantion-summary', 'UserController@updateApplicantPost')->name('applicantion-summary');
Route::get('/application-summary-payment/{id}/{pid}', 'UserController@applicationSummary')->name('application-summary-payment');
Route::post('/applicant', 'UserController@storeApplicant')->name('applicant');
Route::post('/storestudent', 'UserController@storeStud')->name('storestudent');
Route::post('/pay', 'UserController@initializePayment')->name('pay');
Route::post('/payment/callback', 'UserController@paymentVerification')->name('payment-verification');
Route::get('/payment-success/{id}', 'UserController@paymentSuccess')->name('payment-success');
Route::get('/get-state/{id}', 'UserController@getState')->name('get-state');
Route::get('/get-city/{id}', 'UserController@getCity')->name('get-city');
Route::get('/departments/{id}', 'UserController@getDepartment')->name('departments');
Route::get('/programmes/{id}', 'UserController@getProgrammes')->name('programmes');
Route::get('/programmes-duration/{id}', 'UserController@getDuration')->name('programmes-duration');
Route::get('/teaching/{id}', 'SettingController@departmentTeachers')->name('teaching');

Route::post('/student/save-code', 'UserController@saveCodePost')->name('save-code');
