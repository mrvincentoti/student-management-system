@extends('layouts.landing')

@section('content')

 <section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Users</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                                + Add User
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if (session('add-user-error'))
                            <div class="alert alert-danger">
                                {{ session('add-user-error') }}
                            </div>
                        @elseif(session('add-user-success'))
                            <div class="alert alert-success">
                                {{ session('add-user-success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->role}}</td>
                            <td class="text-center">
                                @if($user->active == 1)
                                <div class="badge badge-success">Active</div>
                                @else
                                <div class="badge badge-danger">Not Active</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <form method="post" action="{{url('users/delete-custom-user')}}">
                                 {{csrf_field()}}
                                    <input type="hidden" name="userID" value="{{ $user->id }}"/>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </table>
                    </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</section>
@endsection