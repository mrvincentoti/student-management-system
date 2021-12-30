@extends('layouts.landing')

@section('title', __('Edit School'))

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">@lang('Edit') {{$school->name}}</h2>

                <form class="form-horizontal" action="{{ route('schools.update', $school) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">@lang('School Name')</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $school->name }}" placeholder="@lang('School Name')" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                        <label for="about" class="col-md-4 control-label">@lang('About School')</label>

                        <div class="col-md-12">
                            <textarea id="about" type="text" class="form-control" name="about"
                                placeholder="@lang('About School')" required>{{ $school->about }}</textarea>

                            @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <a href="{{ route('schools.index') }}" class="btn btn-primary">@lang('Back')</a>
                            <button type="submit" class="btn btn-danger">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
