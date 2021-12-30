@extends('layouts.landing')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('student/save-code')}}" method="POST">
                    {{csrf_field()}}
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover" id="marking-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('Current Matric Number')</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('New Matric Number')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <input type="hidden" name="userids[]" value="{{$student->id}}">
                                <tr>
                                    <th scope="row">{{($loop->index + 1)}}</th>
                                    <td>{{$student->student_code}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>
                                        <input type="text" name="newcode[]" class="form-control input-sm" placeholder="@lang('New Matric Number')">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align:center;" style="margin-bottom: 30px;">
                        <input type="submit" name="save" class="btn btn-primary" value="@lang('Submit')">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection