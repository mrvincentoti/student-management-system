<!-- <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #gradient
            {
            width: 100%;a
            height: 800px;
            padding: 0px;
            margin: 0px;
            }
        </style>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body id="gradient">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="m-b-md">
                    <img src="appname.svg" width="500">
                </div>
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">@lang('Home')</a>
                        @else
                            <a href="{{ route('login') }}">@lang('Login')</a>
                        @endauth
                    @endif
                    <a href="https://github.com/changeweb/Unifiedtransform">
                        <i class="fa fa-github"></i>
                        @lang('GitHub')
                    </a>
                </div>
            </div>
        </div>
        <script src="{{asset('js/jquery-2.1.3.min.js')}}"></script>
        <script>
        </script>
    </body>
</html> -->

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
                  <form id="wizard_with_validation" method="POST" action="{{ route('applicant') }}"
                  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>Personal Information</h3>
                    <fieldset>
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Jamb Registration Number<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="jambregno" required>
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
                            <input type="number" class="form-control" name="nin" id="nin"  maxlength="11" required>
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
                            <input type="text" class="form-control" name="firstname" id="firstname" required>
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
                            <textarea name="contactaddress" cols="30" rows="3" class="form-control no-resize"
                            required></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Permanent Address</label>
                            <textarea name="permanentaddress" cols="30" rows="3" class="form-control no-resize"
                            required></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Country<span style="color:red">*</span></label>
                            <select class="form-control" name="country_id" id="country_id" required>
                                @foreach($countries as $country)
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
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">LGA<span style="color:red">*</span></label>
                            <select class="form-control" name="city_id" id="city_id" required>
                              <option>--Select City--</option>
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
                            <textarea name="nok_address" cols="30" rows="3" class="form-control no-resize"
                            required></textarea>
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
                            <textarea name="sponsor_address" cols="30" rows="3" class="form-control no-resize"
                            required></textarea>
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
                        <div class="form-group form-float col-md-12"  id="challenged2" style="display: none;">
                          <div class="form-line">
                            <label class="form-label">Challenge (This will be hidden)</label>
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
                        <!-- <div class="form-group form-float col-md-6">
                          <div class="form-line">
                            <label class="form-label">School<span style="color:red">*</span></label>
                            <select class="form-control" name="school" id="school" required>
                              <option value="1">Medicine</option>
                              <option value="2">Science</option>
                              <option value="3">Art</option>
                            </select>
                          </div>
                        </div> -->
                        <div class="form-group form-float col-md-12">
                          <div class="form-line">
                            <label class="form-label">Course applied for<span style="color:red">*</span></label>
                            <select class="form-control" name="course" id="course" required>
                               <option>--Select course--</option>
                               @foreach($departments as $department)
                               <option value="{{$department->id}}">{{$department->department_name}}</option>
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
                        <div class="form-group form-float col-md-4">
                          <div class="form-line">
                            <label class="form-label">Higher Qualifications Obtained</label>
                            <select class="form-control" name="qualification" id="qualification" required>
                              <option >Choose option</option>
                              <option value="olevel">O'Level</option>
                              <option value="diploma">Diploma</option>
                              <option value="degree">Degree</option>
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
                      <div class="form-row">
                        <div class="form-group form-float col-md-12" id="olevel_file">
                          <div class="form-line">
                            <label class="form-label">Upload O'Level (First sitting)</label>
                            <input type="file" name="olevel_file" class="form-control">
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
                            <label class="form-label">Upload Jamb Result</label>
                            <input type="file" name="jamb_file" class="form-control">
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
                      </div>
                      
                    </fieldset>
                    <h3>Declaration</h3>
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