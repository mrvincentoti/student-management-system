@extends('layouts.app')
@section('title', __('Add Examination'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
                <div class="card-header">@lang('Add Examination')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.add-exam-form',['classes'=>$classes,'assigned_classes'=>$already_assigned_classes,])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
