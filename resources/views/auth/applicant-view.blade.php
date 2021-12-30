@extends('layouts.landing')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="buttons">
                    <!-- <a href="{{url('decline/acceptance/'.$user->id)}}" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i>Decline</a> -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal">Decline</button>
                    @if($user->active != 1)
                    <a href="{{url('approve/acceptance/'.$user->id)}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>Accept</a>
                    @endif
                    @if($user->active == 1 && $user->student_code == NULL)
                    <a href="{{url('generate-matric-number/'.$user->id)}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>Generate Matric Number</a>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="py-4">
                            <p class="clearfix">
                                <span class="float-left">
                                    Status
                                </span>
                                <span class="float-right text-muted">
                                    @if($user->active == 1)
                                    <span class="badge badge-success">Accepted</span>
                                    @endif
                                    @if($user->active == 0)
                                    <span class="badge badge-warning">Pending</span>
                                    @endif
                                    @if($user->active == 3)
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Submission Date
                                </span>
                                <span class="float-right text-muted">
                                    {{date('d M, Y H:i A', strtotime($user->created_at))}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Jamb Registration Number
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->jambregno}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Fullname
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->name}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Phone
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->phone_number}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Email
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->email}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Address
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->address}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Date Of Birth
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->dob}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <hr />
                                Academic Details
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Faculty
                                </span>
                                <span class="float-right text-muted">
                                    {{$faculty->name}}
                                </span>
                            </p>
                            @if(isset($department))
                            <p class="clearfix">
                                <span class="float-left">
                                    Department
                                </span>
                                <span class="float-right text-muted">
                                    {{$department->department_name}}
                                </span>
                            </p>
                            @endif
                            @if(isset($course))
                            <p class="clearfix">
                                <span class="float-left">
                                    Course applied for
                                </span>
                                <span class="float-right text-muted">
                                    {{$course->class_number}}
                                </span>
                            </p>
                            @endif
                            <p class="clearfix">
                                <hr />
                                Sponsor Details
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Name
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->sponsor_name}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Phone
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->sponsor_phone}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Email
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->sponsor_email}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Address
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->sponsor_address}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Photo</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('img/documents/'.$user->pic_path) }}" style="width: 150px;" />
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Documents</h4>
                    </div>
                    <div class="card-body">
                         <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            @if($user->proof_file != "")
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <small>Acceptance Charges</small>
                                <a href="{{ asset('img/documents/'.$user->proof_file) }}" data-sub-html="Demo Description">
                                    <img class="img-responsive thumbnail" src="{{ asset('img/documents/'.$user->proof_file) }}" alt="">
                                </a>
                            </div>
                            @endif

                            @if($user->consent_file != "")
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <small>Parent Consent</small>
                                <a href="{{ asset('img/documents/'.$user->consent_file) }}" data-sub-html="Demo Description">
                                    <img class="img-responsive thumbnail" src="{{ asset('img/documents/'.$user->consent_file) }}" alt="">
                                </a>
                            </div>
                            @endif

                            @if($user->registration_proof != "")
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <small>School Charges</small>
                                <a href="{{ asset('img/documents/'.$user->registration_proof) }}" data-sub-html="Demo Description">
                                    <img class="img-responsive thumbnail" src="{{ asset('img/documents/'.$user->registration_proof) }}" alt="">
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>View <a href="{{ asset('img/documents/'.$user->proof_file) }}" target="_blank">Acceptance Payment</a>.</p>
                        <p>View <a href="{{ asset('img/documents/'.$user->registration_proof) }}" target="_blank">Other charges</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection