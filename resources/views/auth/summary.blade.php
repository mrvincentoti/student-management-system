@extends('layouts.login')

@section('title', __('Login'))

@section('content')
<div class="container" style="margin-top: 20px;">

    <!-- <div class="col-lg-12 text-center" id="display-error">
        <div class="alert alert-success">
            <div class="alert-title">Success</div>
            Your registration has been submitted and will be processed.<br>
            Please, check your email for login details to the portal.<br>
            Thank you.
        </div>
    </div> -->

</div>
<div class="container" id="GFG">
 <section class="section">
    <div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12 text-center" id="display-error" style="display: none;">
                    <div class="alert alert-danger">
                      <div class="alert-title">Error</div>
                      Your transaction was not successful, please check your connection and try again. Thank you.
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h4>FUHSO</h4>
                        <div class="invoice-number">Matric Number {{ $applicant->student_code }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('img/logo.jpg') }}" style="width: 100px;"/>
                        </div>
                        <div class="col-md-6 text-center">
                            <h4>Federal University Of Health Sciences, Otukpo</h4>
                            <p>Akwete-Akpa,Otukpo LGA, Benue State <br/> info@fuhso.edu.ng</p>
                        </div>
                        <div class="col-md-3 text-md-right">
                            <img src="{{ asset('img/documents/'.$applicant->pic_path) }}" style="width: 100px;"/>
                        </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Billed To:</strong><br>
                          {{ $applicant->name }}<br>
                          {{ $applicant->address}}<br>
                         
                        </address>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Payment details:</strong><br>
                          <b>Transaction date:</b> {{date("Y/m/d")}}<br>
                          <b>Fee:</b> Registration<br>
                          
                        </address>
                      </div>
                    </div> -->
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <!-- <p class="section-lead">All items here cannot be deleted.</p> -->
                     <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">Personal Details</div>
                            <p class="clearfix">
                                <span class="float-left">
                                    Jamb Registration Number
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->jambregno}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Fullname
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->name}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Phone
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->phone_number}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Email
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->email}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Address
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->address}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Date Of Birth
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->dob}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <hr/>
                                <div class="section-title">Academic Details</div>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Faculty
                                </span>
                                <span class="float-right text-muted">
                                    {{$faculty->name}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Department
                                </span>
                                <span class="float-right text-muted">
                                    {{$department->department_name}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Course applied for
                                </span>
                                <span class="float-right text-muted">
                                    {{$course->class_number}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <div class="section-title">O’Level</div>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    O’Level obtained
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->qualification}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Institution
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->qualification_institution}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Exam Date
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->qualification_date}}
                                </span>
                            </p>
                            @if($applicant->sitting == 2)
                                <p class="clearfix">
                                    <small><b>Second sitting</b></small>
                                </p>
                                <p class="clearfix">
                                <span class="float-left">
                                    O’Level obtained
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->qualification_2}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Institution
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->qualification_institution_2}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Exam Date
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->qualification_date_2}}
                                </span>
                            </p>
                            @endif
                            <p class="clearfix">
                                <hr/>
                                <div class="section-title">Sponsor Details</div>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Name
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->sponsor_name}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Phone
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->sponsor_phone}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Email
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->sponsor_email}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Sponsor Address
                                </span>
                                <span class="float-right text-muted">
                                    {{$applicant->sponsor_address}}
                                </span>
                            </p>
                        </div>
                     </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 text-center">
                        <p>For assistance please call: <strong>234 (0) 903 1109 071</strong> or Mail: <strong>info@fuhso.edu.ng</strong></p>
                        <!-- <div class="images">
                            <img src="assets/img/cards/visa.png" alt="visa">
                            <img src="assets/img/cards/jcb.png" alt="jcb">
                            <img src="assets/img/cards/mastercard.png" alt="mastercard">
                            <img src="assets/img/cards/paypal.png" alt="paypal">
                        </div> -->
                        </div>
                        <div class="col-lg-4 text-right">
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                <script>
            
                </script>
            </div>
            <!-- <div class="float-lg-right mb-lg-0 mb-3">
                <button class="btn btn-success btn-icon icon-left"><i class="fas fa-credit-card"></i>Pay Online (eTranzact)</button>
            </div> -->
        </div>
        <hr>
        <div class="text-md-right mb-3">
            <div class="float-lg-left mb-lg-0 mb-3">
                <button class="btn btn-danger btn-icon icon-left mb-3" onclick="PrintDiv();"><i class="fas fa-print"></i>Print Slip</button>
            </div>
            <a href="{{ url('/home')}}">
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-arrow-left"></i> Back</button>
            </a>
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
            background-color:red !important;
        }        
    }
</style>
<script>
        function PrintDiv() {
            
            window.print();
        }
    </script>
@endsection