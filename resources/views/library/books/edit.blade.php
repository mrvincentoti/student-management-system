@extends('layouts.app')

@section('title', __('Edit Book'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Edit Book Info')</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ url('library/books', $book->id) }}" method="POST" class="form-horizontal">

                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include('library.books.form', $book)

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-danger">@lang('Update Book Info')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection