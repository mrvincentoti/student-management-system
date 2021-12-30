@extends('layouts.app')

@section('title', __('Promote Section Students'))

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" id="main-container">
      <h2>@lang('Promote Students of')</h2>
      <div class="card">
        @if(count($students) > 0)
        @foreach ($students as $student)
        <div class="card-header">
          <b>@lang('Semester')</b> - {{ $student->section->section_number}} &nbsp; <b>@lang('Course')</b> - {{$student->section->class->class_number}}
          <span class="pull-right"><b>&nbsp;@lang(' Current Date Time'):</b> &nbsp;{{ Carbon\Carbon::now()->format('h:i A d/m/Y')}}</span>
        </div>
        @break($loop->first)
        @endforeach
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
          @component('components.promote-students',['students'=>$students,'classes'=>$classes,'section_id'=>$section_id])
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