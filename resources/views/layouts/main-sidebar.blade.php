<script>
    $(document).ready(function() {
        $('.nav-item.active').removeClass('active');
        $('a[href="' + window.location.href + '"]').closest('li').closest('ul').closest('li').addClass('active');
        $('a[href="' + window.location.href + '"]').closest('li').addClass('active');
    });
</script>
<style>
    .nav-item.active {
        background-color: #fce8e6;
        font-weight: bold;
    }

    .nav-item.active a {
        color: #d93025;
    }

    .nav-link-text {
        padding-left: 10%;
    }

    #side-navbar ul>li>a {
        padding: 8px 15px;
    }
</style>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{asset('img/logo.jpg')}}" class="header-logo" /> <span class="logo-name"></span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
                <a href="{{ url('home') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            @if(Auth::user()->role == 'admin')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>@lang('Attendance')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">@lang('Teacher Attendance')</a></li>
                    <li><a class="nav-link" href="{{url('school/sections?att=1')}}">@lang('Student Attendance')</a></li>
                    <li><a class="nav-link" href="#">@lang('Staff Attendance')</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="{{ url('school/sections?course=1') }}"><i data-feather="book-open"></i><span>@lang('Classes &amp; Sections')</span></a></li>
            @endif

            @if(Auth::user()->role != 'student' && isset(Auth::user()->school->code) &&
            Auth::user()->role != 'admission' && isset(Auth::user()->school->code)
            && Auth::user()->role != 'applicant' && Auth::user()->role != 'custom' && Auth::user()->role != 'teacher')
            <li><a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"><i data-feather="users"></i><span>@lang('Students')</span></a></li>
            <li><a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i data-feather="users"></i><span>@lang('Teachers')</span></a></li>
            <li><a class="nav-link" href="{{url('users/add-custom-users/'.Auth::user()->school->code)}}"><i data-feather="users"></i><span>@lang('Users')</span></a></li>
            @endif

            @if(Auth::user()->role == 'custom')
            @if(in_array('hod', explode(",",Auth::user()->permission)) || in_array('levelcordinator', explode(",",Auth::user()->permission)))
            <li><a class="nav-link" href="{{url('students/courses')}}"><i data-feather="users"></i><span>@lang('Students')</span></a></li>
            @endif
            @endif
            @if(Auth::user()->role == 'admin' && isset(Auth::user()->school->code) || Auth::user()->role == 'admission' && isset(Auth::user()->school->code))
            <li><a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/2/0')}}"><i data-feather="users"></i><span>@lang('Applicants')</span></a></li>
            <li><a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/3/0')}}"><i data-feather="users"></i><span>@lang('Registered Students')</span></a></li>
            @endif

            @if(Auth::user()->role == 'admin')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="folder"></i><span>@lang('Exams')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('exams/create') }}">@lang('Add Examination')</a></li>
                    <li><a class="nav-link" href="{{ url('exams/active') }}">@lang('Active Exams')</a></li>
                    <li><a class="nav-link" href="{{ url('exams') }}">@lang('Manage Examinations')</a></li>
                </ul>
                <!-- <ul class="dropdown-menu" style="width: 100%;">
                        <li>
                            <a class="dropdown-item" href="{{ url('exams/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add Examination')</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('exams/active') }}"><i class="material-icons">developer_board</i> <span
                                class="nav-link-text">@lang('Active Exams')</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('exams') }}"><i class="material-icons">settings</i> <span class="nav-link-text">@lang('Manage Examinations')</span></a>
                        </li>
                    </ul> -->
                <!-- <ul class="dropdown-menu" style="width: 100%;">
                        <li>
                            <a class="dropdown-item" href="{{ url('exams/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add Examination')</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('exams/active') }}"><i class="material-icons">developer_board</i> <span
                                class="nav-link-text">@lang('Active Exams')</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('exams') }}"><i class="material-icons">settings</i> <span class="nav-link-text">@lang('Manage Examinations')</span></a>
                        </li>
                    </ul> -->
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('grades/all-exams-grade') }}"><i class="material-icons">assignment</i> <span class="nav-link-text">@lang('Grades')</span></a>
                </li> -->
            <li><a class="nav-link" href="{{ url('grades/all-exams-grade') }}"><i data-feather="check-square"></i><span>@lang('Grades')</span></a></li>
            <li><a class="nav-link" href="{{ url('update-matriculation-number') }}"><i data-feather="check-square"></i><span>@lang('Update Matric Number')</span></a></li>
            <li><a class="nav-link" href="{{ url('students/'.Auth::user()->school->code.'/0') }}"><i data-feather="check-square"></i><span>@lang('CGPA')</span></a></li>

            <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('academic/routine') }}"><i class="material-icons">calendar_today</i> <span class="nav-link-text">@lang('Class Routine')</span></a>
                </li> -->
            <!-- <li><a class="nav-link" href="{{ url('academic/routine') }}"><i data-feather="layers"></i><span>@lang('Class Routine')</span></a></li> -->
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('academic/syllabus') }}"><i class="material-icons">vertical_split</i> <span class="nav-link-text">@lang('Syllabus')</span></a>
                </li> -->
            <li><a class="nav-link" href="{{ url('academic/syllabus') }}"><i data-feather="list"></i><span>@lang('Syllabus')</span></a></li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('academic/notice') }}"><i class="material-icons">announcement</i> <span class="nav-link-text">@lang('Notice')</span></a>
                </li> -->
            <!-- <li><a class="nav-link" href="{{ url('academic/notice') }}"><i data-feather="mic"></i><span>@lang('Notice')</span></a></li> -->
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('academic/event') }}"><i class="material-icons">event</i> <span class="nav-link-text">@lang('Event')</span></a>
                </li> -->
            <!-- <li><a class="nav-link" href="{{ url('academic/event') }}"><i data-feather="tv"></i><span>@lang('Event')</span></a></li> -->
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('academic/certificate') }}"><i class="material-icons">verified</i> <span class="nav-link-text">Certificate</span></a>
                </li> -->
            <!-- <li><a class="nav-link" href="{{ url('academic/certificate') }}"><i data-feather="award"></i><span>Certificate</span></a></li> -->
            <li><a class="nav-link" href="{{ url('file-import-export') }}"><i data-feather="list"></i><span>Upload Jamb List</span></a></li>
            <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index') }}"><i class="material-icons">settings</i> <span class="nav-link-text">@lang('Academic Settings')</span></a>
                </li> -->
            <li><a class="nav-link" href="{{ route('settings.index') }}"><i data-feather="sliders"></i><span>@lang('Academic Settings')</span></a></li>
            <!-- <li class="nav-item dropdown">
                    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="material-icons">chrome_reader_mode</i> <span class="nav-link-text">@lang('Manage GPA')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
                    <ul class="dropdown-menu" style="width: 100%;">
                    <li>
                        <a class="dropdown-item" href="{{ url('gpa/all-gpa') }}"><i class="material-icons">developer_board</i> <span
                            class="nav-link-text">@lang('All GPA')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('gpa/create-gpa') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add New GPA')</span></a>
                    </li>
                    </ul>
                </li> -->
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-minus"></i><span>@lang('Manage GPA')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('gpa/all-gpa') }}">@lang('All GPA')</a></li>
                    <li><a class="nav-link" href="{{ url('gpa/create-gpa') }}">@lang('Add New GPA')</a></li>
                </ul>
            </li>
            <!-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="home"></i><span>@lang('Hostel')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('hostels') }}">@lang('All Hostel')</a></li>
                    <li><a class="nav-link" href="{{ url('exams/allocation') }}">@lang('Allocation')</a></li>
                    <li><a class="nav-link" href="{{ url('request') }}">@lang('Request')</a></li>
                </ul>
            </li> -->
            @endif
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
            <!-- <li class="nav-item dropdown">
                    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="material-icons">monetization_on</i> <span class="nav-link-text">@lang('Fees Generator')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
                    <ul class="dropdown-menu" style="width: 100%;">
                    <li>
                        <a class="dropdown-item" href="{{ url('fees/all') }}"><i class="material-icons">developer_board</i> <span class="nav-link-text">@lang('Generate Form')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('fees/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add Fee Field')</span></a>
                    </li>
                    </ul>
                </li> -->
            <!-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="credit-card"></i><span>@lang('Fees Generator')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('fees/all') }}">@lang('Generate Form')</a></li>
                    <li><a class="nav-link" href="{{ url('fees/create') }}">@lang('Add Fee Field')</a></li>
                </ul>
            </li> -->
            @endif

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
            <!-- <li class="nav-item dropdown">
                    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="material-icons">account_balance_wallet</i> <span class="nav-link-text">@lang('Manage Accounts')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
                    <ul class="dropdown-menu" style="width: 100%;">
                    <li>
                        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/accountant')}}"><i class="material-icons">account_balance_wallet</i>
                        <span class="nav-link-text">@lang('Accountant List')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('accounts/sectors') }}"><i class="material-icons">developer_board</i>
                        <span class="nav-link-text">@lang('Add Account Sector')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('accounts/expense') }}"><i class="material-icons">note_add</i> <span
                            class="nav-link-text">@lang('Add New Expense')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('accounts/expense-list') }}"><i class="material-icons">developer_board</i>
                        <span class="nav-link-text">@lang('Expense List')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('accounts/income') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add New Income')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('accounts/income-list') }}"><i class="material-icons">developer_board</i>
                        <span class="nav-link-text">@lang('Income List')</span></a>
                    </li>
                    </ul>
                </li> -->
            <!-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="server"></i><span>@lang('Manage Accounts')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/accountant')}}">@lang('Accountant List')</a></li>
                    <li><a class="nav-link" href="{{ url('accounts/sectors') }}">@lang('Add Account Sector')</a></li>
                    <li><a class="nav-link" href="{{ url('accounts/expense') }}">@lang('Add New Expense')</a></li>
                    <li><a class="nav-link" href="{{ url('accounts/expense-list') }}">@lang('Expense List')</a></li>
                    <li><a class="nav-link" href="{{ url('accounts/income') }}">@lang('Add New Income')</a></li>
                    <li><a class="nav-link" href="{{ url('accounts/income-list') }}">@lang('Income List')</a></li>
                </ul>
            </li> -->
            @endif
            @if(Auth::user()->role == 'student')
            <!-- <li class="nav-item">
                    <a class="nav-link active" href="{{ url('attendances/0/'.Auth::user()->id.'/0') }}"><i class="material-icons">date_range</i>
                    <span class="nav-link-text">@lang('My Attendance')</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('user/'.Auth::user()->id.'/notifications')}}">
                    <i class="material-icons">email</i> 
                    <span class="nav-link-text">Notifications</span>
                    <?php
                    $mc = \App\Notification::where('student_id', Auth::user()->id)->where('active', 1)->count();
                    ?>
                    @if($mc > 0)
                        <span class="label label-danger" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">{{$mc}}</span>
                    @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('courses/0/'.Auth::user()->section_id) }}"><i class="material-icons">subject</i>
                    <span class="nav-link-text">@lang('My Courses')</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('grades/'.Auth::user()->id) }}"><i class="material-icons">bubble_chart</i> <span
                        class="nav-link-text">@lang('My Grade')</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('stripe/charge')}}"><i class="material-icons">payment</i> <span class="nav-link-text">@lang('Payment')</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('stripe/receipts')}}"><i class="material-icons">receipt</i> <span class="nav-link-text">@lang('Receipt')</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('academic/student/certificates')}}"><i class="material-icons">bookmark_border</i> <span class="nav-link-text">Certificates</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('application-summary-payment/'.Auth::user()->id.'/1')}}"><i class="material-icons">receipt</i> <span class="nav-link-text">@lang('Photo Card')</span></a>
                </li> -->

            <li class="nav-item">
                <a class="nav-link active" href=""><i class="material-icons">date_range</i>
                    <span class="nav-link-text">@lang('My Attendance')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('user/'.Auth::user()->id.'/notifications')}}">
                    <i class="material-icons">email</i>
                    <span class="nav-link-text">Notifications</span>
                    <?php
                    $mc = \App\Notification::where('student_id', Auth::user()->id)->where('active', 1)->count();
                    ?>
                    @if($mc > 0)
                    <span class="badge badge-danger" style="width: 25px !important;">{{$mc}}</span>
                    @endif
                </a>
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('courses/0/'.Auth::user()->section_id) }}"><i class="material-icons">subject</i>
                    <span class="nav-link-text">@lang('My Courses')</span></a>
                </li> -->
            <li class="dropdown">
                <a class="menu-toggle nav-link has-dropdown" href="#"><i class="material-icons">subject</i>
                    <span class="nav-link-text">@lang('Courses')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('student/course-registration')}}">@lang('Course Registration')</a></li>
                    <li><a class="nav-link" href="{{ url('student/student-courses/'.Auth::user()->id) }}">@lang('My Courses')</a></li>
                    <!--li><a class="nav-link" href="{{ url('accounts/expense') }}">@lang('Register Carry Over')</a></li-->
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="material-icons">bubble_chart</i> <span class="nav-link-text">@lang('My Grade')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="material-icons">payment</i> <span class="nav-link-text">@lang('Payment')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="material-icons">receipt</i> <span class="nav-link-text">@lang('Receipt')</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href=""><i class="material-icons">bookmark_border</i> <span class="nav-link-text">Certificates</span></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('application-summary-payment/'.Auth::user()->id.'/1')}}"><i class="material-icons">receipt</i> <span class="nav-link-text">@lang('Photo Card')</span></a>
            </li>
            @endif
            {{--<div style="text-align:center;">@lang('Student')</div>--}}
            {{--<div style="text-align:center;">@lang('Teacher')</div>--}}
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'librarian')
            <!-- <li class="nav-item dropdown">
                    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="material-icons">local_library</i> <span class="nav-link-text">@lang('Manage Library')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
                    <ul class="dropdown-menu" style="width: 100%;">
                    <li>
                        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/librarian')}}"><i class="material-icons">local_library</i>
                        <span class="nav-link-text">@lang('Librarian List')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('library.books.index') }}"><i class="material-icons">developer_board</i>
                        <span class="nav-link-text">@lang('All Books')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('library/issued-books') }}"><i class="material-icons">developer_board</i>
                        <span class="nav-link-text">@lang('All Issued Books')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('library/issue-books') }}"><i class="material-icons">receipt</i> <span
                            class="nav-link-text">@lang('Issue Book')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('library.books.create') }}"><i class="material-icons">note_add</i> <span
                            class="nav-link-text">@lang('Add New Book')</span></a>
                    </li>
                    </ul>
                </li> -->
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="book"></i><span>@lang('Manage Library')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/librarian')}}">@lang('Librarian List')</a></li>
                    <li><a class="nav-link" href="{{ route('library.books.index') }}">@lang('All Books')</a></li>
                    <li><a class="nav-link" href="{{ url('library/issued-books') }}">@lang('All Issued Books')</a></li>
                    <li><a class="nav-link" href="{{ url('library/issue-books') }}">@lang('Issue Book')</a></li>
                    <li><a class="nav-link" href="{{ route('library.books.create') }}">@lang('Add New Book')</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->role == 'teacher')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('courses/'.Auth::user()->id.'/0') }}">
                    <!-- <i class="material-icons">import_contacts</i>
                        <span class="nav-link-text">@lang('My Courses')</span> -->
                    <i data-feather="layers"></i><span>@lang('My Courses')</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ url('user/config/change_password') }}">
                    <i data-feather="users"></i><span>@lang('Change Password')</span>
                </a>
            </li>
        </ul>
    </aside>
</div>