<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIS - FUHSO</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin/css/app.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bundles/bootstrap-social/bootstrap-social.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link rel="stylesheet" href="{{asset('admin/bundles/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bundles/jquery-selectric/selectric.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
  <!-- <div class="loader"></div> -->
  <div id="app">
    @yield('content')
  </div>
  <!-- Modal with form -->
  <div class="modal fade" id="declineCourseModal" tabindex="-1" role="dialog" aria-labelledby="declineModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="declineModal">Decline Course Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" action="{{ url('student/send-course-email') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" placeholder="Title" name="title">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Email" id="demail" name="demail" readonly>
            </div>
            <div class="form-group">
              <label>Reason</label>
              <textarea rows="20" class="form-control" placeholder="Reason for decline" id="reason" name="reason"></textarea>
            </div>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('admin/js/jquery.js')}}"></script>
  <!-- General JS Scripts -->
  <script src="{{asset('admin/js/app.min.js')}}"></script>
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{asset('admin/js/scripts.js')}}"></script>
  <!-- Custom JS File -->

  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
  <script src="{{asset('admin/js/custom.js')}}"></script>



  <script src="{{asset('admin/bundles/jquery-validation/dist/jquery.validate.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('admin/bundles/jquery-steps/jquery.steps.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/js/page/form-wizard.js')}}"></script>



</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>