<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ (Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'teacher'
        || Auth::user()->role == 'admin' || Auth::user()->role == 'accountant' || Auth::user()->role ==
        'librarian'))?Auth::user()->school->name:config('app.name') }}</title>

    <link rel="stylesheet" href="{{ url('css/loader.css') }}">

    <script src="{{ url('js/jquery-2.1.3.min.js') }}"></script>

    <script src="{{ url('js/vendors.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ url('js/application.js') }}"></script>
    @yield('after_scripts')
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
            </div>
        </div>
    </div>

    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons&style=normal&weight=400"
      rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/vendors.css') }}" id="bootswatch-print-id">
    <link rel="stylesheet" href="{{ url('css/application.css') }}"> -->

    <!-- General JS Scripts -->
    <script src="{{asset('admin/js/app.min.js')}}"></script>
    <!-- JS Libraies -->
    <script src="{{asset('admin/bundles/cleave-js/dist/cleave.min.js')}}"></script>
    <script src="{{asset('admin/bundles/cleave-js/dist/addons/cleave-phone.us.js')}}"></script>
    <script src="{{asset('admin/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('admin/bundles/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
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

</html>