@extends('layouts.login')

@section('title', __('Login'))

@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>@lang('Login')</h4>
              </div>
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
                    <label for="email">@lang('E-Mail Or Phone Number')</label>
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
            {{--
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div>
            --}}
            
          </div>
        </div>
      </div>
    </section>
@endsection