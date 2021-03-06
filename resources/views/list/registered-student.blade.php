@extends('layouts.landing')

@section('title', __('Students'))

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12" id="main-container">
            <div class="card">
                <div class="card-body">
                    @if(count($users) > 0)
                    @foreach ($users as $user)
                    @if (Session::has('section-attendance'))
                    <ol class="breadcrumb" style="margin-top: 3%;">
                        <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes &amp; Sections')</a></li>
                        <li class="active">{{ucfirst($user->role)}}s</li>
                    </ol>
                    @endif
                    <div class="card-heading">
                        <h4>@lang('List of all') {{ucfirst($user->role)}}s</h4>
                    </div>
                    @break($loop->first)
                    @endforeach
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-12">
                                <form class="form-inline" action="/exported" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <select class="form-control" id="department" name="department">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->class_number }}</option>
                                        @endforeach
                                    </select>

                                    <div class="input-group mb-2 mr-sm-2">
                                        <button style="height: 40px; margin-top:7px; margin-left: 2px;" type="submit" class="btn btn-icon btn-primary"><i class="fa fa-download"></i> Export to Excel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                        <hr />
                        @component('components.users-list',['users'=>$users,'current_page'=>$current_page,'per_page'=>$per_page])
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
</div>
@endsection