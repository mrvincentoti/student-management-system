<?php

namespace App\Http\Controllers;

use App\Department;
use App\Myclass;
use App\Section;
use App\StudentInfo;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Faculty;
use App\codecm;
use App\codefs;
use App\Codede;
use App\Classes;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ImpersonateUserRequest;
use App\Http\Requests\User\CreateLibrarianRequest;
use App\Http\Requests\User\CreateAccountantRequest;
use App\Events\UserRegistered;
use App\Events\UserDecline;
use App\Events\StudentInfoUpdateRequested;
use Illuminate\Support\Facades\Log;
use App\Services\User\UserService;
use Redirect;
use Crypt;
use App\FeeHead;
use App\Payment;
use App\Lib\Paystack;
use App\Jamb;
use App\Mail\RejectAcceptance;
use Illuminate\Support\Facades\Mail;

use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\RegisteredExport;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    protected $userService;
    protected $user;

    public function __construct(UserService $userService, User $user)
    {
        $this->userService = $userService;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @param $school_code
     * @param $student_code
     * @param $teacher_code
     * @return \Illuminate\Http\Response
     */
    public function index($school_code, $student_code, $teacher_code)
    {
        session()->forget('section-attendance');

        if ($this->userService->isListOfStudents($school_code, $student_code))
            return $this->userService->indexView('list.student-list', $this->userService->getStudents());
        else if ($this->userService->isListOfTeachers($school_code, $teacher_code))
            return $this->userService->indexView('list.teacher-list', $this->userService->getTeachers());
        else if ($this->userService->isListOfApplicants($school_code, $student_code))
            return $this->userService->indexView('list.applicant-list', $this->userService->getApplicants());
        else if ($this->userService->isListOfRegisteredApplicants($school_code, $student_code))
            return $this->userService->indexView('list.registered-student', $this->userService->getRegisteredStudents());
        else
            return view('home');
    }

    public function aview($id)
    {
        $user = $this->user->find($id);
        $faculty = Faculty::query()->where('id', $user->faculty_id)->get()->first();
        $department = Department::query()->where('id', $user->department_id)->get()->first();
        $course = Classes::query()->where('id', $user->course_id)->get()->first();
        return view('auth.applicant-view', compact('user', 'faculty', 'department', 'course'));
    }
    
    public function generateMatric($id)
    {
        $user = $this->user->find($id);
        $faculty = Faculty::query()->where('id', $user->faculty_id)->get()->first();
        $session = Session::query()
            ->where('school_id', \Auth::user()->school_id)
            ->where('status', 1)
            ->get()
            ->first();

        $user->update([
            'student_code' => 'FUHSO/' . strtoupper($user->modeofentry) . substr($session->session_code, -2) . '/' . $faculty->code . '/' . $this->get_code(strtoupper($user->modeofentry), strtoupper($faculty->code)),
            'session' => $session->session_code
        ]);

        return back()->with('status', __('Saved'));
    }

    public function aapprove($id)
    {
        $user = $this->user->find($id);
        /*$faculty = Faculty::query()->where('id', $user->faculty_id)->get()->first();
        $session = Session::query()
            ->where('school_id', \Auth::user()->school_id)
            ->where('status', 1)
            ->get()
            ->first();

        $user->update([
            'active' => 1,
            'student_code' => 'FUHSO/'.strtoupper($user->modeofentry) . substr($session->session_code, -2) . '/' . $faculty->code . '/' . $this->get_code(strtoupper($user->modeofentry), strtoupper($faculty->code)),
            'code' => \Auth::user()->code,
            'session' => $session->session_code
        ]);*/
        
        
        $user->update([
            'active' => 1,
            'code' => \Auth::user()->code
        ]);

        try {
            event(new UserRegistered($user, $user->surname));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $user->email . '\n' . $ex->getMessage());
        }
        return back()->with('status', __('Saved'));
    }


    public function get_code($code, $faculty)
    {
        if ($faculty == "FS") {
            if ($code == "U") {
                $value = DB::table('codefs')->select('utme')->first();
                $number = $this->add_zero($value->utme);
                DB::table('codefs')->update(['utme' => $value->utme + 1]);
                return $number;
            } elseif ($code == "D") {
                $value = DB::table('codefs')->select('direct')->first();
                $number = $this->add_zero($value->direct);
                DB::table('codefs')->update(['direct' => $value->direct + 1]);
                return $number;
            } else {
                $value = DB::table('codefs')->select('transfer')->first();
                $number = $this->add_zero($value->transfer);
                DB::table('codefs')->update(['transfer' => $value->transfer + 1]);
                return $number;
            }
        } else {
            if ($code == "U") {
                $value = DB::table('codecms')->select('utme')->first();
                $number = $this->add_zero($value->utme);
                DB::table('codecms')->update(['utme' => $value->utme + 1]);
                return $number;
            } elseif ($code == "D") {
                $value = DB::table('codecms')->select('direct')->first();
                $number = $this->add_zero($value->direct);
                DB::table('codecms')->update(['direct' => $value->direct + 1]);
                return $number;
            } else {
                $value = DB::table('codecms')->select('transfer')->first();
                $number = $this->add_zero($value->transfer);
                DB::table('codecms')->update(['transfer' => $value->transfer + 1]);
                return $number;
            }
        }
    }

    public function add_zero($number)
    {
        if ($number < 10)
            return "000" . $number;
        elseif ($number >= 10 && $number < 100)
            return "00" . $number;
        elseif ($number >= 100 && $number < 999)
            return "0" . $number;
        else
            return strval($number);
    }

    public function adecline($id)
    {
        $user = $this->user->find($id)->update(['active' => 3, 'student_code' => NULL]);
        return back()->with('status', __('Saved'));
    }

    public function declinePost(Request $request)
    {
        $user = $this->user->find($request->uuid);
        $user->update(['active' => 3, 'student_code' => NULL]);
        try {
            //event(new UserDecline($user, $request->title, $request->message));
            $myEmail = $user->email;
            $details = [
                'title' => $request->title,
                'message' => $request->message,
                'name' => $user->name
            ];
            Mail::to($myEmail)->send(new RejectAcceptance($details));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $user->email . '\n' . $ex->getMessage());
        }
        return back()->with('status', __('Saved'));
    }

    /**
     * @param $school_code
     * @param $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexOther($school_code, $role)
    {
        if ($this->userService->isAccountant($role))
            return $this->userService->indexOtherView('accounts.accountant-list', $this->userService->getAccountants());
        else if ($this->userService->isLibrarian($role))
            return $this->userService->indexOtherView('library.librarian-list', $this->userService->getLibrarians());
        else
            return view('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRegisterStudent()
    {
        $classes = Myclass::query()
            ->bySchool(\Auth::user()->school->id)
            ->pluck('id');

        $sections = Section::with('class')
            ->whereIn('class_id', $classes)
            ->get();

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $departments = Department::all();
        $faculties = Faculty::all();
        $klasses = Classes::all();



        session([
            'register_role' => 'student',
            'register_sections' => $sections,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'departments' => $departments,
            'faculties' => $faculties,
            'classes' => $klasses
        ]);

        //dd(session('countries'));
        return redirect()->route('register');
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sectionStudents($section_id)
    {
        $students = $this->userService->getSectionStudentsWithSchool($section_id);

        return view('profile.section-students', compact('students'));
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promoteSectionStudents(Request $request, $section_id, $class_id)
    {
        if ($this->userService->hasSectionId($section_id))
            return $this->userService->promoteSectionStudentsView(
                $this->userService->getSectionStudentsWithStudentInfo($request, $section_id),
                //Myclass::with('sections')->bySchool(\Auth::user()->school_id)->get(),
                DB::table('sections')
                    ->join('classes', 'classes.id', '=', 'sections.class_id')
                    ->select('classes.*', 'sections.id as section_id', 'sections.section_number', 'sections.room_number as level')
                    ->where('class_id', $class_id)
                    ->where('classes.school_id', \Auth::user()->school_id)
                    ->get(),
                $section_id
            );
        else
            return $this->userService->promoteSectionStudentsView([], [], $section_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promoteSectionStudentsPost(Request $request)
    {
        return $this->userService->promoteSectionStudentsPost($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordGet()
    {
        return view('profile.change-password');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordPost(ChangePasswordRequest $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $request->user()->fill([
                'password' => Hash::make($request->new_password),
            ])->save();

            return back()->with('status', __('Saved'));
        }

        return back()->with('error-status', __('Passwords do not match.'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonateGet()
    {
        if (app('impersonate')->isImpersonating()) {
            Auth::user()->leaveImpersonation();
            return (Auth::user()->role == 'master') ? redirect('/masters') : redirect('/home');
        } else {
            return view('profile.impersonate', [
                'other_users' => $this->user->where('id', '!=', auth()->id())->get(['id', 'name', 'role'])
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonate(ImpersonateUserRequest $request)
    {
        $user = $this->user->find($request->id);
        Auth::user()->impersonate($user);
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $password = $request->password;
            $tb = $this->userService->storeStudent($request);
            try {
                // Fire event to store Student information
                if (event(new StudentInfoUpdateRequested($request, $tb->id))) {
                    // Fire event to send welcome email
                    event(new UserRegistered($tb, $password));
                } else {
                    throw new \Exeception('Event returned false');
                }
            } catch (\Exception $ex) {
                Log::info('Email failed to send to this address: ' . $tb->email . '\n' . $ex->getMessage());
            }
        });

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateAdminRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeAdmin($request);
        try {
            // Fire event to send welcome email
            // event(new userRegistered($userObject, $plain_password)); // $plain_password(optional)
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateTeacherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTeacher(CreateTeacherRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'teacher');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateAccountantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAccountant(CreateAccountantRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'accountant');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateLibrarianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLibrarian(CreateLibrarianRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'librarian');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($user_code)
    {
        $user = $this->userService->getUserByUserCode($user_code);

        return view('profile.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        $classes = Myclass::query()
            ->bySchool($user->school_id)
            ->pluck('id')
            ->toArray();

        $sections = Section::query()
            ->whereIn('class_id', $classes)
            ->get();

        $departments = Department::query()
            ->bySchool($user->school_id)
            ->get();


        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        //$departments = Department::all();
        $faculties = Faculty::all();
        $classes = Classes::all();

        return view('profile.edit', [
            'user' => $user,
            'sections' => $sections,
            'departments' => $departments,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'faculties' => $faculties,
            'departments' => $departments,
            'classes' => $classes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {

        DB::transaction(function () use ($request) {
            $tb = $this->user->find($request->user_id);
            $tb->name = $request->name;
            $tb->email = (!empty($request->email)) ? $request->email : '';
            $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
            $tb->phone_number = $request->phone_number;
            $tb->address = (!empty($request->address)) ? $request->address : '';
            $tb->about = (!empty($request->about)) ? $request->about : '';
            if (!empty($request->pic_path)) {
                $tb->pic_path = $request->pic_path;
            }
            if ($request->user_role == 'teacher') {
                $tb->department_id = $request->department_id;
                $tb->section_id = $request->class_teacher_section_id;
            }
            if ($tb->save()) {
                if ($request->user_role == 'student') {
                    // $request->validate([
                    //   'session' => 'required',
                    //   'version' => 'required',
                    //   'birthday' => 'required',
                    //   'religion' => 'required',
                    //   'father_name' => 'required',
                    //   'mother_name' => 'required',
                    // ]);
                    try {
                        // Fire event to store Student information
                        event(new StudentInfoUpdateRequested($request, $tb->id));
                    } catch (\Exception $ex) {
                        Log::info('Failed to update Student information, Id: ' . $tb->id . 'err:' . $ex->getMessage());
                    }
                }
            }
        });

        return back()->with('status', __('Saved'));
    }

    /**
     * Activate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAdmin($id)
    {
        $admin = $this->user->find($id);

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Deactivate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateAdmin($id)
    {
        $admin = $this->user->find($id);

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        // return ($this->user->destroy($id))?response()->json([
        //   'status' => 'success'
        // ]):response()->json([
        //   'status' => 'error'
        // ]);
    }

    // custom functions
    public function studentVerificationGet()
    {
        return view('auth.verification');
    }

    public function studentVerificationPost(Request $request)
    {
        // $user = User::query()
        //     ->where('jambregno', $request->regnumb)
        //     ->where('active', 3)
        //     ->get()->first();
        // if (!empty($user->id)) {
        //     return Redirect::back()->withErrors(['You have already submitted your application, and it has been rejected. Thank you']);
        // }

        //dd($request);
        $applicant = Jamb::query()
            ->where('jambregno', strtoupper($request->regnumb))
            ->where('surname', ucfirst($request->sname))
            ->where('firstname', ucfirst($request->fname))
            ->get()
            ->first();
        if (!empty($applicant->jambregno)) {
            //return redirect("update-applicant")->withSuccess('Record exist in our database');
            //return redirect()->route('update-applicant', [$applicant->jambregno]);
            return Redirect::to('fill-acceptance-form?q=' . $applicant->jambregno);
        }
        return Redirect::back()->withErrors(['We couldnt find any student with the supplied details']);
    }

    public function updateApplicantGet()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $departments = Department::all();
        return view('auth.update', compact('countries', 'states', 'cities', 'departments'));
    }

    public function updateApplicantPost(Request $request)
    {
        var_dump($request);
        exit;
        $id = 1;
        return redirect()->route('application-summary-payment', $id);
    }

    public function storeApplicant(Request $request)
    {
        $request->validate([
            // 'email' => 'sometimes|email|max:255|unique:users'. $this->id,
            // 'phone_number' => 'required|string|unique:users'. $this->id,
            // 'jambregno' => 'required|string|unique:users'. $this->id,
            // 'nin' => 'required|string|max:11|unique:users',
            'passport' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'olevel_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'olevel_file_1' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'jamb_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'degree_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'diploma_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'consent_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
        ]);
        $password = $request->surname;
        $id = $request->uid;
        $tb = $this->userService->storeApplicant($request, $id);

        // $totalfees = DB::table('fee_heads')
        //     ->where('school_id', 57)
        //     ->where('stage', 0)
        //     ->sum('fee_heads.amount');

        // $payment = new Payment;
        // $payment->payment_id = rand(1,10000000);
        // $payment->payment_status = 0;
        // $payment->amount = $totalfees;
        // $payment->custormer_id = $tb->id;
        // $payment->charge_for = "APPLICATION FEE";
        // $payment->save();

        try {
            if (!empty($tb->id)) {
                return redirect()->route('application-summary-payment', ['id' => $tb->id, 'pid' => 1]);
            } else {
                return back()->with('status', __('Not saved'));
            }
        } catch (\Exception $ex) {
            Log::info('Fail to create payment for : ' . $tb->name . '\n' . $ex->getMessage());
        }

        // DB::transaction(function () use ($request) {
        //     $password = $request->password;
        //     $tb = $this->userService->storeApplicant($request);
        //     $applicant = $tb;
        //     // try {
        //     //     // Fire event to store Student information
        //     //     if(event(new StudentInfoUpdateRequested($request,$tb->id))){
        //     //         // Fire event to send welcome email
        //     //         //event(new UserRegistered($tb, $password));
        //     //     } else {
        //     //         throw new \Exeception('Event returned false');
        //     //     }
        //     // } catch(\Exception $ex) {
        //     //     Log::info('Email failed to send to this address: '.$tb->email.'\n'.$ex->getMessage());
        //     // }
        // });
    }

    public function storeStud(Request $request)
    {
        //dd($request);
        $password = $request->surname;
        $id = $request->uid;
        $tb = $this->userService->storeStud($request);
        return back()->with('status', __('Not saved'));
    }

    public function applicationSummary($id, $pid)
    {
        //$applicant_id = Crypt::decryptString($id);
        $applicant = $this->user->find($id);
        $sid = $applicant->school_id;

        $faculty = Faculty::query()->where('id', $applicant->faculty_id)->get()->first();
        $department = Department::query()->where('id', $applicant->department_id)->get()->first();
        $course = Classes::query()->where('id', $applicant->course_id)->get()->first();

        //$payment = Payment::find($pid);

        return view('auth.summary', [
            'applicant' => $applicant,
            'faculty' => $faculty,
            'department' => $department,
            'course' => $course
        ]);
    }

    public function initializePayment(Request $request)
    {
        $payment = new Payment;
        $data = $request->all();
        $payment->payment_id = $data["ref"];
        $payment->payment_status = "INITIATED";
        $payment->amount = $data["amount"];
        $payment->custormer_id = $data["applicant_id"];
        $payment->charge_for = "APPLICATION FEE";
        $payment->save();
    }

    public function paymentVerification(Request $request)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $request->ref,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_7c940fb6342df08887c7a5bfa62ae36eb67d1130",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $result = json_decode($response, true);

        if (!$result["status"]) {
            die('API returned error: ' . $tranx->message);
        }

        if ('success' == $result["data"]["status"]) {
            $this->send_email($result);
            $this->give_value($result);
            // $applicant_id = $result["data"]["metadata"]["custom_fields"][0]["applicant_id"];
            // return redirect()->route('payment-success', $applicant_id);
        } else {
            $this->perform_error();
        }
    }

    public function paymentSuccess($id)
    {
        return view('auth.success');
    }

    public function perform_success()
    {
        $message = true;
        echo json_encode(['message' => true]);
    }

    public function perform_error()
    {
        $message = false;
        echo json_encode(['message' => true]);
    }

    public function acceptanceFormGet($id = NULL)
    {
        $regnumb = request()->get('q');
        $user = User::query()->where('jambregno', $regnumb)->get()->first();


        if (!empty($user->id)) {
            if ($user->active == 3) {
                return redirect()->route('update-details', ['id' => $user->id]);
            }
            return redirect()->route('acceptance-success', ['id' => $user->id]);
        }
        $applicant = Jamb::query()
            ->where('jambregno', $regnumb)
            ->get()
            ->first();
        $userdetails = User::query()->where('jambregno', $regnumb)->get();

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $faculties = Faculty::all();
        $departments = Department::all();
        $classes = Classes::all();
        return view('auth.acceptance', compact('countries', 'states', 'cities', 'faculties', 'departments', 'classes', 'applicant', 'userdetails'));
    }

    public function acceptanceFormPost(Request $request)
    {
        $request->validate([
            'email' => 'sometimes|email|max:255|unique:users',
            'phone_number' => 'required|string|unique:users',
            'proof_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'consent_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
        ]);
        $password = $request->surname;
        $tb = $this->userService->storeAcceptance($request);
        try {
            if (!empty($tb->id)) {
                return redirect()->route('acceptance-success', ['id' => $tb->id]);
            } else {
                return back()->with('status', __('Not saved'));
            }
        } catch (\Exception $ex) {
            Log::info('Fail to complete registration for : ' . $tb->name . '\n' . $ex->getMessage());
        }
    }

    public function updateDetails($id = NULL)
    {
        $applicant = $this->user->find($id);
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $faculties = Faculty::all();
        $departments = Department::all();
        $classes = Classes::all();
        return view('auth.update-acceptance', compact('countries', 'states', 'cities', 'faculties', 'departments', 'classes', 'applicant'));
    }

    public function updateDetailsPost(Request $request)
    {
        $request->validate([
            'proof_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
            'consent_file' => 'mimes:jpeg,png,jpg,PNG,JPEG,JPG,PDF,pdf|max:1014',
        ]);
        $id = $request->uuid;
        $tb = $this->userService->updateAcceptance($request, $id);
        try {
            if (!empty($tb->id)) {
                return redirect()->route('acceptance-success', ['id' => $tb->id]);
            } else {
                return back()->with('status', __('Not saved'));
            }
        } catch (\Exception $ex) {
            Log::info('Fail to complete registration for : ' . $tb->name . '\n' . $ex->getMessage());
        }
    }

    public function acceptanceSuccess($id = null)
    {
        return view('auth.successfully');
    }

    public function give_value($result)
    {
        $applicant_id = $result["data"]["metadata"]["custom_fields"][0]["applicant_id"];
        $ref = $result["data"]["metadata"]["custom_fields"][0]["ref"];
        $payment = Payment::query()
            ->where('custormer_id', $applicant_id)
            ->where('payment_id', $ref)
            ->update(['payment_status' => 1]);
        $this->perform_success();
    }

    public function send_email($result)
    {
        $applicant_id = $result["data"]["metadata"]["custom_fields"][0]["applicant_id"];
        $applicant = $this->user->find($applicant_id);
        $password = $applicant->surname;

        if (empty($applicant->id)) {
            return back()->with('status', __('Not saved'));
        }
        try {
            event(new UserRegistered($applicant, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $applicant->email . '\n' . $ex->getMessage());
        }
    }


    public function getState($id)
    {
        $state['data'] = State::orderby("name", "asc")
            ->select('id', 'name')
            ->where('country_id', $id)
            ->get();
        return response()->json($state);
    }

    public function getCity($id)
    {
        $city['data'] = City::orderby("name", "asc")
            ->select('id', 'name')
            ->where('state_id', $id)
            ->get();
        return response()->json($city);
    }

    public function getDepartment($id)
    {
        $city['data'] = Department::orderby("department_name", "asc")
            ->select('id', 'department_name')
            ->where('faculty_id', $id)
            ->get();
        return response()->json($city);
    }

    public function getProgrammes($id)
    {
        $city['data'] = Classes::orderby("class_number", "asc")
            ->select('id', 'class_number', 'duration')
            ->where('department_id', $id)
            ->get();
        return response()->json($city);
    }

    public function getDuration($id)
    {
        $city['data'] = Classes::orderby("duration", "asc")
            ->select('id', 'duration')
            ->where('id', $id)
            ->get();
        return response()->json($city);
    }

    public function export()
    {
        // return Excel::download(new RegisteredExport, 'excel.xlsx');
        $year = date('Y');
        return Excel::download(new RegisteredExport($year), date('Y-m-d') . '-students.xlsx');
    }

    public function addCustomUsers()
    {
        $classes = Myclass::query()
            ->bySchool(\Auth::user()->school->id)
            ->pluck('id');

        $sections = Section::with('class')
            ->whereIn('class_id', $classes)
            ->get();

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $departments = Department::all();
        $faculties = Faculty::all();
        $klasses = Classes::all();

        session([
            'register_role' => 'student',
            'register_sections' => $sections,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'departments' => $departments,
            'faculties' => $faculties,
            'classes' => $klasses
        ]);

        $users = User::all()
            ->where('role', '!=', 'student')
            ->where('role', '!=', 'applicant')
            ->where('role', '!=', 'admin')
            ->where('role', '!=', 'master')
            ->where('school_id', \Auth::user()->school_id);
        return view('users.add-user', ['users' => $users]);
    }

    public function addCustomUserPost(Request $request)
    {
        $password = strtolower($request->surname);
        $tb = $this->userService->addCustomUserPost($request);

        if (!empty($tb->email)) {
            try {
                // Fire event to send welcome email
                event(new UserRegistered($tb, $password));
            } catch (\Exception $ex) {
                Log::info('Email failed to send to this address: ' . $tb->email);
            }
            return back()->with('add-user-success', __("User added successfully"));
        }
        return back()->with('add-user-error', __("Error adding user. The phone number or email has been taken"));
    }

    public function deleteCustomUserPost(Request $request)
    {
        $user = User::find($request->userID);
        $user->delete();
        return back()->with('add-user-success', __("User deleted successfully"));
    }

    public function departmentStudents()
    {
        $department = Department::query()->where('id', \Auth::user()->department_id)->get()->first();
        $students = User::query()
            ->where('school_id', \Auth::user()->school_id)
            ->where('department_id', \Auth::user()->department_id)
            ->where('role', 'student')
            ->orderBy('level', 'DESC')
            ->get();

        return view('users.department-student', ['students' => $students, 'department' => $department]);
    }

    public function departmentStudentsPost(Request $request)
    {
        $department = Department::query()->where('id', Auth::user()->department_id)->get()->first();
        $students = User::query()
            ->where('school_id', \Auth::user()->school_id)
            ->where('department_id', \Auth::user()->department_id)
            ->where('role', 'student')
            ->where('level', $request->level)
            ->orderBy('level', 'DESC')
            ->get();
        return view('users.department-student', ['students' => $students, 'department' => $department]);
    }

    public function sindex($school_code, $dummy)
    {
        $departments = Department::query()->where('school_id', \Auth::user()->school_id)->get();

        return view('student.department-student', ['departments' => $departments]);
    }

    public function sindexPost(Request $request)
    {
        $departments = Department::query()->where('school_id', \Auth::user()->school_id)->get();
        $dept = "";
        $level = "";
        if (!empty($request->department_id) && !empty($request->level)) {
            $students = User::query()
                ->where('school_id', \Auth::user()->school_id)
                ->where('role', 'student')
                ->where('department_id', $request->department_id)
                ->where('level', $request->level)
                ->orderBy('id', 'DESC')
                ->get();
            $department = Department::query()
                ->where('school_id', \Auth::user()->school_id)
                ->where('id', $request->department_id)
                ->get()
                ->first();
            $dept = $department->department_name;
            $level = $request->level;
        } elseif (!empty($request->department_id) && empty($request->level)) {
            $students = User::query()
                ->where('school_id', \Auth::user()->school_id)
                ->where('role', 'student')
                ->where('department_id', $request->department_id)
                ->orderBy('id', 'DESC')
                ->get();
            $department = Department::query()
                ->where('school_id', \Auth::user()->school_id)
                ->where('id', $request->department_id)
                ->get()
                ->first();
            $dept = $department->department_name;
            $level = "ALL";
        } elseif (empty($request->department_id) && !empty($request->level)) {
            $students = User::query()
                ->where('school_id', \Auth::user()->school_id)
                ->where('role', 'student')
                ->where('level', $request->level)
                ->orderBy('id', 'DESC')
                ->get();
            $level = $request->level;
            $dept = "ALL";
        } else {
            $students = User::query()
                ->where('school_id', \Auth::user()->school_id)
                ->where('role', 'student')
                ->orderBy('id', 'DESC')
                ->get();
            $dept = "ALL";
            $level = "ALL";
        }


        return view(
            'student.department-student',
            [
                'students' => $students,
                'departments' => $departments,
                'dept' => $dept,
                'level' => $level
            ]
        );
    }
    
    public function updateMatricNumber()
    {
        $departments = Department::query()->where('school_id', \Auth::user()->school_id)->get();
        //dd($departments);
        return view('student.update-matriculation-number', ['departments' => $departments,]);
    }

    public function studentInDepartment($department_id)
    {
        $students = User::query()
            ->where('school_id', \Auth::user()->school_id)
            ->where('department_id', $department_id)
            ->where('role', 'student')
            ->where('active', 1)
            ->orderBy('id', 'DESC')
            ->get();
        $department = Department::query()
            ->where('school_id', \Auth::user()->school_id)
            ->where('id', $department_id)
            ->get()
            ->first();

        return view('student.student-in-department', ['department' => $department, 'students' => $students]);
    }
    
    public function saveCodePost(Request $request)
    {
        $tbc = $this->userService->updateMatric($request);
        try {
            if (count($tbc) > 0) {
                $gradeTb = new User;
                \Batch::update($gradeTb, (array) $tbc, 'id');
            }
        } catch (\Exception $e) {
            return __("Ops, an error occured");
        }

        return back()->with('status', __('Saved'));
    }
}
