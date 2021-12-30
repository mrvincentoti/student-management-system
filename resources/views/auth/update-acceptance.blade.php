@extends('layouts.login')

@section('title', __('Login'))

@section('content')
<style type="text/css">
    .navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show>.nav-link {
        color: #ffffff !important;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #ffffff !important;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        background-color: #ffffff !important;
        color: #011c38 !important;
    }
</style>

<div class="col-12">
    <div class="card">
        <div class="card-body">
             @include('layouts.nav')
        </div>
    </div>
     <div class="container">
      <section class="section">
        <div class="section-body">
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
              <div class="alert alert-warning alert-dismissible show fade alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  Please, provide a valid email and phone number while registering.<br>
                  You will not be able to complete your registration if your email and phone number are invalid.
                </div>
              </div>
            </div>
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
                  <form id="wizard_with_validation" method="POST" action="{{ route('update-details-post') }}"
                  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>Personal Information</h3>
                    <fieldset>
                     <div class="form-row">
                        <div class="form-group form-float col-md-6">
                          <div class="form-line">
                            <label class="form-label">Jamb Registration Number<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="jambregno" value="{{$applicant->jambregno}}" required readonly>
                            <input type="hidden" class="form-control" name="uuid" value="{{$applicant->id}}">
                          </div>
                        </div>
                        
                        <div class="form-group form-float col-md-6">
                          <div class="form-line">
                            <label class="form-label">National Identity Number<span style="color:red">*</span></label>
                            <input type="number" class="form-control" name="nin" id="nin"  maxlength="11" required value="{{$applicant->nin}}">
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Surname<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="surname" value="{{$applicant->surname}}" required readonly>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Firstname<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="{{$applicant->firstname}}" required readonly>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Othernames</label>
                            <input type="text" class="form-control" name="othernames" value="{{$applicant->othername}}" id="othernames">
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Gender<span style="color:red">*</span></label>
                            <select class="form-control" name="gender" required>
                                <option value="Male" {{strtolower($applicant->gender) == strtolower('male')  ? 'selected' : ''}}>Male</option>
                                <option value="Female" {{strtolower($applicant->gender) == strtolower('female')  ? 'selected' : ''}}>Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Phone Number<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" required value="{{$applicant->phone_number}}">
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Date Of Birth<span style="color:red">*</span></label>
                            <input type="date" class="form-control" name="dob" id="dob" required value="{{$applicant->dob}}">
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Marital Status<span style="color:red">*</span></label>
                            <select class="form-control" name="maritalstatus" required>
                               <option value="married" {{$applicant->maritalstatus == strtolower('married')  ? 'selected' : ''}}>Married</option>
                                <option value="single" {{$applicant->maritalstatus == strtolower('single')  ? 'selected' : ''}}>Single</option>
                                <option value="divorced" {{$applicant->maritalstatus == strtolower('divorced')  ? 'selected' : ''}}>Divorced</option>
                                <option value="widow" {{$applicant->maritalstatus == strtolower('widow')  ? 'selected' : ''}}>Widow</option>
                                <option value="widower" {{$applicant->maritalstatus == strtolower('widower')  ? 'selected' : ''}}>Widower</option>   
                            </select>
                          </div>
                        </div>
                        <!-- <div class="form-group form-float col-md-4">
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
                            </select>
                          </div>
                        </div> -->
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Email<span style="color:red">*</span></label>
                            <input type="email" class="form-control" name="email" required value="{{$applicant->email}}">
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Contact Address</label>
                            <textarea name="contactaddress" cols="30" rows="3" class="form-control no-resize"
                            required>{{$applicant->address}}</textarea>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Permanent Address</label>
                            <textarea name="permanentaddress" cols="30" rows="3" class="form-control no-resize"
                            required></textarea>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Country<span style="color:red">*</span></label>
                            <select class="form-control" name="country_id" id="country_id" required>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$applicant->country_id == $country->id  ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">State<span style="color:red">*</span></label>
                            <select class="form-control" name="state_id" id="state_id" required>
                               @foreach($states as $state)
                                <option value="{{$state->id}}" {{$applicant->state_id == $state->id  ? 'selected' : ''}}>{{$state->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">LGA<span style="color:red">*</span></label>
                            <select class="form-control" name="city_id" id="city_id" required>
                               @foreach($cities as $city)
                                <option value="{{$city->id}}" {{$applicant->lga_id == $city->id  ? 'selected' : ''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="form-row">
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
                            <textarea name="nok_address" cols="30" rows="3" class="form-control no-resize"
                            required></textarea>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Sponsor<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="sponsor_name" required value="{{$applicant->sponsor_name}}">
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Sponsor Email</label>
                            <input type="email" class="form-control" name="sponsor_email" id="sponsor_email" value="{{$applicant->sponsor_email}}">
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Sponsor Phone<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="sponsor_phone" id="sponsor_phone" required value="{{$applicant->sponsor_phone}}">
                          </div>
                        </div>
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Sponsor Address<span style="color:red">*</span></label>
                            <textarea name="sponsor_address" cols="30" rows="3" class="form-control no-resize"
                            required>{{$applicant->sponsor_address}}</textarea>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="form-row">
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
                        <div class="form-group form-float col-md-12"  id="challenged2" style="display: none;">
                          <div class="form-line">
                            <label class="form-label">Challenge (This will be hidden)</label>
                            <input type="text" class="form-control" name="challenged">
                          </div>
                        </div>
                      </div> -->
                      <!-- <div class="form-row">
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
                      </div> -->
                    </fieldset>
                    <h3>Academic Information</h3>
                    <fieldset>
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">College/Faculty<span style="color:red">*</span></label>
                            <select class="form-control" name="faculty_id" id="faculty_id" required>
                              <option value="">--Select faculty--</option>
                               @foreach($faculties as $faculty)
                                <option value="{{$faculty->id}}" {{$applicant->faculty_id == $faculty->id  ? 'selected' : ''}}>{{$faculty->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Department<span style="color:red">*</span></label>
                            <select class="form-control" name="course" id="course" required>
                               <option>--Select course--</option>
                               @foreach($departments as $department)
                                <option value="{{$department->id}}" {{$applicant->department_id == $department->id  ? 'selected' : ''}}>{{$department->department_name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Programme admitted into<span style="color:red">*</span></label>
                            <select class="form-control" name="course_id" id="course_id" required>
                               <option>--Select course--</option>
                               @foreach($classes as $class)
                                <option value="{{$class->id}}" {{$applicant->course_id == $class->id  ? 'selected' : ''}}>{{$class->class_number}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Duration Of Course<span style="color:red">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control" required readonly value="{{$applicant->duration}}">
                            
                          </div>
                        </div>
                      </div> 
                      <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Mode Of Entry<span style="color:red">*</span></label>
                            <select class="form-control" name="modeofentry" id="modeofentry" required>
                              <option value="utme">UTME</option>
                              <option value="utme">Remedial Programme</option>
                              <option value="de">DE</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                    <h3>Proof of payment/Declaration</h3>
                    <fieldset>
                      <div class="form-row">
                        <div class="col-md-12">
                          <div class="text-danger mb-2">Only pdf, png, jpeg, and jpg files are allowed</div>
                        </div>
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Upload proof of payment<span style="color:red">*</span></label>
                            <input type="file" name="proof_file" id="file" class="form-control" required>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Upload Parent/Guidance Consent form<span style="color:red">*</span></label>
                            <input type="file" name="consent_file" class="form-control" required>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-12">
                          <p class="mt-4 mb-4">
                             I hereby declare that all the information given in this form is to the best of my knowledge and belief, correct. 
                             Any false or incomplete information given in this form will automatically disqualify me from continuing any course
                             of study in the University.   
                          </p>
                        </div>
                      </div>
                      <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                      <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>   
    </div>        
</div>
@endsection


