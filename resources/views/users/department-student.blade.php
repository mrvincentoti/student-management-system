@extends('layouts.landing')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ url('students/courses') }}" id="searchform">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Filter by Level</label>
                            <select class="form-control" id="level" name="level">
                                <option value="">Select Level</option>
                                <option value="100">100 Level</option>
                                <option value="200">200 Level</option>
                                <option value="300">300 Level</option>
                                <option value="400">400 Level</option>
                                <option value="500">500 Level</option>
                                <option value="600">600 Level</option>
                                <option value="700">700 Level</option>
                                <option value="800">800 Level</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if(!empty($department))
                        <h4>Students in {{ $department->department_name}}</h4>
                        @endif
                    </div>
                    <div class="card-body" id="my-table-parent">
                        <div class="table-responsive" id="my-table">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Matric Number</th>
                                        <th>Name</th>
                                        <th>Level</th>
                                        <th>Position</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach($students as $student)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>{{$student->student_code}}</td>
                                        <td>{{$student->name}}</td>
                                        <td class="align-middle">
                                            {{$student->level}}
                                        </td>
                                        <td class="align-middle">
                                            @if(App\Http\Controllers\StudentcourseController::checkCourseRegistration($student->id,$student->level) > 0)
                                            <a class="btn btn-success text-white">
                                                Approved
                                            </a>
                                            @else
                                            @if(App\Http\Controllers\StudentcourseController::doesStudentHaveCourse($student->id,$student->level) > 0)
                                            <a class="btn btn-warning text-white">
                                                Pending
                                            </a>
                                            @else
                                            @endif
                                            @endif
                                        </td>
                                        @if(App\Http\Controllers\StudentcourseController::doesStudentHaveCourse($student->id,$student->level) > 0)
                                        <td class="text-center"><a href="{{ url('student/student-courses/'.$student->id) }}" class="btn btn-primary">View Courses</a></td>
                                        @else
                                        <td class="text-center"><a href="">No registration</a></td>
                                        @endif
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
</section>
@endsection