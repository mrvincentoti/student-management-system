<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>
    @yield('title') - {{ (Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'teacher'
        || Auth::user()->role == 'admin' || Auth::user()->role == 'accountant' || Auth::user()->role ==
        'librarian'))?Auth::user()->school->name:config('app.name') }}
  </title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin/css/app.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bundles/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bundles/jquery-selectric/selectric.css')}}">
  <link href="{{asset('admin/bundles/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('admin/bundles/bootstrap-social/bootstrap-social.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{asset('/img/favicon.ico')}}" />


</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('layouts.main-nav')
      @include('layouts.main-sidebar')
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            @yield('content')
          </div>
        </section>


        <!-- Modal add school-->
        @include('schools.form')
      </div>
    </div>
  </div>

  <!-- Modal with form -->
  <div class="modal fade" id="declineCourseModal" tabindex="-1" role="dialog" aria-labelledby="declineCourseModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="declineCourseModalTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="">
            <div class="form-group">
              <label>Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                  </div>
                </div>
                <input type="text" class="form-control" placeholder="Email" name="email">
              </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
            </div>
            <div class="form-group mb-0">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                <label class="custom-control-label" for="remember-me">Remember Me</label>
              </div>
            </div>
            <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal with form -->
  <div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">Reasons for decline</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('decline') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Title</label>
              <div class="input-group">
                <input type="text" class="form-control" name="title" required>
                @if(isset($user))
                <input type="hidden" class="form-control" name="uuid" value="{{$user->id}}">
                @endif
              </div>
            </div>
            <div class="form-group">
              <label>Message</label>
              <div class="input-group">
                <textarea class="form-control" name="message" required></textarea>
              </div>
            </div>

            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end Modal with form -->

  @if(isset($faculty))
  <!-- Add department Modal -->
  <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="departmentModalLabel">@lang('Create Department')</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('school/add-department')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label>Choose Faculty</label>
              <select class="form-control" name="faculty_id">
                @foreach($faculty as $fac)
                @if(isset($fac->id))
                <option value="{{ $fac->id }}">{{ $fac->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>@lang('Department Name')</label>
              <input type="text" class="form-control" id="department_name" name="department_name" placeholder="@lang('English, Mathematics,...')">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- end Add department Modal -->

  @if(isset($school))
  @if(isset($departments))
  <!-- add classModal -->
  <div class="modal fade" id="addClassModal{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="addClassModal{{$school->id}}Label">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">@lang('Add New Course')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('school/add-class')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label>Choose Department</label>
              <select class="form-control" name="department_id" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Course Name</label>
              <input type="text" name="class_number" class="form-control" id="classNumber{{$school->id}}" placeholder="@lang('Course name')" required>
            </div>
            <div class="form-group">
              <label>Course Duration</label>
              <select class="form-control" name="duration" required>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
            {{--<div class="form-group">
                <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">@lang('Class Room Number')</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="classRoomNumber{{$school->id}}" placeholder="@lang('Class Room Number')">
            </div>
        </div>
        --}}
        {{-- <div class="form-group">
                <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">@lang('Class Group (If Any)')</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="group" id="classRoomNumber{{$school->id}}" placeholder="@lang('Science, Commerce, Arts, etc.')">
          <span id="helpBlock" class="help-block">@lang('Leave Empty if this Class belongs to no Group')</span>
        </div>
      </div> --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
        </div>
      </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
    </div>
  </div>
  </div>
  </div>
  @endif
  @endif
  <!--/end add class-->
  @if(!empty(session('departments'))){
  <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel">
    <style>
      .select2 {
        width: 100% !important;
      }
    </style>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">@lang('Add User')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('users/add-custom-user')}}" method="post">
            {{csrf_field()}}
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Firstname</label>
                <input type="text" class="form-control" id="fname" placeholder="Firstname" name="firstname">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Surname</label>
                <input type="text" class="form-control" id="surname" placeholder="Surname" name="surname">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Phone</label>
                <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Role</label>
                <select class="form-control select2" multiple="" name="permission[]">
                  <option value="teacher">Teacher</option>
                  <option value="admission">Admission Officer</option>
                  <option value="levelcordinator">Level Coordinator</option>
                  <option value="hod">Head Of Department</option>
                  <option value="librarian">Librarian</option>
                  <option value="accountant">Accountant</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Choose Department</label>
              <select class="form-control" name="department_id" required>
                <option value="">Select Department</option>
                @if (count(session('departments')) > 0)
                @foreach (session('departments') as $d)
                <option value="{{$d->id}}">{{$d->department_name}}</option>
                @endforeach
                @endif
              </select>
            </div>
            <div class="form-group">
              <label>Class Teacher?</label>
              <select class="form-control" name="class_teacher_section_id" required>
                <option selected="selected" value="0">@lang('Not Class Teacher')</option>
                @foreach (session('register_sections') as $section)
                <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                  {{$section->class->class_number}}
                </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- Modal with form -->
  <div class="modal fade" id="hostelModal" tabindex="-1" role="dialog" aria-labelledby="hostelModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hostelModal">Add Hostel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post" action="{{url('hostel/create')}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Hostel Name</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Location" name="hostel_name">
              </div>
            </div>
            <div class="form-group">
              <label>Location</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Location" name="location">
              </div>
            </div>
            <div class="form-group">
              <label>Number Of Rooms</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Number Of Rooms" name="number_of_rooms">
              </div>
            </div>
            <div class="form-group">
              <label>Room Type</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Room Type" name="room_type">
              </div>
            </div>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('admin/js/jquery.js')}}"></script>
  <script src="{{asset('admin/js/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('admin/bundles/cleave-js/dist/cleave.min.js')}}"></script>
  <script src="{{asset('admin/bundles/cleave-js/dist/addons/cleave-phone.us.js')}}"></script>
  <script src="{{asset('admin/bundles/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('admin/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/js/page/datatables.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{asset('admin/bundles/lightgallery/dist/js/lightgallery-all.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/js/page/light-gallery.js')}}"></script>
  <script src="{{asset('admin/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{asset('admin/bundles/jquery-validation/dist/jquery.validate.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('admin/bundles/jquery-steps/jquery.steps.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/js/page/form-wizard.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

  <script src="{{asset('admin/bundles/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{asset('admin/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/js/page/forms-advanced-forms.js')}}"></script>

  <script src="{{asset('admin/js/custom.js')}}"></script>

  <!-- <script>
    $(function() {
      $('.datepicker').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
      });
    })
  </script> -->

</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>