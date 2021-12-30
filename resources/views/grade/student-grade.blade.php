@extends('layouts.landing')

@section('title', __('Grade'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                <li><a href="{{url()->previous()}}" style="color:#3b80ef;">@lang('Section Students')</a></li>
                <li class="active">@lang('History')</li>
            </ol>
            @endif
            <h4>@lang('Marks and Grades History')</h4>
            <div class="card card-primary">
                @if(count($grades) > 0)
                @foreach ($grades as $grade)
                <?php
                $studentName = $grade->student->name;
                $classNumber = $grade->student->section->class->class_number;
                $sectionNumber = $grade->student->section->section_number;
                ?>
                <div class="card-header"><b>@lang('Student Code')</b> - {{$grade->student->student_code}} &nbsp;<b>@lang('Name')</b> - {{$grade->student->name}} &nbsp;<b>@lang('Class')</b> - {{$grade->student->section->class->class_number}} &nbsp;<b>@lang('Section')</b> - {{$grade->student->section->section_number}}</div>
                @break($loop->first)
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @include('layouts.student.grade-table')
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