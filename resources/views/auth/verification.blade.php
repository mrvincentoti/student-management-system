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
    .navbar-light .navbar-nav .active>.nav-link,
    .navbar-light .navbar-nav .nav-link.active,
    .navbar-light .navbar-nav .nav-link.show,
    .navbar-light .navbar-nav .show>.nav-link {
        color: #ffffff !important;
        ;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #ffffff !important;
        ;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        background-color: #ffffff !important;
        ;
        color: #011c38 !important;
        ;
    }
</style>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            @include('layouts.nav')

            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                            <div class="login-brand">
                                <div class="text-center">
                                    <img class="mb-2" src="{{ asset('img/logo.jpg')}}" style="width: 100px;" />
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>Create Account</h4>
                                        </div>
                                        @if($errors->any())
                                        <div class="col-lg-12 alert alert-danger text-center">
                                            {{ $errors->first() }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('student-verification-post') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-key"></i>
                                                    </div>
                                                </div>
                                                <input id="regnumb" type="text" class="form-control" name="regnumb" autofocus placeholder="Registration Number, JAMB NO or Matric Number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input id="sname" type="text" class="form-control" name="sname" autofocus placeholder="Surname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input id="fname" type="text" class="form-control" name="fname" autofocus placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-lg btn-round btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-5 text-muted text-center">
                                Already created an account? <a href="{{ url('/') }}">Login</a>
                            </div>

                            <div class="simple-footer">
                                Copyright ©<script>
                                    document.write(new Date().getFullYear());
                                </script>
                                Federal University Of Health Sciences, Otukpo. All Rights Reserved. <a href="http://www.tenece.com" target="_blank"><img id="Image1" src="{{asset('img/tenece.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- <div class="card-footer">
            <div class="col-lg-12">
                <footer class="footer" style="background-color: #ccc;">
                    <div class="container">
                        <div class="font-size-sm text-center text-muted py 1">        
                            <p>
                                Copyright ©<script> document.write(new Date().getFullYear()); </script>
                                Federal University Of Health Sciences, Otukpo. All Rights Reserved. <a href="http://www.tenece.com" target="_blank"><img id="Image1" src="{{asset('img/tenece.png')}}"></a>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div> -->
    </div>


</div>
@endsection