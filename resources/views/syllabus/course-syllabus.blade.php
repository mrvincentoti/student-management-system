@extends('layouts.app')

@section('title', __('Add Syllabus'))
<!-- Main Quill library -->
{{--<script src="//cdn.quilljs.com/1.3.5/quill.js"></script>--}}

<!-- Theme included stylesheets -->
{{--<link href="//cdn.quilljs.com/1.3.5/quill.snow.css" rel="stylesheet">--}}

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card card-primary">
                <!-- <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @component('components.file-uploader',['upload_type'=>'syllabus','classes'=>$classes])
                    @endcomponent
                    @component('components.uploaded-files-list',['files'=>$files,'parent'=>($class_id !== 0)?'class':'','upload_type'=>'syllabus'])
                    @endcomponent
                </div> -->
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @component('components.add-syllabus',['upload_type'=>'syllabus','classes'=>$classes])
                    @endcomponent
                    @component('components.uploaded-files-list',['files'=>$files,'parent'=>($class_id !== 0)?'class':'','upload_type'=>'syllabus'])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection