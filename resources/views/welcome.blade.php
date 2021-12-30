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

            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="text-center">
                            <img class="mb-2" src="{{ asset('img/logo.jpg')}}" style="width: 100px;"/>
                            <h4>@lang('Sign Into Your Account')</h4>
                        </div>
                        <div class="card card-primary">
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-small">{{ $error }}</p>
                                        <br/>
                                    @endforeach
                                </div>
                            @endif
                            <div class="card-body">
                                <form method="POST" class="needs-validation" novalidate="" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="email">@lang('Email')</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus
                                    value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                    <label for="password" class="control-label">@lang('Password')</label>
                                    <div class="float-right">
                                        <a href="{{ route('password.request') }}" class="text-small">
                                        @lang('Forgot Your Password?')
                                        </a>
                                    </div>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                {{--  
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    --}}
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    @lang('Login')
                                    </button>
                                </div>
                                </form>
                                {{--
                                    <div class="text-center mt-4 mb-3">
                                    <div class="text-job text-muted">Login With Social</div>
                                    </div>
                                    <div class="row sm-gutters">
                                    <div class="col-6">
                                        <a class="btn btn-block btn-social btn-facebook">
                                        <span class="fab fa-facebook"></span> Facebook
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-block btn-social btn-twitter">
                                        <span class="fab fa-twitter"></span> Twitter
                                        </a>
                                    </div>
                                    </div>
                                --}}
                    
                            </div>
                        </div>
                     
                        <div class="mt-5 text-muted text-center">
                        Any issues? Send <a href="">Send us an email</a> or call our support on 02090876567 
                        </div>
                     
                        
                    </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-footer">
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
        </div>
    </div>
     
                    
</div>
@endsection