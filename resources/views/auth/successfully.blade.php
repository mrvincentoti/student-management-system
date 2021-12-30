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
              <div class="alert alert-success alert-dismissible show fade alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  <h3>Your submission has been sent.<br>
                  You will receive an email once your submission is approved.</h3>
                </div>
              </div>
            </div>
            <div class="col-lg-6 offset-lg-3 text-center">
              <div class="img">
                  <img src="{{asset('img/success.png')}}"/>
              </div>
              <div class="message">
                  <div class="display-4">Thank You</div>
              </div>
            </div>
          </div>
        </div>
      </section>   
    </div>        
</div>
@endsection