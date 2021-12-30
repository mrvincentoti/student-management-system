@extends('layouts.landing')

@section('title', __('Grade'))

@section('content')
<div class="col-md-12">
    <div class="card">
        <!-- <div class="card-header">
            <h4>Small Table, Caption &amp; Responsive</h4>
        </div> -->
        <div class="card-body">
            <!-- <div class="section-title">Responsive</div> -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th class="text-center">Credit Unit</th>
                            <th class="text-center">Grade</th>
                            <th class="text-center">Grade Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cgpas as $levelname => $semester)
                        <tr>
                            <th colspan="5">{{ $levelname }}</th>
                        </tr>
                        @foreach($semester as $semestername => $courses)
                        <tr>
                            <th colspan="5">{{ $semestername }}</th>
                        </tr>
                        @foreach($courses as $courselist)
                        <tr>
                            <td>{{$courselist->course_code}}</td>
                            <td>{{$courselist->course_name}}</td>
                            <td class="text-center">{{$courselist->credit_unit}}</td>
                            <td class="text-center">
                                @foreach($gradesystems as $gs)
                                @if($courselist->marks >= $gs->from_mark && $courselist->marks <= $gs->to_mark)
                                    {{$gs->grade}}
                                    @break
                                    @endif
                                    @endforeach
                            </td>
                            <td class="text-center">{{$courselist->gpa}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-reponsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr class="text-right">
                            <td colspan="2" style="font-weight: bold; font-size: 16px;">
                                FINAL CUMULATIVE G.P.A: &nbsp;
                                @php
                                echo App\Http\Controllers\GradeController::getCGPA($student->id);
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td>Curriculum</td>
                            <td>{{ $department->class_number }}</td>
                        </tr>
                        <tr>
                            <td>Degree</td>
                            <td>B.Sc</td>
                        </tr>
                        <!-- <tr>
                            <td>Class Of Degree</td>
                            <td>Two</td>
                        </tr>
                        <tr>
                            <td>Year Of Graduation</td>
                            <td>Two</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection