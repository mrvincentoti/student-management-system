{{$users->links()}}
<div class="table-responsive">
  <table class="table table-striped" id="table-11">
    <thead>
      <tr>
        <th scope="col">#</th>
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'admission')
        @if (!Session::has('section-attendance'))
        <th scope="col">@lang('Action')</th>
        @endif
        @endif
        <th scope="col">@lang('Status')</th>
        <th scope="col">@lang('Full Name')</th>
        @foreach ($users as $user)
        @if($user->role == 'student')
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <th scope="col">@lang('Attendance')</th>
        {{--@if (!Session::has('section-attendance'))
              <th scope="col">@lang('Marks')</th>
              @endif --}}
        @endif
        @if (!Session::has('section-attendance'))
        @if(Auth::user()->role != 'admission')
        <th scope="col">@lang('Session')</th>
        @endif
        <th scope="col">@lang('Class')</th>
        <th scope="col">@lang('Section')</th>
        @if(Auth::user()->role != 'admission')
        <!-- <th scope="col">@lang('Father')</th>
              <th scope="col">@lang('Mother')</th> -->
        @endif
        @endif
        @elseif($user->role == 'teacher')
        @if (!Session::has('section-attendance'))
        <th scope="col">@lang('Email')</th>
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <th scope="col">@lang('Courses')</th>
        @endif
        @endif
        @elseif($user->role == 'accountant' || $user->role == 'librarian')
        @if (!Session::has('section-attendance'))
        <th scope="col">@lang('Email')</th>
        @endif
        @endif
        @break($loop->first)
        @endforeach
        @if (!Session::has('section-attendance'))
        <<th scope="col">@lang('Email')</th>
          <th scope="col">@lang('Gender')</th>
          <th scope="col">@lang('Phone')</th>
          <!-- <th scope="col">@lang('Address')</th> -->
          @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $key=>$user)
      <tr>
        <th scope="row">{{ ($current_page-1) * $per_page + $key + 1 }}</th>
        @if(Auth::user()->role == 'admin')
        @if (!Session::has('section-attendance'))
        <td>
          <a class="btn btn-xs btn-danger" href="{{url('edit/user/'.$user->id)}}">@lang('Edit')</a> |
          <a class="btn btn-xs btn-warning" href="{{url('user/'.$user->id)}}">@lang('Details')</a> |
          <!-- <a class="btn btn-xs btn-success" href="{{url('approve/user/'.$user->id)}}">@lang('Approve')</a> -->
        </td>
        @endif
        @endif
        @if(Auth::user()->role == 'admission')
        @if (!Session::has('section-attendance'))
        <td>
          <a class="btn btn-xs btn-warning" href="{{url('view/acceptance/'.$user->id)}}">@lang('Details')</a>
          @if(Auth::user()->role != 'admission') |
          @if($user->active != 1)
          <a class="btn btn-xs btn-success" href="{{url('approve/acceptance/'.$user->id)}}">@lang('Approve')</a>
          @else
          <a class="btn btn-xs btn-danger" href="{{url('decline/acceptance/'.$user->id)}}">@lang('Decline')</a>
          @endif
          @endif
        </td>
        @endif
        @endif
        <!-- <td><small>{{$user->student_code}}</small></td> -->
        <td>
          @if($user->active == 1)
          <span class="badge badge-success">Accepted</span>
          @endif
          @if($user->active == 0)
          <span class="badge badge-warning">Pending</span>
          @endif
          @if($user->active == 3)
          <span class="badge badge-danger">Rejected</span>
          @endif
        </td>
        <td>
          @if(!empty($user->pic_path))
          <img src="{{asset('01-progress.gif')}}" data-src="{{url($user->pic_path)}}" style="border-radius: 50%;" width="25px" height="25px">
          @else
          @if(strtolower($user->gender) == trans('male'))
          <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
          @else
          <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/businesswoman.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
          @endif
          @endif
          <a href="{{url('user/'.$user->id)}}">
            {{$user->name}}</a>
        </td>
        @if($user->role == 'student')
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <td><small><a class="btn btn-xs btn-info" role="button" href="{{url('attendances/0/'.$user->id.'/0')}}">@lang('View Attendance')</a></small></td>
        {{--@if (!Session::has('section-attendance'))
            <td><small><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$user->id)}}">@lang('View Marks')</a></small></td>
        @endif --}}
        @endif
        @if (!Session::has('section-attendance'))
        @if(Auth::user()->role != 'admission')
        <td>
          <small>
            @isset($user->session)
            {{$user->session}}
            @if($user->session == now()->year || $user->session > now()->year)
            <span class="badge badge-success">@lang('Promoted/New')</span>
            @else
            <span class="badge badge-danger">@lang('Not Promoted')</span>
            @endif
            @endisset
          </small>
        </td>

        @endif
        @isset($user->section)
        <td><small>{{$user->section->class->class_number}} {{!empty($user->group)? '- '.$user->group:''}}</small></td>
        <td style="white-space: nowrap;"><small>{{$user->section->section_number}}
            {{-- @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
              - <a class="btn btn-xs btn-primary" role="button" href="{{url('courses/0/'.$user->section->id)}}">@lang('All Courses')</a>
            @endif --}}
          </small>
        </td>
        @endisset
        {{-- @if(Auth::user()->role != 'admission')
          <td><small>
          @isset($user->studentInfo['father_name'])
            {{$user->studentInfo['father_name']}}
        @endisset</small></td>
        <td><small>
            @isset($user->studentInfo['mother_name'])
            {{$user->studentInfo['mother_name']}}
            @endisset</small></td>
        @endif --}}
        @endif
        @elseif($user->role == 'teacher')
        @if (!Session::has('section-attendance'))
        <td>
          <small>{{$user->email}}</small>
        </td>
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <td style="white-space: nowrap;">
          <small>
            <a href="{{url('courses/'.$user->id.'/0')}}">@lang('All Courses')</a>
          </small>
        </td>
        @endif
        @endif
        @elseif($user->role == 'accountant' || $user->role == 'librarian')
        @if (!Session::has('section-attendance'))
        <td>
          <small>{{$user->email}}</small>
        </td>
        @endif
        @endif
        @if (!Session::has('section-attendance'))
        @if(Auth::user()->role == 'admission' || Auth::user()->role == 'admin')
        <td><small>{{$user->email}}</small></td>
        @endif
        <td><small>{{ucfirst($user->gender)}}</small></td>
        <td><small>{{$user->phone_number}}</small></td>
        <!-- <td><small>{{$user->address}}</small></td> -->
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{$users->links()}}