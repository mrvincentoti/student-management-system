@extends('layouts.landing')

@section('title', __('Attendance'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            @if(count($attendances) > 0)
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes') &amp; @lang('Sections')</a></li>
                <li><a href="{{url()->previous()}}" style="color:#3b80ef;">@lang('List of Students')</a></li>
                <li class="active">@lang('View Attendance')</li>
            </ol>
            @endif
            <h2>@lang('Adjust Attendance of Student') - {{$attendances[0]->student->name}}</h2>
            @endif
            <div class="card card-primary">
                @if(count($attendances) > 0)
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @component('components.adjust-attendance',['attendances'=>$attendances,'student_id'=>$student_id])

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