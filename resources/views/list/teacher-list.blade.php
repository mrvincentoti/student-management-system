@extends('layouts.landing')

@section('title', __('Teachers'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
              @if(count($users) > 0)
              @foreach ($users as $user)
                <div class="card-header">@lang('List of all') {{ucfirst($user->role)}}s</div>
                 @break($loop->first)
              @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.users-export',['type'=>'teacher'])
                        
                    @endcomponent
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
