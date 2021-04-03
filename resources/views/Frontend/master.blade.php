@extends('layouts/master')

@section('TitleTab')
    @yield('TitleTabName')
@endsection

@section('MenuList')
    <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item"><a id="chk_status" class="nav-link js-scroll-trigger text-white" data-toggle="modal" data-target="#CheckResult"> ตรวจสอบผลการสมัคร </a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger text-white" href="{{ url('anouncements') }}"> ข่าวสารประชาสัมพันธ์ </a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger text-white" href="{{ url('personnel') }}"> บุคลากรประจำคณะ </a></li>
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
    @if (\Session::has('success'))
        <script>
            swal("สำเร็จ!", "{{ \Session::get('success') }}", "success");
        </script>
    @elseif (\Session::has('error'))
        <script>
            swal("ล้มเหลว!", "{{ \Session::get('error') }}", "error");
        </script>
    @elseif (\Session::has('status_app'))
        <script>
            swal("ผลการสมัคร!", "{{ \Session::get('status_app') }}", "info");
        </script>
    @endif
    @yield('Getbody')

    <!-- The Modal -->
    <div class="modal fade" id="CheckResult">
        <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">
                ตรวจสอบผลการสมัคร
            </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <form action="{{ route('check-regist-res') }}" method="POST" id="check_status">
                    @csrf
                <div class="container">
                    <div class="col-sm-12">
                        <label for="selectCourse">
                            เลือกหลักสูตรที่สมัคร :
                        </label>
                        <div class="form-group">
                            <select name="selectCourse" id="selectCourseID" class="form-control" style="width: 100%" required>
                                <option value="" selected="" disabled>--- เลือกหลักสูตร ---</option>
                                @foreach ($course_name as $cn)
                                    <option value="{{ $cn["COURSE_CODE"] }}">
                                        {{ $cn["COURSE_NAME_TH"] }}
                                        @if ($cn["COURSE_TYPE"] == "T")
                                            [หลักสูตรเทียบโอน]
                                        @else
                                            [หลักสูตรปกติ]
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="id_card">บัตรประจำตัวประชาชน : </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="id_card" id="id_card_id" placeholder="รหัสบัตรประชาชน 13 หลัก" required>
                            </div>
                    </div>
                </div>
            </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="validate_btn()">ตรวจสอบ</button>
            </div>

        </div>
        </div>
    </div>
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

        $("#chk_status").click(function() {
                $("#CheckResult").modal({
                    backdrop: "static"
                }, 'show');
            });

        function validate_btn() {
            var frm_chk = document.getElementById("check_status");
            var frm_select = frm_chk.elements.namedItem("selectCourse").value;
            var frm_id = frm_chk.elements.namedItem("id_card").value;
            var validate_res = {
                "course":false,
                "id_card":false,
            };
            if (frm_select == "" || frm_select == null) {
                swal("ไม่สามารถตรวจสอบได้ !" , "โปรดเลือกสาขาที่ต้องการตรวจสอบ" , "error");
            } else {
                validate_res["course"] = true;
            }

            if (frm_id == "" || frm_id == null || frm_id.length != 13) {
                swal("ไม่สามารถตรวจสอบได้ !" , "โปรดกรอกรหัสบัตรประชาชนให้ถูกต้อง" , "error");
            } else {
                validate_res["id_card"] = true;
            }

            if (validate_res["course"] == true && validate_res["id_card"] == true) {
                document.getElementById("check_status").submit();
            }
        }
    </script>
    @yield('FncJs')
@endsection
