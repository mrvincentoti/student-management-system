@extends('layouts.app')
@section('title', __('All Active Examinations'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
                <div class="card-header">@lang('All Active Examinations')</div>

                <div class="card-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(count($exams) > 0)
                        @foreach($exams as $exam)
                            @component('components.active-exams',['exam'=>$exam,'courses'=>$courses])
                            @endcomponent
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
