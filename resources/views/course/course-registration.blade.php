@extends('layouts.landing')

@section('title', __('Course'))

@section('content')
<style>
    .lds-ellipsis {
        /*display: inline-block;*/
        position: relative;
        width: 80px;
    }

    .lds-ellipsis div {
        position: absolute;
        top: 10px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: red;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }

    .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
    }

    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(0);
        }
    }

    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }

        100% {
            transform: translate(24px, 0);
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form method="POST" action="{{ route('save-student-courses') }}">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="semester">Choose semester to register courses</label>
                                <select id="semester" class="form-control" name="semester">
                                    <option value="" selected="">Choose...</option>
                                    <option value="">All</option>
                                    @foreach($sections as $section)
                                    <option value="{{$section->id}}">{{$section->section_number.'-'.$section->room_number.' Level'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="subject">Choose courses-[<code>Code-Name-Credit Unit-Lecturer</code>]</label>
                                <select class="form-control select2" id="subject" multiple="" name="courses[]">
                                </select>
                                <div class="lds-ellipsis" id="lds-ellipsis" style="display: none;">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registered Courses: {{$department->class_number}}, Level: {{ \Auth::user()->level}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Unit</th>
                                    <th>Status</th>
                                    <th>Semester</th>
                                    <th>Lecturer</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($courses as $index => $course)

                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$course->course_code}}</td>
                                    <td>{{$course->course_name}}</td>
                                    <td>{{$course->credit_unit}}</td>
                                    <td>{{$course->course_type}}</td>
                                    <td>{{$course->semester}}</td>
                                    <td>{{$course->lecturer}}</td>
                                    <td>
                                        @if($course->status == 1)
                                        <div class="badge badge-warning">Pending</div>
                                        @elseif($course->status == 2)
                                        <div class="badge badge-success">Approved</div>
                                        @else
                                        <div class="badge badge-danger">Not Approved</div>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('remove-student-course')}}">
                                            @csrf
                                            @if(App\Http\Controllers\StudentcourseController::isRegistrationApproved(\Auth::user()->id,\Auth::user()->level)
                                            <= 0) <p>Approved</p>
                                                @else <input type="hidden" name="id" value="{{ $course->sid }}" />
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                                @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin/js/jquery.js')}}"></script>

<script>
    $(document).ready(function() {
        $("#semester").change(function() {
            var semester_id = $("#semester").val();
            $('#subject').find('option').remove();
            $("#lds-ellipsis").css("display", "inline-block");
            $.ajax({
                type: 'POST',
                url: '/courses/get-semester-courses',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    "semester_id": semester_id
                },

                success: function(data) {
                    if (data.data.success) {

                        $("#lds-ellipsis").css("display", "none");
                        var response = data.data.result;
                        for (var i = 0; i < response.length; i++) {
                            var id = response[i].id;
                            var name = response[i].course_code + "-" + response[i].course_name + "-" + response[i].credit_unit + "-" + response[i].teacher.name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $("#subject").append(option);
                        }
                    }
                },
            });
        });
    });
</script>
@endsection