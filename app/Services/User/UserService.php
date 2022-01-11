<?php

namespace App\Services\User;

use App\Classes;
use App\User;
use App\Section;
use App\StudentInfo;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\Batch as Batch;
use Illuminate\Support\Facades\Log;
//use Image;
use Intervention\Image\Facades\Image;

class UserService
{

    protected $user;
    protected $student_info;
    protected $db;
    protected $batch;
    protected $st, $st2;

    public function __construct(User $user, StudentInfo $student_info, DB $db, Batch $batch)
    {
        $this->user = $user;
        $this->student_info = $student_info;
        $this->db = $db;
        $this->batch = $batch;
    }

    public function isListOfStudents($school_code, $student_code)
    {
        return !empty($school_code) && $student_code == 1;
    }

    public function isListOfApplicants($school_code, $student_code)
    {
        return !empty($school_code) && $student_code == 2;
    }

    public function isListOfRegisteredApplicants($school_code, $student_code)
    {
        return !empty($school_code) && $student_code == 3;
    }

    public function isListOfTeachers($school_code, $teacher_code)
    {
        return !empty($school_code) && $teacher_code == 1;
    }

    public function indexView($view, $users)
    {
        $department = Classes::query()->get();

        return view($view, [
            'users' => $users,
            'departments' => $department,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function hasSectionId($section_id)
    {
        return $section_id > 0;
    }

    public function updateStudentInfo($request, $id)
    {
        $info = StudentInfo::firstOrCreate(['student_id' => $id]);
        $info->student_id = $id;
        $info->session = (!empty($request->session)) ? $request->session : '';
        $info->version = (!empty($request->version)) ? $request->version : '';
        $info->group = (!empty($request->group)) ? $request->group : '';
        $info->birthday = (!empty($request->birthday)) ? $request->birthday : '';
        $info->religion = (!empty($request->religion)) ? $request->religion : '';
        $info->father_name = (!empty($request->father_name)) ? $request->father_name : '';
        $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
        $info->father_national_id = (!empty($request->father_national_id)) ? $request->father_national_id : '';
        $info->father_occupation = (!empty($request->father_occupation)) ? $request->father_occupation : '';
        $info->father_designation = (!empty($request->father_designation)) ? $request->father_designation : '';
        $info->father_annual_income = (!empty($request->father_annual_income)) ? $request->father_annual_income : '';
        $info->mother_name = (!empty($request->mother_name)) ? $request->mother_name : '';
        $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
        $info->mother_national_id = (!empty($request->mother_national_id)) ? $request->mother_national_id : '';
        $info->mother_occupation = (!empty($request->mother_occupation)) ? $request->mother_occupation : '';
        $info->mother_designation = (!empty($request->mother_designation)) ? $request->mother_designation : '';
        $info->mother_annual_income = (!empty($request->mother_annual_income)) ? $request->mother_annual_income : '';
        $info->user_id = auth()->user()->id;
        $info->save();
    }

    public function promoteSectionStudentsView($students, $classes, $section_id)
    {
        return view('school.promote-students', compact('students', 'classes', 'section_id'));
    }

    public function promoteSectionStudentsPost($request)
    {
        if ($request->section_id > 0) {
            $students = $this->getSectionStudentsWithStudentInfo($request, $request->section_id);
            $i = 0;
            foreach ($students as $student) {
                $this->st[] = [
                    'id' => $student->id,
                    'section_id' => $request->to_section[$i],
                    'active' => isset($request["left_school$i"]) ? 0 : 1,
                    'session' => $request->to_session[$i],
                ];

                $this->st2[] = [
                    'student_id' => $student->id,
                    'session' => $request->to_session[$i],
                ];
                ++$i;
            }
            $this->promoteSectionStudentsPostDBTransaction();

            return back()->with('status', 'Saved');
        }
    }

    public function promoteSectionStudentsPostDBTransaction()
    {
        return $this->db::transaction(function () {
            // $table1 = 'users';
            $this->batch->update($this->user, (array) $this->st, 'id');
            // $table2 = 'student_infos';
            //$this->batch->update($this->student_info, (array) $this->st2, 'student_id');
        });
    }

    public function isAccountant($role)
    {
        return $role == 'accountant';
    }

    public function isLibrarian($role)
    {
        return $role == 'librarian';
    }

    public function indexOtherView($view, $users)
    {
        return view($view, [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function getStudents()
    {
        return $this->user->with(['section.class', 'school', 'studentInfo'])
            ->where('code', auth()->user()->school->code)
            ->student()
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->paginate(50);
    }

    public function getApplicants()
    {
        return $this->user->with(['section.class', 'school', 'studentInfo'])
            ->where('school_id', auth()->user()->school_id)
            ->where('role', 'applicant')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    public function getRegisteredStudents()
    {
        return $this->user->with(['section.class', 'school', 'studentInfo'])
            ->where('school_id', auth()->user()->school_id)
            ->student()
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    public function getTeachers()
    {
        return $this->user->with(['section', 'school'])
            ->where('code', auth()->user()->school->code)
            ->where('role', 'teacher')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->paginate(50);
    }

    public function getAccountants()
    {
        return $this->user->with('school')
            ->where('code', auth()->user()->school->code)
            ->where('role', 'accountant')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->paginate(50);
    }

    public function getLibrarians()
    {
        return $this->user->with('school')
            ->where('code', auth()->user()->school->code)
            ->where('role', 'librarian')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->paginate(50);
    }

    public function getSectionStudentsWithSchool($section_id)
    {
        return $this->user->with('school')
            ->student()
            ->where('section_id', $section_id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getSectionStudentsWithStudentInfo($request, $section_id)
    {
        $ignoreSessions = $request->session()->get('ignoreSessions');

        if (isset($ignoreSessions) && $ignoreSessions == "true") {
            return $this->user->with(['section'])
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->where('users.role', 'student')
                ->get();
        } else {
            return $this->user->with(['section'])
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->where('users.role', 'student')
                ->get();
        }
    }

    public function getSectionStudents($section_id)
    {
        return $this->user->where('section_id', $section_id)
            ->where('active', 1)
            ->get();
    }

    public function getUserByUserCode($user_code)
    {
        // $test = User::all()->where('id', $user_code);

        // dd($test);
        return $this->user->with('section')
            ->where('id', $user_code)
            ->where('active', 1)
            ->first();
    }

    public function storeAdmin($request)
    {
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = $request->email;
        $tb->password = bcrypt($request->password);
        $tb->role = 'admin';
        $tb->active = 1;
        $tb->school_id = session('register_school_id');
        $tb->code = session('register_school_code');
        $tb->student_code = session('register_school_id') . date('y') . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->save();
        return $tb;
    }

    public function storeStudent($request)
    {
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = 'student';
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code; // School Code
        $tb->student_code = auth()->user()->school_id . date('y') . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address)) ? $request->address : '';
        $tb->about = (!empty($request->about)) ? $request->about : '';
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->section_id = $request->section;
        $tb->save();
        return $tb;
    }

    public function storeStud($request)
    {
        //$tb = new $this->user;
        //$tb = User::firstOrCreate(['id' => $id]);
        $tb = new $this->user;
        $tb->role = 'student';
        $tb->active = 1;
        $tb->code =  \Auth::user()->code;
        $tb->password = bcrypt($request->surname);
        $tb->section_id = $this->get_section($request->course_id);
        $tb->school_id = 57;
        $tb->jambregno = $request->jambregno;
        $tb->email = $request->email;
        $tb->pic_path = (!empty($this->storeImage($request, 'passport'))) ? $this->storeImage($request, 'passport') : 'none.png';
        $tb->nin = $request->nin;
        $tb->surname = $request->surname;
        $tb->firstname = $request->firstname;
        $tb->othername = $request->othernames;
        $tb->gender = $request->gender;
        $tb->phone_number = $request->phone_number;
        $tb->dob = $request->dob;
        $tb->maritalstatus = $request->maritalstatus;
        $tb->religion = $request->religion;
        //$tb->bloodgroup = $request->bloodgroup;
        $tb->address = $request->contactaddress;
        $tb->permanentaddress = $request->permanentaddress;
        $tb->country_id = $request->country_id;
        $tb->state_id = $request->state_id;
        $tb->lga_id = $request->city_id;
        $tb->nok = $request->nok_name;
        $tb->nok_relationship = $request->nok_relationship;
        $tb->nok_email = $request->nok_email;
        $tb->nok_phone = $request->nok_phone;
        $tb->nok_address = $request->nok_address;
        $tb->sponsor_name = $request->sponsor_name;
        $tb->sponsor_email = $request->sponsor_email;
        $tb->sponsor_phone = $request->sponsor_phone;
        $tb->sponsor_address = $request->sponsor_address;
        $tb->challenged = $request->challenged;
        $tb->hobbies = $request->hobbies;
        $tb->skills = $request->skills;
        $tb->faculty_id = $request->faculty_id;
        $tb->department_id = $request->department_id;
        $tb->course_id = $request->course_id;
        $tb->modeofentry = $request->modeofentry;
        $tb->de_grade = $request->de_grade;
        $tb->de_examdate = $request->de_examdate;
        $tb->de_institution = $request->de_institution;

        $tb->qualification = $request->qualification;
        $tb->qualification_institution = $request->qualification_institution;
        $tb->qualification_date = $request->qualification_examdate;

        $tb->qualification_2 = $request->qualification_2;
        $tb->qualification_institution_2 = $request->qualification_institution_2;
        $tb->qualification_date_2 = $request->qualification_examdate_2;

        $tb->sitting = $request->sitting;

        $tb->olevel_file = (!empty($this->storeImage($request, 'olevel_file'))) ? $this->storeImage($request, 'olevel_file') : 'none.png';
        $tb->olevel_file_1 = (!empty($this->storeImage($request, 'olevel_file_1'))) ? $this->storeImage($request, 'olevel_file_1') : 'none.png';
        $tb->jamb_file = (!empty($this->storeImage($request, 'jamb_file'))) ? $this->storeImage($request, 'jamb_file') : 'none.png';
        $tb->diploma_file = (!empty($this->storeImage($request, 'diploma_file'))) ? $this->storeImage($request, 'diploma_file') : 'none.png';
        $tb->degree_file = (!empty($this->storeImage($request, 'degree_file'))) ? $this->storeImage($request, 'degree_file') : 'none.png';
        $tb->registration_proof = (!empty($this->storeImage($request, 'registration_proof'))) ? $this->storeImage($request, 'registration_proof') : 'none.png';
        //$tb->consent_file = (!empty($this->storeImage($request,'consent_file'))) ? $this->storeImage($request,'consent_file') : 'none.png';

        $tb->save();
        return $tb;
    }

    public function updateAcceptance($request, $id)
    {
        $tb = User::find($id);
        $tb->role = 'applicant';
        $tb->active = 0;
        $tb->jambregno = $request->jambregno;
        $tb->school_id = 57;
        $tb->password = bcrypt($request->surname);
        $tb->name = $request->surname . " " . $request->firstname;
        $tb->pic_path = (!empty($this->storeImage($request, 'passport'))) ? $this->storeImage($request, 'passport') : 'none.png';
        $tb->surname = $request->surname;
        $tb->firstname = $request->firstname;
        $tb->othername = $request->othernames;
        $tb->gender = $request->gender;
        $tb->phone_number = $request->phone_number;
        $tb->dob = $request->dob;
        $tb->maritalstatus = $request->maritalstatus;
        $tb->email = $request->email;
        $tb->address = $request->contactaddress;
        $tb->country_id = $request->country_id;
        $tb->state_id = $request->state_id;
        $tb->lga_id = $request->city_id;

        $tb->sponsor_name = $request->sponsor_name;
        $tb->sponsor_email = $request->sponsor_email;
        $tb->sponsor_phone = $request->sponsor_phone;
        $tb->sponsor_address = $request->sponsor_address;

        $tb->department_id = $request->course;
        $tb->faculty_id = $request->faculty_id;
        $tb->course_id = $request->course_id;
        $tb->duration = $request->duration;


        $tb->proof_file = (!empty($this->storeImage($request, 'proof_file'))) ? $this->storeImage($request, 'proof_file') : 'none.png';
        $tb->consent_file = (!empty($this->storeImage($request, 'consent_file'))) ? $this->storeImage($request, 'consent_file') : 'none.png';

        $tb->save();
        return $tb;
    }

    public function storeApplicant($request, $id)
    {
        //$tb = new $this->user;
        //$tb = User::firstOrCreate(['id' => $id]);
        $tb = User::find($id);
        $tb->role = 'student';
        $tb->section_id = $this->get_section($request->course_id);
        $tb->school_id = 57;
        //$tb->jambregno = $request->jambregno;
        $tb->pic_path = (!empty($this->storeImage($request, 'passport'))) ? $this->storeImage($request, 'passport') : 'none.png';
        $tb->nin = $request->nin;
        //$tb->surname = $request->surname;
        //$tb->firstname = $request->firstname;
        $tb->othername = $request->othernames;
        $tb->gender = $request->gender;
        //$tb->phone_number = $request->phone_number;
        $tb->dob = $request->dob;
        $tb->maritalstatus = $request->maritalstatus;
        $tb->religion = $request->religion;
        //$tb->bloodgroup = $request->bloodgroup;
        $tb->address = $request->contactaddress;
        $tb->permanentaddress = $request->permanentaddress;
        $tb->country_id = $request->country_id;
        $tb->state_id = $request->state_id;
        $tb->lga_id = $request->city_id;
        $tb->nok = $request->nok_name;
        $tb->nok_relationship = $request->nok_relationship;
        $tb->nok_email = $request->nok_email;
        $tb->nok_phone = $request->nok_phone;
        $tb->nok_address = $request->nok_address;
        $tb->sponsor_name = $request->sponsor_name;
        $tb->sponsor_email = $request->sponsor_email;
        $tb->sponsor_phone = $request->sponsor_phone;
        $tb->sponsor_address = $request->sponsor_address;
        $tb->challenged = $request->challenged;
        $tb->hobbies = $request->hobbies;
        $tb->skills = $request->skills;
        $tb->faculty_id = $request->faculty_id;
        $tb->department_id = $request->department_id;
        $tb->course_id = $request->course_id;
        $tb->modeofentry = $request->modeofentry;
        $tb->de_grade = $request->de_grade;
        $tb->de_examdate = $request->de_examdate;
        $tb->de_institution = $request->de_institution;

        $tb->qualification = $request->qualification;
        $tb->qualification_institution = $request->qualification_institution;
        $tb->qualification_date = $request->qualification_examdate;

        $tb->qualification_2 = $request->qualification_2;
        $tb->qualification_institution_2 = $request->qualification_institution_2;
        $tb->qualification_date_2 = $request->qualification_examdate_2;

        $tb->sitting = $request->sitting;

        $tb->olevel_file = (!empty($this->storeImage($request, 'olevel_file'))) ? $this->storeImage($request, 'olevel_file') : 'none.png';
        $tb->olevel_file_1 = (!empty($this->storeImage($request, 'olevel_file_1'))) ? $this->storeImage($request, 'olevel_file_1') : 'none.png';
        $tb->jamb_file = (!empty($this->storeImage($request, 'jamb_file'))) ? $this->storeImage($request, 'jamb_file') : 'none.png';
        $tb->diploma_file = (!empty($this->storeImage($request, 'diploma_file'))) ? $this->storeImage($request, 'diploma_file') : 'none.png';
        $tb->degree_file = (!empty($this->storeImage($request, 'degree_file'))) ? $this->storeImage($request, 'degree_file') : 'none.png';
        $tb->registration_proof = (!empty($this->storeImage($request, 'registration_proof'))) ? $this->storeImage($request, 'registration_proof') : 'none.png';
        //$tb->consent_file = (!empty($this->storeImage($request,'consent_file'))) ? $this->storeImage($request,'consent_file') : 'none.png';

        $tb->save();
        return $tb;
    }

    public function storeAcceptance($request)
    {
        $tb = new $this->user;
        $tb->role = 'applicant';
        $tb->jambregno = $request->jambregno;
        $tb->school_id = 57;
        $tb->password = bcrypt($request->surname);
        $tb->name = $request->surname . " " . $request->firstname;
        $tb->pic_path = (!empty($this->storeImage($request, 'passport'))) ? $this->storeImage($request, 'passport') : 'none.png';
        $tb->surname = $request->surname;
        $tb->firstname = $request->firstname;
        $tb->othername = $request->othernames;
        $tb->gender = $request->gender;
        $tb->phone_number = $request->phone_number;
        $tb->dob = $request->dob;
        $tb->maritalstatus = $request->maritalstatus;
        $tb->email = $request->email;
        $tb->address = $request->contactaddress;
        $tb->country_id = $request->country_id;
        $tb->state_id = $request->state_id;
        $tb->lga_id = $request->city_id;
        $tb->modeofentry = $request->modeofentry;

        $tb->sponsor_name = $request->sponsor_name;
        $tb->sponsor_email = $request->sponsor_email;
        $tb->sponsor_phone = $request->sponsor_phone;
        $tb->sponsor_address = $request->sponsor_address;

        $tb->department_id = $request->course;
        $tb->faculty_id = $request->faculty_id;
        $tb->course_id = $request->course_id;
        $tb->duration = $request->duration;


        $tb->proof_file = (!empty($this->storeImage($request, 'proof_file'))) ? $this->storeImage($request, 'proof_file') : 'none.png';
        $tb->consent_file = (!empty($this->storeImage($request, 'consent_file'))) ? $this->storeImage($request, 'consent_file') : 'none.png';

        $tb->save();
        return $tb;
    }

    public function get_section($course_id)
    {
        $section = Section::query()->where('class_id', $course_id)->orderBy('id', 'asc')->get()->first();
        return $section->id;
    }

    public function storeStaff($request, $role)
    {
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = $role;
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code;
        $tb->student_code = auth()->user()->school_id . date('y') . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->department_id = (!empty($request->department_id)) ? $request->department_id : 0;

        if ($role == 'teacher') {
            $tb->section_id = ($request->class_teacher_section_id != 0) ? $request->class_teacher_section_id : 0;
        }

        $tb->save();
        return $tb;
    }

    public function storeImage($request, $fileName)
    {
        // $url = "";
        $image_name = "";
        // if ( $file = $request->file($fileName)) {
        //     //$optimizeImage = Image::make($file);
        //     $optimizePath = public_path() . '/img/documents/';
        //     $image = time() . rand(1, 1000000) . $file->getClientOriginalName();
        //     // $optimizeImage->resize(200, 200, function ($constraint) {
        //     //     $constraint->aspectRatio();
        //     // });
        //     $url = $optimizePath . $image;
        //     $image_name = $image;
        //     $file->move($url);
        // }

        if ($file = $request->file($fileName)) {
            $filename = $file->store('/img/documents', ['disk' => 'public_uploads']);
            return str_replace("img/documents/", "", $filename);
        }
    }

    public function addCustomUserPost($request)
    {
        try {
            $tb = new $this->user;
            $tb->name = $request->firstname . " " . $request->surname;
            $tb->surname = $request->surname;
            $tb->firstname = $request->firstname;
            $tb->email = (!empty($request->email)) ? $request->email : '';
            $tb->password = bcrypt(strtolower($request->surname));
            $tb->role = "custom";
            $tb->active = 1;
            $tb->school_id = auth()->user()->school_id;
            $tb->code = auth()->user()->code;
            $tb->student_code = auth()->user()->school_id . date('y') . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
            $tb->gender = "";
            $tb->blood_group = "";
            $tb->nationality = "Nigerian";
            $tb->phone_number = $request->phone_number;
            $tb->pic_path = '';
            $tb->verified = 1;
            $tb->department_id = (!empty($request->department_id)) ? $request->department_id : 0;
            $tb->permission = implode(',', $request->permission);

            if (in_array('teacher', $request->permission)) {
                $tb->section_id = ($request->class_teacher_section_id != 0) ? $request->class_teacher_section_id : 0;
            }

            $tb->save();
            return $tb;
        } catch (\Illuminate\Database\QueryException $ex) {
            $ex->getMessage();
            return $ex;
        }
    }

    public function updateMatric($request)
    {
        $i = 0;
        foreach ($request->userids as $id) {
            $tb = User::find($id);
            $tb->student_code = $request->newcode[$i];
            $tbc[] = $tb->attributesToArray();
            $i++;
        }
        return $tbc;
    }
}
