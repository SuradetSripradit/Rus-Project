@extends('Frontend.master')
@foreach ($unique_course as $course)

@php
    $chk_course_type = $course["COURSE_TYPE"];
@endphp

    @section('TitleTabName')
    {{ $course["COURSE_NAME_TH"] }}
        @if ($course["COURSE_TYPE"] == "T")
            หลักสูตรเทียบโอน
        @elseif ($course["COURSE_TYPE"] == "R")
            หลักสูตรปกติ
        @endif
    @endsection


    @section('Getbody')
        <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                {{-- {{ dd($unique_course) }} --}}
                    <div class="col-lg-12 mx-auto">
                        @php
                            if ($course["IMAGE_UPLOAD_DET"] == "" or $course["IMAGE_UPLOAD_DET"] == null) {
                                $img = "00000-NoImage.jpg";
                            } else {
                                $img = $course["IMAGE_UPLOAD_DET"];
                            }
                        @endphp
                        <h3 class="text-white mb-4">สาขาวิชา {{ $course["COURSE_NAME_TH"] }} <br> [ {{ $course["COURSE_NAME_EN"] }} ]</h3>
                    </div>
                    <br>
                    <div class="container" style="background-color: white">
                        <br>
                        <img src="{{ url('promote-image/' . $img) }}" style="width: 100%;height: 300px;">
                        <div class="container">
                            <br>
                            <div class="col-sm-12">
                                <div class="text-left">{{ $course["DESCRIPTION_DETAIL"] }}</div>
                            </div>
                            @php
                                $learning = explode("<br>" , $course["LEARNING_LIST"]);
                                $qualification = explode("<br>" , $course["QUALIFICATION_REQ"]);
                            @endphp
                                <br>
                            <div class="col-sm-12 text-left">
                                <b>รายวิชาของหลักสูตร : </b>
                                <br>
                                @foreach ($learning as $learn)
                                    <div class="container mx-auto">{{ $learn }}</div>
                                @endforeach
                            </div>
                                <br>
                            <div class="col-sm-12 text-left">
                                <b>คุณสมบัติของผู้สมัคร : </b>
                                <br>
                                @foreach ($qualification as $qualified)
                                    <div class="container mx-auto">{{ $qualified }}</div>
                                @endforeach
                            </div>
                            <div class="col-sm-12 text-center">
                                <br>
                                <button class="btn-lg btn-success mx-auto" id="ShowVerify">สมัครเรียน</button>
                            </div>
                        </div>
                        <br>
                    </div>
                <br>
            </div>
        </div>
        </section>

        {{-- Verify Modal  --}}
        <div class="modal fade" id="Verify_register">
            <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                <h5 class="modal-title">การตรวจสอบคุณสมบัติผู้สมัคร</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="DataVerify" value="{{ $chk_course_type }}" disabled>
                        <label for="class_level_register">
                            ระดับการศึกษาที่จบ :
                        </label>
                        <select name="class_level_register" id="class_level_register_id" class="form-control" style="width: 100%" required>
                            @foreach ($class_level as $cl)
                                <option value="{{ $cl["CLASS_LEVEL_CODE"] }}">{{ $cl["CLASS_LEVEL_NAME_TH"] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" onclick="VerifyRegister()">ตรวจสอบคุณสมบัติ</button>
                    <button type="button" class="btn-sm btn-danger" data-dismiss="modal">ยกเลิกการตรวจสอบคุณสมบัติ</button>
                </div>

            </div>
            </div>
        </div>
        {{-- Verify Modal  --}}

        {{-- Register Modal  --}}
        <div class="modal fade" id="Register_Modal">
            <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                <h5 class="modal-title">การตรวจสอบคุณสมบัติผู้สมัคร</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Test
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" onclick="">ตรวจสอบคุณสมบัติ</button>
                    <button type="button" class="btn-sm btn-danger" data-dismiss="modal">ยกเลิกการตรวจสอบคุณสมบัติ</button>
                </div>

            </div>
            </div>
        </div>
        {{-- Register Modal  --}}
    @endsection

    @section('NewLink')

    @endsection

    @section('FncJs')
        <script>
            $("#ShowVerify").click(function() {
                $("#Verify_register").modal({
                    backdrop: "static"
                }, 'show');
            });

            function VerifyRegister() {
                var chk_type = document.getElementById("DataVerify").value;
                var selectData = document.getElementById("class_level_register_id").value;

                if (chk_type == "T") {
                    if (selectData != "02") {
                        swal("ล้มเหลว!", "ระดับการศึกษาที่จบยังไม่สามารถสมัครสาขานี้ได้ โปรดเลือกใหม่อีกครั้ง", "warning");
                    } else {
                        $("#Verify_register").modal('hide');

                        $("#Register_Modal").modal({
                            backdrop: "static"
                        }, 'show');
                    }
                } else {

                }
            }
        </script>
    @endsection
@endforeach
