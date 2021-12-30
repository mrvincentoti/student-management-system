@extends('layouts.landing')

@section('title', __('Edit'))

@section('content')
@if($user->role == 'student' || $user->role == 'applicant')
  <div class="container">
  <section class="section">
    <div class="section-body">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Account</h4>
            </div>
            <div class="row">
              @if($errors->any())
              <div class="col-lg-12 alert alert-danger">
                {{ $errors->first() }}
              </div>
              @endif
            </div>
            <div class="card-body">
              <form id="wizard_with_validation-1" method="POST" action="{{ route('applicant') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h3>Personal Information</h3>
                <fieldset>
                  <div class="form-row">
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Jamb Registration Number<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="jambregno" value="{{$user->jambregno}}" required readonly>
                        <input type="hidden" class="form-control" name="uid" value="{{$user->id}}" required readonly>
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
                        <input type="number" class="form-control" name="nin" id="nin" maxlength="11" value="{{$user->nin}}" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Surname<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="surname" value="{{$user->surname}}" required readonly>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Firstname<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{$user->firstname}}" readonly required>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Othernames</label>
                        <input type="text" class="form-control" name="othernames" value="{{$user->othername}}" id="othernames">
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Gender<span style="color:red">*</span></label>
                        <select class="form-control" name="gender" required>
                          <option value="Male" {{$user->gender == strtolower('male')  ? 'selected' : ''}}>Male</option>
                          <option value="Female" {{$user->gender == strtolower('female')  ? 'selected' : ''}}>Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Phone Number<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="phone_number" value="{{$user->phone_number}}" id="phone_number" required>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Date Of Birth<span style="color:red">*</span></label>
                        <input type="date" class="form-control" name="dob" id="dob" required value="{{$user->dob}}">
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Marital Status<span style="color:red">*</span></label>
                        <select class="form-control" name="maritalstatus" required>
                          <option value="married" {{$user->maritalstatus == strtolower('married')  ? 'selected' : ''}}>Married</option>
                          <option value="single" {{$user->maritalstatus == strtolower('single')  ? 'selected' : ''}}>Single</option>
                          <option value="divorced" {{$user->maritalstatus == strtolower('divorced')  ? 'selected' : ''}}>Divorced</option>
                          <option value="widow" {{$user->maritalstatus == strtolower('widow')  ? 'selected' : ''}}>Widow</option>
                          <option value="widower" {{$user->maritalstatus == strtolower('widower')  ? 'selected' : ''}}>Widower</option>
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
                        <input type="email" class="form-control" name="email" value="{{$user->email}}" required readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group form-float col-md-12">
                      <div class="form-line">
                        <label class="form-label">Contact Address</label>
                        <textarea name="contactaddress" cols="30" rows="3" class="form-control no-resize" required>{{$user->address}}</textarea>
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
                          @foreach($countries as $country)
                          <option value="{{$country->id}}" {{$user->country_id == $country->id  ? 'selected' : ''}}>{{$country->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">State<span style="color:red">*</span></label>
                        <select class="form-control" name="state_id" id="state_id" required>
                          <option>--Select State--</option>
                          @foreach($states as $state)
                          <option value="{{$state->id}}" {{$user->state_id == $state->id  ? 'selected' : ''}}>{{$state->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">LGA<span style="color:red">*</span></label>
                        <select class="form-control" name="city_id" id="city_id" required>
                          <option>--Select City--</option>
                          @foreach($cities as $city)
                          <option value="{{$city->id}}" {{$user->lga_id == $city->id  ? 'selected' : ''}}>{{$city->name}}</option>
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
                        <input type="text" class="form-control" name="sponsor_name" value="{{$user->sponsor_name}}" required>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Sponsor Email</label>
                        <input type="email" class="form-control" name="sponsor_email" value="{{$user->sponsor_email}}" id="sponsor_email">
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Sponsor Phone<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="sponsor_phone" id="sponsor_phone" value="{{$user->sponsor_phone}}" required>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-12">
                      <div class="form-line">
                        <label class="form-label">Sponsor Address<span style="color:red">*</span></label>
                        <textarea name="sponsor_address" cols="30" rows="3" class="form-control no-resize" required>{{$user->sponsor_address}}</textarea>
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
                <h3>Academic Information</h3>
                <fieldset>
                  <div class="form-row">
                  </div>
                  <div class="form-row">
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">College/Faculty<span style="color:red">*</span></label>
                        <select class="form-control" name="faculty_id" id="faculty_id" required readonly>
                          <option value="">--Select faculty--</option>
                          @foreach($faculties as $faculty)
                          <option value="{{$faculty->id}}" {{$user->faculty_id == $faculty->id  ? 'selected' : ''}}>{{$faculty->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Department<span style="color:red">*</span></label>
                        <select class="form-control" name="department_id" id="department_id" required readonly>
                          <option>--Select course--</option>
                          @foreach($departments as $department)
                          <option value="{{$department->id}}" {{$user->department_id == $department->id  ? 'selected' : ''}}>{{$department->department_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float col-md-4">
                      <div class="form-line">
                        <label class="form-label">Course admitted into<span style="color:red">*</span></label>
                        <select class="form-control" name="course_id" id="course_id" required readonly>
                          <option>--Select course--</option>
                          @foreach($classes as $class)
                          <option value="{{$class->id}}" {{$user->course_id == $class->id  ? 'selected' : ''}}>{{$class->class_number}}</option>
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
                  <div class="form-row">
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
                    <!-- <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Upload Parent/Guidance Consent form<span style="color:red">*</span></label>
                            <input type="file" name="consent_file" class="form-control">
                          </div>
                        </div> -->
                    <div class="form-group form-float col-md-12">
                      <div class="form-line">
                        <label class="form-label">Upload Proof of payment of School fees<span style="color:red">*</span></label>
                        <input type="file" name="registration_proof" class="form-control" required>
                      </div>
                    </div>
                  </div>

                </fieldset>
                <!-- <h3>Declaration</h3>
                <fieldset>
                  <div class="form-row">
                    <div class="form-group form-float col-md-12">
                      <p class="mt-4 mb-4">
                        I hereby declare that all the information given in this form is to the best of my knowledge and belief, correct.
                        Any false or incomplete information given in this form will automatically disqualify me from continuing any course
                        of study in the University.
                      </p>
                    </div>
                  </div>
                  <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                  <label for="acceptTerms-2" style="margin-left: 5px;"> I agree with the Terms and Conditions.</label>
                </fieldset> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@else
<div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
    <div class="row">
        <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 8 }}" id="main-container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                     <div class="card-header">
                        <h4>Edit</h4>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ url('edit/user') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="user_role" value="{{$user->role}}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">* @lang('Full Name')</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"
                                    required>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('E-Mail Address')</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">* @lang('Phone Number')</label>

                            <div class="col-md-12">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                    value="{{ $user->phone_number }}">

                                @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        @if($user->role == 'teacher')
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">@lang('Department')</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control" name="department_id">
                                    @if (count($departments)) > 0)
                                    @foreach ($departments as $d)
                                    <option value="{{$d->id}}" @if ($d->id == old('department_id', $user->department_id))
											selected="selected"
										@endif
										>{{$d->department_name}}</option>
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

                            <div class="col-md-6">
                                <select id="class_teacher" class="form-control" name="class_teacher_section_id">
                                    @foreach ($sections as $section)
                                    <option value="{{$section->id}}" @if ($section->id == old('class_teacher_section_id', $user->section_id))
											selected="selected"
										@endif
										>@lang('Section'): {{$section->section_number}} @lang('Class'):
                                        {{$section->class->class_number}}</option>
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

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">@lang('address')</label>

                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control" name="address"
                                    value="{{ $user->address }}">

                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="about" class="col-md-4 control-label">@lang('About')</label>

                            <div class="col-md-12">
                                <textarea id="about" class="form-control" name="about">{{ $user->about }}</textarea>

                                @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        @if($user->role == 'student')

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">* @lang('Birthday')</label>

                            <div class="col-md-12">
                                <input id="birthday" type="text" class="form-control" name="birthday" required>

                                @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('session') ? ' has-error' : '' }}">
                            <label for="session" class="col-md-4 control-label">* @lang('Session')</label>

                            <div class="col-md-6">
                                <input id="session" type="text" class="form-control" name="session" required>

                                @if ($errors->has('session'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('session') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                            <label for="group" class="col-md-4 control-label">@lang('Group')</label>

                            <div class="col-md-6">
                                <input id="group" type="text" class="form-control" name="group"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['group'];} @endphp"
                                    placeholder="@lang('Science, Arts, Commerce,etc.')">

                                @if ($errors->has('group'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('group') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                            <label for="father_name" class="col-md-4 control-label">* @lang('Father\'s Name')</label>

                            <div class="col-md-6">
                                <input id="father_name" type="text" class="form-control" name="father_name"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_name'];} @endphp" required>

                                @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_phone_number') ? ' has-error' : '' }}">
                            <label for="father_phone_number" class="col-md-4 control-label">@lang('Father\'s Phone Number')</label>

                            <div class="col-md-6">
                                <input id="father_phone_number" type="text" class="form-control"
                                    name="father_phone_number" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_phone_number'];} @endphp">

                                @if ($errors->has('father_phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_national_id') ? ' has-error' : '' }}">
                            <label for="father_national_id" class="col-md-4 control-label">@lang('Father\'s National ID')</label>

                            <div class="col-md-6">
                                <input id="father_national_id" type="text" class="form-control"
                                    name="father_national_id" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_national_id'];} @endphp">

                                @if ($errors->has('father_national_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_national_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_occupation') ? ' has-error' : '' }}">
                            <label for="father_occupation" class="col-md-4 control-label">@lang('Father\'s Occupation')</label>

                            <div class="col-md-6">
                                <input id="father_occupation" type="text" class="form-control" name="father_occupation"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_occupation'];} @endphp">

                                @if ($errors->has('father_occupation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_occupation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_designation') ? ' has-error' : '' }}">
                            <label for="father_designation" class="col-md-4 control-label">@lang('Father\'s Designation')</label>

                            <div class="col-md-6">
                                <input id="father_designation" type="text" class="form-control"
                                    name="father_designation" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_designation'];} @endphp">

                                @if ($errors->has('father_designation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_designation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_annual_income') ? ' has-error' : '' }}">
                            <label for="father_annual_income" class="col-md-4 control-label">@lang('Father\'s Annual Income')</label>

                            <div class="col-md-6">
                                <input id="father_annual_income" type="text" class="form-control"
                                    name="father_annual_income"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_annual_income'];} @endphp">

                                @if ($errors->has('father_annual_income'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_annual_income') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                            <label for="mother_name" class="col-md-4 control-label">* @lang('Mother\'s Name')</label>

                            <div class="col-md-6">
                                <input id="mother_name" type="text" class="form-control" name="mother_name"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_name'];} @endphp" required>

                                @if ($errors->has('mother_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_phone_number') ? ' has-error' : '' }}">
                            <label for="mother_phone_number" class="col-md-4 control-label">@lang('Mother\'s Phone Number')</label>

                            <div class="col-md-6">
                                <input id="mother_phone_number" type="text" class="form-control"
                                    name="mother_phone_number" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_phone_number'];} @endphp">

                                @if ($errors->has('mother_phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_national_id') ? ' has-error' : '' }}">
                            <label for="mother_national_id" class="col-md-4 control-label">@lang('Mother\'s National ID')</label>

                            <div class="col-md-6">
                                <input id="mother_national_id" type="text" class="form-control"
                                    name="mother_national_id" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_national_id'];} @endphp">

                                @if ($errors->has('mother_national_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_national_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_occupation') ? ' has-error' : '' }}">
                            <label for="mother_occupation" class="col-md-4 control-label">@lang('Mother\'s Occupation')</label>

                            <div class="col-md-6">
                                <input id="mother_occupation" type="text" class="form-control" name="mother_occupation"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_occupation'];} @endphp">

                                @if ($errors->has('mother_occupation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_occupation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_designation') ? ' has-error' : '' }}">
                            <label for="mother_designation" class="col-md-4 control-label">@lang('Mother\'s Designation')</label>

                            <div class="col-md-6">
                                <input id="mother_designation" type="text" class="form-control"
                                    name="mother_designation" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_designation'];} @endphp">

                                @if ($errors->has('mother_designation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_designation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_annual_income') ? ' has-error' : '' }}">
                            <label for="mother_annual_income" class="col-md-4 control-label">@lang('Mother\'s Annual Income')</label>

                            <div class="col-md-6">
                                <input id="mother_annual_income" type="text" class="form-control"
                                    name="mother_annual_income"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_annual_income'];} @endphp">

                                @if ($errors->has('mother_annual_income'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_annual_income') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="javascript:history.back()" class="btn btn-danger" style="margin-right: 2%;"
                                    role="button">@lang('Cancel')</a>
                                <input type="submit" role="button" class="btn btn-success" value="@lang('Save')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
        });
        $('#birthday').datepicker('setDate',
            "@php if(isset($user->studentInfo['birthday'])){echo Carbon\Carbon::parse($user->studentInfo['birthday'])->format('Y-d-m');} @endphp
");
        $('#session').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('#session').datepicker('setDate',
            "@php if(isset($user->studentInfo['session'])){echo Carbon\Carbon::parse($user->studentInfo['session'])->format('Y');} @endphp
");
    });
</script>
@endsection