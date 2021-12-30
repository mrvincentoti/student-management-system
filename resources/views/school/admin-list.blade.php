@extends('layouts.landing')

@section('title', __('Admins'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- <div class="col-md-2" id="side-navbar">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schools.index') }}"><i class="material-icons">gamepad</i> @lang('Manage School')</a>
                </li>
            </ul>
        </div> -->
        <div class="col-md-12" id="main-container">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Admins</h4>
                    <div class="card-header-action">
                      <a href="{{ route('schools.index') }}" class="btn btn-primary">
                        @lang('Manage School')
                      </a>
                    </div>
                </div>
                @if(count($admins) > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th>@lang('Action')</th>
                                <th>@lang('Action')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Code')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Phone Number')</th>
                                <!-- <th>@lang('Address')</th>
                                <th>@lang('About')</th> -->
                            </tr>
                            @foreach ($admins as $admin)
                            <tr>
                                <td>
                                    @if($admin->active == 0)
                                    <a href="{{url('master/activate-admin/'.$admin->id)}}" class="btn btn-xs btn-success"
                                        role="button"><i class="material-icons">
                                            done
                                        </i>@lang('Activate')</a>
                                    @else
                                    <a href="{{url('master/deactivate-admin/'.$admin->id)}}" class="btn btn-xs btn-danger"
                                        role="button"><i class="material-icons">
                                            clear
                                        </i>@lang('Deactivate')</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('edit/user/'.$admin->id)}}" class="btn btn-xs btn-info"
                                        role="button"><i class="material-icons">
                                            edit
                                        </i> @lang('Edit')</a>
                                </td>
                                <td>
                                    {{$admin->name}}
                                </td>
                                <td>{{$admin->student_code}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->phone_number}}</td>
                                <!-- <td>{{$admin->address}}</td> -->
                                <!-- <td>{{$admin->about}}</td> -->
                            </tr>
                            @endforeach
                        </table>
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
