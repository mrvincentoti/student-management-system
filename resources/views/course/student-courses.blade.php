@extends('layouts.login')

@section('title', __('Login'))

@section('content')
<style>
    .title {
        font-weight: bold;
        text-transform: uppercase;
    }

    .table:not(.table-sm):not(.table-md):not(.dataTable) td,
    .table:not(.table-sm):not(.table-md):not(.dataTable) th {
        padding: 0 10px;
        height: 30px !important;
        vertical-align: middle;
    }
</style>
<div class="container" id="GFG" style="width: 910px;">
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5 style="color: #000000;">
                                FEDERAL UNIVERSITY OF HEALTH SCIENCES, OTUKPO, BENUE STATE, NIGERIA <br />
                                OFFICE OF THE REGISTRAR.
                            </h5>
                            <p>(Academic Affairs Division)</p>
                            <img src="{{ asset('img/logo.jpg') }}" style="width: 100px;" />
                            <p>COURSE REGISTRATION FORM</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="row">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                        <tr class="page_speed_1586287953">
                                            <td class="title">Matric Number:</td>
                                            <td class="value">{{$user->student_code}}</td>
                                            <td class="title">Session:</td>
                                            <td class="value">{{$user->session}}</td>
                                        </tr>
                                        <tr class="page_speed_1586287953">
                                            <td class="title">Surname:</td>
                                            <td class="value">{{$user->surname}}</td>
                                            <td class="title">Firstname:</td>
                                            <td class="value">{{$user->firstname}}</td>
                                        </tr>

                                        <tr class="page_speed_1586287953">
                                            <td class="title">Middlename:</td>
                                            <td class="value" colspan="3">{{$user->othername}}</td>
                                        </tr>
                                        <tr class="page_speed_1586287953">
                                            <td class="title">College/Faculty/School:</td>
                                            <td class="value">{{$user->faculty}}</td>
                                            <td class="title">Department:</td>
                                            <td class="value">{{$user->department}}</td>
                                        </tr>
                                        <tr class="page_speed_1586287953">
                                            <td class="title">Course of study:</td>
                                            <td class="value">{{$user->course}}</td>
                                            <td class="title">Level:</td>
                                            <td class="value">{{$user->level}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th colspan="5">FIRST SEMESTER</th>
                                            </tr>
                                            <tr>
                                                <td>COURSE CODE</td>
                                                <td>COURSE TITLE</td>
                                                <td>CREDIT UNITS</td>
                                                <td>COURSE TYPE</td>
                                                <td>LECTURER</td>
                                            </tr>
                                            @foreach($firstsemesters as $firstsemester)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$firstsemester->course_name}}</td>
                                                <td>{{$firstsemester->credit_unit}}</td>
                                                <td>{{ucfirst($firstsemester->course_type)}}</td>
                                                <td>
                                                    {{$firstsemester->lecturer}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr style="font-weight: bold;">
                                                <td colspan="2">
                                                    TOTAL CREDIT UNIT
                                                </td>
                                                <td colspan="3">
                                                    {{$creditunitfs}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th colspan="5">SECOND SEMESTER</th>
                                            </tr>
                                            <tr>
                                                <td>COURSE CODE</td>
                                                <td>COURSE TITLE</td>
                                                <td>CREDIT UNITS</td>
                                                <td>COURSE TYPE</td>
                                                <td>LECTURER</td>
                                            </tr>
                                            @foreach($secondsemesters as $secondsemester)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$secondsemester->course_name}}</td>
                                                <td>{{$secondsemester->credit_unit}}</td>
                                                <td>{{ ucfirst($secondsemester->course_type)}}</td>
                                                <td>
                                                    {{$secondsemester->lecturer}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr style="font-weight: bold;">
                                                <td colspan="2">
                                                    TOTAL CREDIT UNIT
                                                </td>
                                                <td colspan="3">
                                                    {{$creditunitss}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @if(App\Http\Controllers\StudentcourseController::doesStudentHaveCourse(\Auth::user()->id,\Auth::user()->level) > 0
                                && App\Http\Controllers\StudentcourseController::isRegistrationApproved($user->id,$user->level) <= 0) <div class="col-12 col-md-12 col-lg-12 text-center">
                                    <h6>Approved By: {{App\Http\Controllers\StudentcourseController::approvingOfficer($user->id,$user->level)}}, <span>Approval Date: {{App\Http\Controllers\StudentcourseController::approvingDate($user->id,$user->level)}}</span></h6>
                            </div>
                            @endif
                            <input type="hidden" id="user_id" value="{{ $user->id }}" />
                            <input type="hidden" id="user_email" value="{{ $user->email }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                    <script>

                    </script>
                </div>
            </div>
            <hr>
            <div class="text-md-right mb-3">
                @if(\Auth::user()->role == "student")
                <div class="float-lg-left mb-lg-0 mb-3">
                    @if(App\Http\Controllers\StudentcourseController::doesStudentHaveCourse(\Auth::user()->id,\Auth::user()->level) > 0 && App\Http\Controllers\StudentcourseController::isRegistrationApproved($user->id,$user->level) <= 0) <button class="btn btn-danger btn-icon icon-left mb-3" onclick="PrintDiv();">
                        <i class="fas fa-print"></i>Print Slip
                        </button>
                        @else
                        <p>Your course registration is not yet approved</p>
                        @endif
                </div>
                <a href="{{ url('/home')}}">
                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-arrow-left"></i> Back</button>
                </a>
                @endif

                @if(Auth::user()->role == 'custom')
                @if(in_array('hod', explode(",",Auth::user()->permission)) || in_array('levelcordinator', explode(",",Auth::user()->permission)))
                <div class="float-lg-left mb-lg-0 mb-3">
                    <button class="btn btn-danger btn-icon icon-left mb-3 decline"><i class="fas fa-print"></i>Decline</button> |
                </div>
                <div class="float-lg-left mb-lg-0 mb-3">
                    <form method="post" action="{{ url('student/send-course-email') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
                        <input type="hidden" name="demail" value="{{ $user->email }}" />
                        @foreach($firstsemesters as $firstsemester)
                        <input type="hidden" name="courseid[]" value="{{ $firstsemester->sid }}" />
                        @endforeach
                        @foreach($secondsemesters as $secondsemester)
                        <input type="hidden" name="courseid[]" value="{{ $secondsemester->sid }}" />
                        @endforeach
                        <button type="submit" class="btn btn-success btn-icon icon-left mb-3"><i class="fas fa-print"></i>Approve</button>
                    </form>
                </div>
                <a href="{{ url('students/courses')}}">
                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-arrow-left"></i> Back</button>
                </a>
                @endif
                @endif
            </div>
        </div>
</div>
</section>
</div>

<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact;
        }

        #txtName {
            background-color: red !important;
        }
    }
</style>
<script>
    function PrintDiv() {

        window.print();
    }
</script>
@endsection