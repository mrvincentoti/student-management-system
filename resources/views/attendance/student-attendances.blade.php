@extends('layouts.landing')

@section('title', __('Attendance'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            @if(count($attendances) > 0)
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb">
                <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes') &amp; @lang('Sections')</a></li>
                <li><a href="{{url()->previous()}}" style="color:#3b80ef;">@lang('List of Students')</a></li>
                <li class="active">@lang('View Attendance')</li>
            </ol>
            @endif
            <h4>@lang('Attendance of Student') - {{$attendances[0]->student->name}}</h4>
            @endif
            <div class="card card-primary">
                @if(count($attendances) > 0)
                <div class="card-body">
                    <div class="row">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if(count($attendances) > 0)
                        <div class="col-md-4">
                            <h5>@lang('Attendance List of This Term')</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Date')</th>
                                </tr>
                                @foreach ($attendances as $attendance)
                                {{-- @if($loop->index >= 30)
                                        @break;
                                    @endif --}}
                                @if($attendance->present == 1)
                                <tr class="badge-success">
                                    <td>@lang('Present')</td>
                                    <td>{{$attendance->created_at->format('M d Y h:i:sa')}}</td>
                                </tr>
                                @elseif($attendance->present == 2)
                                <tr class="badge-warning">
                                    <td>@lang('Escaped')</td>
                                    <td>{{$attendance->created_at->format('M d Y h:i:sa')}}</td>
                                </tr>
                                @else
                                <tr class="badge-danger">
                                    <td>@lang('Absent')</td>
                                    <td>{{$attendance->created_at->format('M d Y h:i:sa')}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                        @endif

                        @include('layouts.student.attendances-table')
                    </div>
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