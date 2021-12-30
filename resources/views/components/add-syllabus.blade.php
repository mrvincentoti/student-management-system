<form method="POST" action="{{ url('academic/syllabus/add') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <h3>{{__(ucfirst("Add Syllabus"))}}</h3>
    <hr />
    <label for="upload-title">@lang('File Title'): </label>
    <input type="text" class="form-control" name="title" placeholder="@lang('File title here...')" required>
    <br />

    <!-- <label for="sections">For</label>
    <select id="sections" class="form-control" name="sections" required>
        @foreach($classes as $class)
        @foreach($class->sections as $section)
        <option value="{{$class->id}}">
            @lang('Department'): {{$class->class_number}}
        </option>
        @endforeach
        @endforeach
    </select>
    <br /> -->
    <label for="sections">For</label>
    <select id="sections" class="form-control" name="sections" required>
        @foreach($classes as $class)
        <option value="{{$class->id}}">
            @lang('Department'): {{$class->class_number}}
        </option>
        @endforeach
    </select>
    <br />
    <input class="form-control-sm" type="file" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf,image/png,image/jpeg" name="file">
    <br />
    <hr />
    <button type="submit" class="btn btn-primary text-right">Submit</button>
</form>