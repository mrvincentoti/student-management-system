@extends('layouts.landing')

@section('title', __('Register'))

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
    <div class="row">
        <div class="col-md-12" id="main-container">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
                {{-- Display View admin links --}}
                @if (session('register_school_id'))
                <a href="{{ url('school/admin-list/' . session('register_school_id')) }}" target="_blank" class="text-white pull-right">@lang('View Admins')</a>
                @endif
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Register') {{ucfirst(session('register_role'))}}</h4>
                </div>
                <div class="card-body">
                    @if(session('register_role', 'student') != 'student')
                    <form class="form-horizontal" method="POST" id="registerForm" action="{{ url('register/'.session('register_role')) }}">
                        @else
                        <form class="form-horizontal" method="POST" id="registerForm" action="{{ route('storestudent') }}" enctype="multipart/form-data">

                            @endif
                            {{ csrf_field() }}

                            @if(session('register_role', 'student') != 'student')
                            <div class="form-row">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
                                    <label for="name" class="col-md-4 control-label">* @lang('Full Name')</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6">
                                    <label for="email" class="col-md-4 control-label">* @lang('E-Mail Address')</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }} col-md-6">
                                    <label for="phone_number" class="col-md-4 control-label">* @lang('Phone Number')</label>
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">

                                    @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
                                    <label for="password" class="col-md-4 control-label">* @lang('Password')</label>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="password-confirm" class="col-md-4 control-label">* @lang('Confirm Password')</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            @endif

                            @if(session('register_role', 'student') == 'student')
                            <!-- <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} col-md-6">
                            <label for="section" class="col-md-4 control-label">* @lang('Class and Section')</label>

                            <div class="col-md-6">
                                <select id="section" class="form-control" name="section" required>
                                    @foreach (session('register_sections') as $section)
                                    <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                                        {{$section->class->class_number}}
                                    </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }} col-md-6">
                            <label for="birthday" class="col-md-4 control-label">* @lang('Birthday')</label>

                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control" name="birthday" value="{{ old('birthday') }}" required>

                                @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> -->
                            @endif
                            @if(session('register_role', 'teacher') == 'teacher')
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-4 control-label">* @lang('Department')</label>

                                <div class="col-md-{{ session('register_role', 'teacher') == 'teacher' ? '12' : '6' }}">
                                    <select id="department" class="form-control" name="department_id" required>
                                        @if (count(session('departments')) > 0)
                                        @foreach (session('departments') as $d)
                                        <option value="{{$d->id}}">{{$d->department_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('class_teacher') ? ' has-error' : '' }}">
                                <label for="class_teacher" class="col-md-4 control-label">@lang('Class Teacher')</label>

                                <div class="col-md-{{ session('register_role', 'teacher') == 'teacher' ? '12' : '6' }}">
                                    <select id="class_teacher" class="form-control" name="class_teacher_section_id">
                                        <option selected="selected" value="0">@lang('Not Class Teacher')</option>
                                        @foreach (session('register_sections') as $section)
                                        <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                                            {{$section->class->class_number}}
                                        </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('class_teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class_teacher') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(session('register_role', 'student') != 'student')
                            <div class="form-row">
                                <div class="form-group{{ $errors->has('blood_group') ? ' has-error' : '' }} col-md-6">
                                    <label for="blood_group" class="col-md-4 control-label">@lang('Blood Group')</label>
                                    <select id="blood_group" class="form-control" name="blood_group">
                                        <option selected="selected">A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                    </select>

                                    @if ($errors->has('blood_group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('blood_group') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('nationality') ? ' has-error' : '' }} col-md-6">
                                    <label for="nationality" class="col-md-4 control-label">* @lang('Nationality')</label>
                                    <input id="nationality" type="text" class="form-control" name="nationality" value="{{ old('nationality') }}" required>

                                    @if ($errors->has('nationality'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} col-md-12">
                                    <label for="gender" class="col-md-4 control-label">@lang('Gender')</label>
                                    <select id="gender" class="form-control" name="gender">
                                        <option selected="selected">@lang('Male')</option>
                                        <option>@lang('Female')</option>
                                    </select>

                                    @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(session('register_role', 'student') == 'student')

                            <section class="section">
                                <div class="section-body">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                @if($errors->any())
                                                <div class="col-lg-12 alert alert-danger">
                                                    {{ $errors->first() }}
                                                </div>
                                                @endif
                                            </div>

                                            <h6>Personal Information</h6>
                                            <fieldset>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Jamb Registration Number<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="jambregno" required>
                                                            <input type="hidden" class="form-control" name="uid" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Passport<span style="color:red">*</span></label>
                                                            <input type="file" class="form-control" name="passport" id="passport" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">National Identity Number<span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" name="nin" id="nin" maxlength="11" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Surname<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="surname" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Firstname<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="firstname" id="firstname">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Othernames</label>
                                                            <input type="text" class="form-control" name="othernames" id="othernames">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Gender<span style="color:red">*</span></label>
                                                            <select class="form-control" name="gender" required>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Phone Number<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Date Of Birth<span style="color:red">*</span></label>
                                                            <input type="date" class="form-control" name="dob" id="dob" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Marital Status<span style="color:red">*</span></label>
                                                            <select class="form-control" name="maritalstatus" required>
                                                                <option value="married">Married</option>
                                                                <option value="single">Single</option>
                                                                <option value="divorced">Divorced</option>
                                                                <option value="widow">Widow</option>
                                                                <option value="widower">Widower</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Religion</label>
                                                            <select class="form-control" name="religion">
                                                                <option value="christian">Christian</option>
                                                                <option value="muslim">Muslim</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Blood Group</label>
                                                            <select class="form-control" name="bloodgroup">
                                                                <option value="0+">O+</option>
                                                                <option value="0-">0-</option>
                                                                <option value="A+">A+</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B-">B-</option>
                                                                <option value="B+-">B+</option>
                                                                <option value="AB-">AB-</option>
                                                                <option value="AB+">AB+</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Email<span style="color:red">*</span></label>
                                                            <input type="email" class="form-control" name="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Contact Address</label>
                                                            <textarea name="contactaddress" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Permanent Address</label>
                                                            <textarea name="permanentaddress" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Country<span style="color:red">*</span></label>
                                                            <select class="form-control" name="country_id" id="country_id" required>
                                                                @foreach(session('countries') as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">State<span style="color:red">*</span></label>
                                                            <select class="form-control" name="state_id" id="state_id" required>
                                                                <option>--Select State--</option>
                                                                @foreach(session('states') as $state)
                                                                <option value="{{$state->id}}"></option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">LGA<span style="color:red">*</span></label>
                                                            <select class="form-control" name="city_id" id="city_id" required>
                                                                <option>--Select City--</option>
                                                                @foreach(session('cities') as $city)
                                                                <option value="{{$city->id}}"></option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Next Of Kin<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="nok_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Next Of Kin Relationship<span style="color:red">*</span></label>
                                                            <select class="form-control" name="nok_relationship" required>
                                                                <option value="wife">Wife</option>
                                                                <option value="husband">Husband</option>
                                                                <option value="brother">Brother</option>
                                                                <option value="sister">Sister</option>
                                                                <option value="father">Father</option>
                                                                <option value="mother">Mother</option>
                                                                <option value="uncle">Uncle</option>
                                                                <option value="aunty">Aunty</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Next Of Kin Email</label>
                                                            <input type="email" class="form-control" name="nok_email" id="nok_email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Next Of Kin Phone<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="nok_phone" id="nok_phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Next Of Kin Address<span style="color:red">*</span></label>
                                                            <textarea name="nok_address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Sponsor<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="sponsor_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Sponsor Email</label>
                                                            <input type="email" class="form-control" name="sponsor_email" id="sponsor_email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Sponsor Phone<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="sponsor_phone" id="sponsor_phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Sponsor Address<span style="color:red">*</span></label>
                                                            <textarea name="sponsor_address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Are you physically challenged?<span style="color:red">*</span></label>
                                                            <select class="form-control" id="challenged_dropdown" required>
                                                                <option>Choose option</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12" id="challenged2" style="display: none;">
                                                        <div class="form-line">
                                                            <label class="form-label">Form of challenge</label>
                                                            <input type="text" class="form-control" name="challenged">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-6">
                                                        <div class="form-line">
                                                            <label class="form-label">Hobbies</label>
                                                            <input type="text" class="form-control" name="hobbies" id="hobbies">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-6">
                                                        <div class="form-line">
                                                            <label class="form-label">Skills/Talents</label>
                                                            <input type="text" class="form-control" name="skills" id="skills">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h6>Academic Information</h6>
                                            <fieldset>
                                                <div class="form-row">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">College/Faculty<span style="color:red">*</span></label>
                                                            <select class="form-control" name="faculty_id" id="faculty_id" required>
                                                                <option value="">--Select faculty--</option>
                                                                @foreach(session('faculties') as $faculty)
                                                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Department<span style="color:red">*</span></label>
                                                            <select class="form-control" name="department_id" id="department_id" required>
                                                                <option>--Select course--</option>
                                                                @foreach(session('departments') as $department)
                                                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Course admitted into<span style="color:red">*</span></label>
                                                            <select class="form-control" name="course_id" id="course_id" required>
                                                                <option>--Select course--</option>
                                                                @foreach(session('classes') as $class)
                                                                <option value="{{$class->id}}">{{$class->class_number}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Mode Of Entry<span style="color:red">*</span></label>
                                                            <select class="form-control" name="modeofentry" id="modeofentry" required>
                                                                <option value="utme">UTME</option>
                                                                <option value="de">DE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row" id="de_div" style="display: none;">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Overall Grade Obtained (This will be hidden)</label>
                                                            <input type="text" name="de_grade" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Exam Date</label>
                                                            <input type="date" name="de_examdate" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Name Of Institution</label>
                                                            <input type="text" name="de_institution" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Number Of O’Level Sittings </label>
                                                            <select class="form-control" name="sitting" id="sitting" required>
                                                                <option>Choose option</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <p>1st Sitting</p>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">O’Level obtained </label>
                                                            <select class="form-control" name="qualification" id="qualification" required>
                                                                <option>Choose option</option>
                                                                <option value="GCE">GCE</option>
                                                                <option value="NECO">NECO</option>
                                                                <option value="NABTEB">NABTEB</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Name Of Institution</label>
                                                            <input type="text" name="qualification_institution" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-4">
                                                        <div class="form-line">
                                                            <label class="form-label">Exam Date</label>
                                                            <input type="date" name="qualification_examdate" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row" id="2nd" style="display: none;">
                                                    <!--Second sitting-->
                                                    <div class="form-group form-float col-md-12">
                                                        <p>2nd Sitting</p>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">O’Level obtained </label>
                                                            <select class="form-control" name="qualification_2" id="qualification_2" required>
                                                                <option>Choose option</option>
                                                                <option value="GCE">GCE</option>
                                                                <option value="NECO">NECO</option>
                                                                <option value="NABTEB">NABTEB</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Name Of Institution</label>
                                                            <input type="text" name="qualification_institution_2" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float col-md-12">
                                                        <div class="form-line">
                                                            <label class="form-label">Exam Date</label>
                                                            <input type="date" name="qualification_examdate_2" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!--/second sitting-->
                                                </div>
                                                <!--div class="form-row">
                                                <div class="form-group form-float col-md-12" id="olevel_file">
                                                    <div class="form-line">
                                                        <label class="form-label">Upload O'Level (First sitting)<span style="color:red">*</span></label>
                                                        <input type="file" name="olevel_file" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float col-md-12" id="olevel_file_1">
                                                    <div class="form-line">
                                                        <label class="form-label">Upload O'Level (Second sitting if any)</label>
                                                        <input type="file" name="olevel_file_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float col-md-12">
                                                    <div class="form-line">
                                                        <label class="form-label">Upload Jamb Admission Letter<span style="color:red">*</span></label>
                                                        <input type="file" name="jamb_file" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float col-md-12" id="diploma_file" style="display: none;">
                                                    <div class="form-line">
                                                        <label class="form-label">Upload Diploma Result</label>
                                                        <input type="file" name="diploma_file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float col-md-12" id="degree_file" style="display: none;">
                                                    <div class="form-line">
                                                        <label class="form-label">Upload Degree Result</label>
                                                        <input type="file" name="degree_file" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group form-float col-md-12">
                                                    <div class="form-line">
                                                        <label class="form-label">Upload Proof of payment of School fees<span style="color:red">*</span></label>
                                                        <input type="file" name="registration_proof" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div-->

                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            @endif

                            @if(session('register_role', 'student') != 'student')
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">@lang('Upload Profile Picture')</label>
                                    <input type="hidden" id="picPath" name="pic_path">
                                    @component('components.file-uploader',['upload_type'=>'profile'])
                                    @endcomponent
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-12">
                                    <a style="margin-right: 2px;" class="btn btn-danger" href="{{ route('schools.index') }}">
                                        <!-- <i class="material-icons">gamepad</i>  -->
                                        <span class="nav-link-text">@lang('Back to Manage School')</span>
                                    </a>
                                    <button type="submit" id="registerBtn" class="btn btn-primary">
                                        @lang('Register')
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function() {
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
        });
        $('#session').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });
    $('#registerBtn').click(function() {
        $("#registerForm").submit();
    });
</script>
@endsection