@extends('layouts.landing')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View Students CGPA</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('students/'.Auth::user()->school->code.'/0') }}" id="searchform">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>Filter by Department</label>
                                    <select class="form-control" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Filter by Level</label>
                                    <select class="form-control" name="level">
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
                                <div class="form-group col-md-2">
                                    <div style="margin-top: 30px;">
                                        <button class="btn btn-icon icon-left btn-primary" type="submit"><i class="far fa-edit"></i>Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($dept))
                        <h4>Students of {{$dept}} Departments - {{ $level }} Level</h4>
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @if(isset($students))
                                    @if(count($students) > 0)
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
                                        <td class="text-center"><a href="{{ url('grades/cgpa/'.$student->id) }}" class="btn btn-success">View CGPA</a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center">
                                        <td colspan="6">No record to display</td>
                                    </tr>
                                    @endif
                                    @endif
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