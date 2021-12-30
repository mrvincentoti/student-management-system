@extends('layouts.landing')

@section('content')
<style>
  .badge-download {
    background-color: transparent !important;
    color: #464443 !important;
  }

  .list-group-item-text {
    font-size: 12px;
  }
</style>
@if(Auth::user()->role != 'applicant')
<div class="container-fluid">
  <div class="row ">
    @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
    @endif
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Students</h5>
                  <h2 class="mb-3 font-18">{{$totalStudents}}</h2>
                  <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('admin/img/banner/1.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Teachers</h5>
                  <h2 class="mb-3 font-18">{{$totalTeachers}}</h2>
                  <!-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('admin/img/banner/2.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Classes</h5>
                  <h2 class="mb-3 font-18">{{$totalClasses}}</h2>
                  <!-- <p class="mb-0"><span class="col-green">18%</span>
                        Increase</p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('admin/img/banner/3.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Sections</h5>
                  <h2 class="mb-3 font-18">{{$totalSections}}</h2>
                  <!-- <p class="mb-0"><span class="col-green">42%</span> Increase</p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('admin/img/banner/4.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Active Exams</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            @if(count($exams) > 0)
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th>Exam Name</th>
                  <th>Notice Published</th>
                  <th>Result Published</th>
                </tr>
                @foreach($exams as $exam)
                <tr>
                  <td>{{$exam->exam_name}}</td>
                  <td class="align-middle">
                    {{($exam->notice_published === 1)?__('Yes'):__('No')}}
                  </td>
                  <td>{{($exam->result_published === 1)?__('Yes'):__('No')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            @lang('No Active Examination')
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-4 col-sm-12 col-lg-4">
      <div class="card gradient-bottom">
        <div class="card-header">
          <h4>Notice</h4>
        </div>
        <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none; touch-action: none;">
          @if(count($notices) > 0)
          <ul class="list-unstyled list-unstyled-border">
            @foreach($notices as $notice)
            <a href="{{url($notice->file_path)}}">
              <li class="media">
                <i class="badge badge-download material-icons">
                  get_app
                </i>
                <div class="media-body">
                  <div class="media-title">{{$notice->title}}</div>
                  <div class="mt-12">
                    <div class="budget-price">
                      <div class="budget-price-label">
                        @lang('Published at'): {{$notice->created_at->format('M d Y h:i:sa')}}
                      </div>
                    </div>
                  </div>
                </div>

              </li>
            </a>
            <hr />
            @endforeach
          </ul>
          @else
          @lang('No New Notice')
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-md-12" id="main-container">
      <div class="card" style="border-top: 0px;">
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
          <!-- <div class="row">
                        <div class="page-panel-title">@lang('Dashboard')</div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">@lang('Students') - <b>{{$totalStudents}}</b></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">@lang('Teachers') - <b>{{$totalTeachers}}</b></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-dark mb-3">
                                <div class="card-header">@lang('Types of Books In Library') - <b>{{$totalBooks}}</b></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">@lang('Classes') - <b>{{$totalClasses}}</b></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header">@lang('Sections') - <b>{{$totalSections}}</b></div>
                            </div>
                        </div>
                    </div>
                    <p></p> -->
          <div class="row">
            <!-- <div class="col-sm-8">
                            <div class="panel panel-default" style="background-color: rgba(242,245,245,0.8);">
                                <div class="panel-body">
                                    <h3>@lang('Welcome to') {{Auth::user()->school->name}}</h3>
                                    @lang('Your presence and cooperation will help us to improve the education system of our organization.')
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="page-panel-title">@lang('Active Exams')</div>
                                <div class="panel-body">
                                    @if(count($exams) > 0)
                                    <table class="table">
                                        <tr>
                                            <th>@lang('Exam Name')</th>
                                            <th>@lang('Notice Published')</th>
                                            <th>@lang('Result Published')</th>
                                        </tr>
                                        @foreach($exams as $exam)
                                        <tr>
                                            <td>{{$exam->exam_name}}</td>
                                            <td>{{($exam->notice_published === 1)?__('Yes'):__('No')}}</td>
                                            <td>{{($exam->result_published === 1)?__('Yes'):__('No')}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    @else
                                    @lang('No Active Examination')
                                    @endif
                                </div>
                            </div>
                        </div> -->
            <!-- <div class="col-sm-4">
                            <div class="panel panel-default">
                                <div class="page-panel-title">@lang('Notices')</div>
                                <div class="panel-body pre-scrollable">
                                    @if(count($notices) > 0)
                                    <div class="list-group">
                                        @foreach($notices as $notice)
                                        <a href="{{url($notice->file_path)}}" class="list-group-item" download>
                                            <i class="badge badge-download material-icons">
                                                get_app
                                            </i>
                                            <h5 class="list-group-item-heading">{{$notice->title}}</h5>
                                            <p class="list-group-item-text">@lang('Published at'):
                                                {{$notice->created_at->format('M d Y h:i:sa')}}</p>
                                        </a>
                                        @endforeach
                                    </div>
                                    @else
                                    @lang('No New Notice')
                                    @endif
                                </div>
                            </div>
                        </div> -->
          </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4>@lang('Events')</h4>
                </div>
                <div class="card-body pre-scrollable">
                  @if(count($events) > 0)
                  <div class="list-group">
                    @foreach($events as $event)
                    <a href="{{url($event->file_path)}}" class="list-group-item" download>
                      <i class="badge badge-download material-icons">
                        get_app
                      </i>
                      <div class="media-title">{{$event->title}}</div>
                      <p class="list-group-item-text">@lang('Published at'):
                        {{$event->created_at->format('M d Y')}}
                      </p>
                    </a>
                    @endforeach
                  </div>
                  @else
                  @lang('No New Event')
                  @endif
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4>@lang('Routines')</h4>
                </div>
                <div class="card-body pre-scrollable">
                  @if(count($routines) > 0)
                  <div class="list-group">
                    @foreach($routines as $routine)
                    <a href="{{url($routine->file_path)}}" class="list-group-item" download>
                      <i class="badge badge-download material-icons">
                        get_app
                      </i>
                      <div class="media-title">{{$routine->title}}</div>
                      <p class="list-group-item-text">@lang('Published at'):
                        {{$routine->created_at->format('M d Y')}}
                      </p>
                    </a>
                    @endforeach
                  </div>
                  @else
                  @lang('No New Routine')
                  @endif
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-header">
                  <h4>@lang('Syllabus')</h4>
                </div>
                <div class="card-body pre-scrollable">
                  @if(count($syllabuses) > 0)
                  <div class="list-group">
                    @foreach($syllabuses as $syllabus)
                    <a href="{{url('img/documents/'.$syllabus->file_path)}}" class="list-group-item" download>
                      <i class="badge badge-download material-icons">
                        get_app
                      </i>
                      <div class="media-title">{{$syllabus->title}}</div>
                      <p class="list-group-item-text">@lang('Published at'):
                        {{$syllabus->created_at->format('M d Y')}}
                      </p>
                    </a>
                    @endforeach
                  </div>
                  @else
                  @lang('No New Syllabus')
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@else
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
              <form id="wizard_with_validation" method="POST" action="{{ route('applicant') }}" enctype="multipart/form-data">
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
                             <option value="U">UTME</option>
                            <option value="D">Direct Entry</option>
                            <option value="T">Transfer</option>
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
                          <option value="WAEC">WAEC</option>
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
                  <label for="acceptTerms-2" style="margin-left: 5px;"> I agree with the Terms and Conditions.</label>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endif
@endsection