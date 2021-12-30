@extends('layouts.landing')

@section('title', __('Course'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">@lang('All Classes') &amp; @lang('Sections')</a></li>
                <li class="active">@lang('Courses')</li>
            </ol>
            @endif
            <h2>@lang('Courses Related to Section')</h2>
            <div class="card">
                @if(count($courses) > 0)
                @foreach ($courses as $course)
                <div class="card-header">
                    <b>@lang('Section')</b> - {{$course->section->section_number}} &nbsp;<b>@lang('Class')</b> - {{$course->section->class->class_number}}
                </div>
                @break($loop->first)
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>(Auth::user()->role == 'student')?true:false])
                    @endcomponent
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