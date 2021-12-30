@extends('layouts.app')

@section('title', __('Librarians'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
                @if(count($users) > 0)
                @foreach ($users as $user)
                <div class="card-header">
                    <h4>@lang('List of all') {{__(ucfirst($user->role))}}s</h4>
                </div>
                @break($loop->first)
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @component('components.users-list',['users'=>$users,'current_page'=>$current_page,'per_page'=>$per_page])
                    @endcomponent
                </div>
                @else
                <div class="card-body">
                    @lang('No Related Data Found.')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection