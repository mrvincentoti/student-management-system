<div class="table-responsive mt-3">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">@lang('File Name')</th>
        @if($upload_type == 'syllabus' && $parent == 'class')
        <th scope="col">@lang('Class')</th>
        @elseif($upload_type == 'routine' && $parent == 'section')
        <th scope="col">@lang('section')</th>
        @elseif($upload_type == 'certificate')
        <th scope="col">Certificates</th>
        @endif
        <th scope="col">@lang('Is Active')</th>
        <th scope="col">@lang('Action')</th>
      </tr>
    </thead>
    <tbody>
      @foreach($files as $file)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td><a href="{{url($file->file_path)}}" target="_blank">{{$file->title}}</a></td>
        @if($upload_type == 'syllabus' && $parent == 'class')
        <td>{{$file->myclass->class_number}}</td>
        @elseif($upload_type == 'routine' && $parent == 'section')
        <td>{{$file->section->section_number}}</td>
        @elseif($upload_type == 'certificate')
        @isset($file->student->name)
        <td>{{$file->student->name}}</td>
        @endisset
        @empty($file->student)
        <td>Student Code: <span style="color: #d93025;">{{$file->given_to}}</span> does not exist</td>
        @endempty
        @endif
        <td>{{($file->active === 1)?'Yes':'No'}}</td>
        <td>
          <a href="{{url('academic/remove/'.$upload_type.'/'.$file->id)}}" class="btn btn-danger btn-sm" role="button"><i class="material-icons">delete</i> @lang('Remove')</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>