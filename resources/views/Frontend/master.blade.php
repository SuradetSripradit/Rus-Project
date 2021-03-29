@extends('layouts/master')

@section('TitleTab')
    @yield('TitleTabName')
@endsection

@section('MenuList')
    <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item"><a class="nav-link js-scroll-trigger text-white" href="{{ url('anouncements') }}"> ข่าวสารประชาสัมพันธ์ </a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger text-white" href="/personnel"> บุคลากรประจำคณะ </a></li>
        <li class="nav-item">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown">หลักสูตรที่เปิดรับสมัคร</a>
                    <div class="dropdown-menu">
                        @foreach ($course_type as $course_type_list)
                            <h5 class="dropdown-header">
                                <strong style="color:rgb(189, 114, 2)">
                                    @if ($course_type_list["COURSE_TYPE"] == "T")
                                        หลักสูตรเทียบโอน (2 ปี)
                                    @elseif ($course_type_list["COURSE_TYPE"] == "R")
                                        หลักสูตรปกติ (4 ปี)
                                    @endif
                                </strong>
                            </h5>
                            @foreach ($course_name as $course_name_list)
                                @if ($course_name_list["COURSE_TYPE"] == $course_type_list["COURSE_TYPE"])
                                    @php
                                        $course_md = "#md_" . $course_name_list['COURSE_CODE'];
                                    @endphp

                                    <a class="dropdown-item" href="{{ url('course' , $course_name_list['COURSE_CODE']) }}">
                                        {{ $course_name_list["COURSE_NAME_TH"] }}
                                    </a>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
            </div>
        </li>
    </ul>
@endsection

@section('BodyZone')

    @yield('Getbody')

@endsection

@section('AnotherLink')
    @yield('NewLink')
@endsection

@section('JsFunction')
    <script>
        function ShowCourseModal(GetMdCode) {
            $(function() {
                    $(GetMdCode).modal({
                        backdrop: "static"
                    }, 'show');
                });
        }
    </script>
    @yield('FncJs')
@endsection
