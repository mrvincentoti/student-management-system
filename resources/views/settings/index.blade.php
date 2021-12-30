@extends('layouts.landing')

@section('title', __('Academic Settings'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Academic Settings')</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: inherit !important;">@lang('Name')</th>
                                <th scope="col" style="background-color: inherit !important;">@lang('Code')</th>
                            </tr>
                            <tr>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->code }}</td>
                            </tr>
                            <tr>
                                <th scope="col" style="background-color: inherit !important;">@lang('Department')</th>
                                <th scope="col" style="background-color: inherit !important;">@lang('Classes')</th>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#departmentModal">+ @lang('Create Department')</button>
                                </td>
                                <td>
                                    <a href="#collapse" role="button" class="btn btn-danger btn-sm" data-toggle="collapse" aria-expanded="false" aria-controls="collapse">
                                        <i class="material-icons">class</i> @lang('Manage Course, Semester')
                                    </a>
                                </td>
                            </tr>
                            <tr class="collapse" id="collapse" aria-labelledby="heading" aria-expanded="false">
                                <td colspan="12">
                                    @include('layouts.master.add-class-form')
                                    <div><small>@lang('Click Course to View All Semester')</small></div>
                                    <div class="row">
                                        @foreach($classes as $class)
                                        @if($class->school_id == $school->id)
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal{{$class->id}}" style="margin-top: 5%;">@lang('Manage') {{$class->class_number}} {{!empty($class->group)? '- '.$class->group:''}}</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">@lang('All Semester of Class') {{$class->class_number}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-check">
                                                                <?php
                                                                $checked = Session::has('ignoreSessions') ? (Session::get('ignoreSessions') == "true" ? "checked='checked'" : "") : "";
                                                                ?>
                                                                <input class="form-check-input position-static" type="checkbox" name="ignoreSessionsCheck" id="ignoreSessionsId" <?php echo $checked ?>>
                                                                @lang("Ignore Sessions when listing students for promoting")
                                                            </div>
                                                            <ul class="list-group">
                                                                @foreach($sections as $section)
                                                                @if($section->class_id == $class->id)
                                                                <li class="list-group-item">@lang('Semester') {{$section->section_number.' '.$section->room_number.' L'}} &nbsp;
                                                                    <a class="btn btn-xs btn-warning" href="{{url('courses/0/'.$section->id)}}">@lang('View All Assigned Courses')</a>
                                                                    <span class="pull-right"> &nbsp;&nbsp;
                                                                        <a class="btn btn-xs btn-success" href="{{url('school/promote-students/'.$section->id.'/'.$class->id)}}">+ @lang('Promote Students')</a>
                                                                        {{-- &nbsp;<a class="btn btn-xs btn-primary" href="{{url('register/student/'.$section->id)}}">+ @lang('Register Student')</a> --}}
                                                                    </span>
                                                                    @include('layouts.master.add-course-form')
                                                                </li>
                                                                @endif
                                                                @endforeach
                                                            </ul>
                                                            @include('layouts.master.create-section-form')
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <h4>@lang('Add Users')</h4>
                    <table class="table table-condensed" style="width:600px">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: inherit !important;">+@lang('Student')</th>
                                <th scope="col" style="background-color: inherit !important;">+@lang('Teacher')</th>
                                <th scope="col" style="background-color: inherit !important;">+@lang('Accountant')</th>
                                <th scope="col" style="background-color: inherit !important;">+@lang('Librarian')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{url('register/student')}}">+ @lang('Add Student')</a>
                                    <br>
                                    <small>@lang('Or, Mass upload Excel')</small>
                                    @component('components.excel-upload-form', ['type'=>'student'])
                                    @endcomponent
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{url('register/teacher')}}">+ @lang('Add Teacher')</a>
                                    <br>
                                    <small>@lang('Or, Mass upload Excel')</small>
                                    @component('components.excel-upload-form', ['type'=>'teacher'])
                                    @endcomponent
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{url('register/accountant')}}">+ @lang('Add Accountant')</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{url('register/librarian')}}">+ @lang('Add Librarian')</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h4>@lang('Upload')</h4>
                    <table class="table table-condensed" style="width:400px">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: inherit !important;">+@lang('Notice')</th>
                                <th scope="col" style="background-color: inherit !important;">+@lang('Event')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ url('academic/notice') }}">
                                        <i class="material-icons">developer_board</i> @lang('Upload Notice')
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ url('academic/event') }}">
                                        <i class="material-icons">developer_board</i> @lang('Upload Event')
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#ignoreSessionsId").change(function() {
            var ignoreSessions = $("#ignoreSessionsId").is(":checked");

            $.ajax({
                type: 'POST',
                url: '/school/set-ignore-sessions',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    "ignoreSessions": ignoreSessions
                },
                success: function(data) {
                    if (data.data.success) {
                        console.log("Result = " + data.data.success);
                    }
                }
            });
        });
    });
</script>
@endsection