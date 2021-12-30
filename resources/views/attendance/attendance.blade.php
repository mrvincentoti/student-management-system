@extends('layouts.landing')

@section('title', __('Attendance'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('All Classes') &amp; @lang('Sections')</a></li>
                <li class="active">@lang(' Attendance')</li>
            </ol>
            <h4>@lang('Take Attendance')</h4>
            <div class="card card-primary">
                @if(count($students) > 0)
                @foreach ($students as $student)
                <div class="card-header">
                    <b>Semester</b> - {{ $student->section->section_number}} &nbsp; <b>Course</b> - {{$student->section->class->class_number}}
                    <span class="pull-right"><b>@lang('Current Date Time'):</b> &nbsp;{{ Carbon\Carbon::now()->format('h:i A d/m/Y')}}</span>
                </div>
                @break($loop->first)
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @include('layouts.teacher.attendance-form')
                </div>
                @else
                <div class="card-body">
                    @lang('No Related Data Found.')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection