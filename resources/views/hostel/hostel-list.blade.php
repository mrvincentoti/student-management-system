@extends('layouts.landing')

@section('title', __('Hostel'))

@section('content')
<div class="container-fluid">
    <div class="col-md-12" id="main-container">
        <div class="card">
            <div class="card-body">
                <button style="float: right;" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#hostelModal" dusk="create-school-button">
                    <i class="far fa-edit"></i> + @lang('Add Hostel')
                </button>
                <h2 class="mt-3">@lang('Hostels')</h2>
                <hr />
                <!-- <h4>@lang('Manage Departments, Classs, Sections, Student Promotion, Course')</h4> -->
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Code')</th>
                                <th scope="col">@lang('About')</th>
                                <th scope="col">@lang('Edit')</th>
                                <th scope="col">+@lang('Admin')</th>
                                <th scope="col">@lang('View Admins')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><small>Name</small></td>
                                <td><small>Code</small></td>
                                <td><small>About</small></td>
                                <td>
                                    <a class="btn btn-success btn-sm" role="button" href="" dusk="edit-school-link">
                                        <small>@lang('Edit School')</small>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" role="button" href="">
                                        <small>+ @lang('Create Admin')</small>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" role="button" href="">
                                        <small>@lang('View Admins')</small>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection