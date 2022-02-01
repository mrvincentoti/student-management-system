<a class="btn btn-xs btn-info pull-right" data-toggle="collapse" href="#collapseForNewCourse{{$section->id}}" aria-expanded="false" aria-controls="collapseForNewCourse{{$section->id}}">+ @lang('Add New Course')</a>
<div class="collapse" id="collapseForNewCourse{{$section->id}}" style="margin-top:1%;">
  <div class="card">
    <div class="card-body">
      <form class="form-horizontal" action="{{url('courses/store')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="class_id" value="{{$class->id}}" />
        <input type="hidden" name="section_id" value="{{$section->id}}" />
        <div class="form-group">
          <label>@lang('Course Code')</label>
          <input type="text" class="form-control" name="course_code" placeholder="@lang('Course Code')">
        </div>
        <div class="form-group">
          <label>@lang('Course Name')</label>
          <input type="text" class="form-control" id="courseName{{$section->id}}" name="course_name" placeholder="@lang('Course Name')">
        </div>
        <div class="form-group">
          <label>@lang('Credit Units')</label>
          <input type="text" class="form-control" name="credit_unit" placeholder="@lang('Credit Units')">
        </div>
        <div class="form-group">
          <label for="teacherDepartment{{$section->id}}">@lang('Teacher Department')</label>
          <select class="form-control" id="teacherDepartment{{$section->id}}" name="teacher_department" onchange="
            getTeacher('teacherDepartment{{$section->id}}','assignTeacher{{$section->id}}')">
            <option value="0" selected disabled>@lang('Select Department')</option>
            @if(count($departments) > 0)
            @php
            $departments_of_this_school = $departments->filter(function ($department) use ($school){
            return $department->school_id == $school->id;
            });
            @endphp
            @foreach ($departments_of_this_school as $d)
            <option value="{{$d->id}}">{{$d->department_name}}</option>
            @endforeach
            @endif
          </select>
        </div>
        <div class="form-group">
          <label for="assignTeacher{{$section->id}}">@lang('Assign Course Teacher')</label>
          <select class="form-control" id="assignTeacher1{{$section->id}}" name="teacher_id">
            <option value="0" selected disabled>@lang('Select Department First')</option>
            @if(count($teachers) > 0)
            @php
            $teachers_of_this_school = $teachers->filter(function ($teacher) use ($school){
            return $teacher->school_id == $school->id;
            });
            @endphp
            @foreach($teachers as $teacher)
            <option value="{{$teacher->id}}" data-department="{{$teacher->department_name}}">{{$teacher->name}} {{$teacher->department_name}}</option>
            @endforeach
            @endif
          </select>
        </div>
        <div class="form-group">
          <label for="course_type{{$section->id}}">@lang('Course Type')</label>
          <select class="form-control" id="course_type{{$section->id}}" name="course_type">
            <option value="core">@lang('Core')</option>
            <option value="elective">@lang('Elective')</option>
            <option value="optional">@lang('Required')</option>
          </select>
        </div>
        <div class="form-group">
          <label for="courseTime{{$section->id}}">@lang('Course Time')</label>
          <input type="text" class="form-control" id="courseTime{{$section->id}}" name="course_time" placeholder="@lang('Course Time')">
          <span id="helpBlock" class="help-block">@lang('Example: 12:50PM-01:40PM Sunday')</span>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">@lang('Submit')</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="{{ asset('admin/js/jquery.js') }}"></script>
<script>
  $(document.body).on("change", "#teacherDepartment{{$section->id}}", function() {
    var id = $(this).val();
    $.ajax({
      url: '../departments/' + id,
      type: 'get',
      dataType: 'json',
      success: function(response) {
        var len = 0;
        if (response['data'] != null) {
          len = response['data'].length;
        }



      }
    });
  });
</script>