@extends('layouts.landing')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row sortable-card ui-sortable">
            @foreach($departments as $department)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-primary">
                    <div class="card-header ui-sortable-handle">
                        <h4>{{$department->department_name}}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('students-in-department/'.$department->id) }}">View Students</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection