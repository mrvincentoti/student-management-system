@extends('layouts.landing')

@section('title', __('Add Routine'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card card-primary">
                <div class="card-header">@lang('Add Routine')
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @component('components.file-uploader',['upload_type'=>'routine','classes'=>$classes,'sections'=>$sections])
                    @endcomponent
                    @component('components.uploaded-files-list',['files'=>$files,'parent'=>($section_id !== 0)?'section':'','upload_type'=>'routine'])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection