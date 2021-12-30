@extends('layouts.landing')

@section('title', __('Course'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div> -->
        <div class="col-md-12" id="main-container">
            <h2>@lang('Courses Taken by Teacher')</h2>
            <div class="card">
              @if(count($courses) > 0)
              @foreach ($courses as $course)
                <div class="card-header" style="font-size: 20px;"><b>@lang('Teacher Code')</b> - {{$course->teacher->student_code}} &nbsp;<b>@lang('Name')</b> - <a href="{{url('user/'.$course->teacher->student_code)}}">{{$course->teacher->name}}</a></div>
                 @break($loop->first)
              @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>false])
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
