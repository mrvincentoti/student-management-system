@extends('layouts.app')
@section('title', __('Issue Book'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Issue books')</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @component('components.book-issue-form',['books'=>$books])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection