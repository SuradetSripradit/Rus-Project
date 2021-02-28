@extends('Backend.ManageData.master')

@section('TitleMenu')
    การจัดการข้อมูลหลักสูตร
@endsection

@section('Title_Name')
    ข้อมูลหลักสูตร
@endsection

@section('TableHeader')
    <th>ลำดับที่</th>
    <th>ชื่อหลักสูตร</th>
    <th>ประเภทหลักสูตร</th>
    <th>วันที่เรียน</th>
    <th>การกระทำ</th>
@endsection

    @php
        $chk_permission = true;
        $crrRoute = "/Manage-Course";
    @endphp

@section('TableData')
    @php
    $CNT_ROW = 0;
    @endphp
    @foreach ($DataCourse as $course)
        @php
        $CNT_ROW ++;
        @endphp
        <tr>
            <td>{{ $CNT_ROW }}</td>
            <td>{{ $course["COURSE_NAME_TH"] }}</td>
            <td>
                @if ($course["COURSE_TYPE"] == "T")
                    หลักสูตรเทียบโอน
                @elseif ($course["COURSE_TYPE"] == "R")
                    หลักสูตรปกติ
                @endif
            </td>
            <td>
                @if ($course["LEARNING_DATE_TYPE"] == "A")
                    ภาคปกติ และ ภาคพิเศษ
                @elseif ($course["LEARNING_DATE_TYPE"] == "S")
                    ภาคพิเศษ
                @elseif ($course["LEARNING_DATE_TYPE"] == "N")
                    ภาคปกติ
                @endif
            </td>
            <td>
                <div class="row row-cols-2">
                    <div class="col">
                        <a href="{{ route('Manage-Course.show' , strval($course['COURSE_CODE'])) }}">
                            <button class="btn-sm btn-warning">
                                <i class="fas fa-edit fa-2x" style="color: white"></i>
                            </button>
                        </a>
                    </div>
                    <div class="col">
                        <form action="{{ route('Manage-Course.destroy' , strval($course['COURSE_CODE'])) }}"
                            id="frm_{{ $course['COURSE_CODE'] }}" method="post" class="delete_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" />
                            <i class="fas fa-trash-alt fa-3x" style="cursor: pointer;color: red" onclick="submit('frm_{{ $course['COURSE_CODE'] }}');"></i>
                        </form>

                    </div>
                </div>
            </td>
        </tr>
    @endforeach
@endsection


{{-- Setting Modal --}}

{{-- Add Data Modal --}}
@section('Add_GetModalHeader')
    ข้อมูลหลักสูตร
@endsection

@section('Add_FormAction')
    <form action="{{ url('Manage-Course') }}" method="POST" enctype="multipart/form-data">
    @endsection

    @section('Add_ModalForm')
        <div class="form-group">
            <label for="course_type">
                ประธานหลักสูตร :
            </label>
            <select name="personOfCourse" id="psnOCourse" class="form-control Select2Class" style="width: 100%" required>
                <option selected="" disabled value=""></option>
                @foreach ($personOfCourse as $psCourse)
                    <option value="{{ $psCourse["PERSONNEL_CODE"] }}">{{ $psCourse["NAME_TH"] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="course_th">
                ชื่อหลักสูตร (ไทย) :
            </label>
            <input type="text" name="course_th" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="course_en">
                ชื่อหลักสูตร (อังกฤษ) :
            </label>
            <input type="text" class="form-control" name="course_en" required>
        </div>
        <div class="form-group">
            <label for="Poster_det">
                โปสเตอร์ของหลักสูตร :
                <div style="color: red"><h6>แสดงในหน้าแนะนำหลักสูตร</h6></div>
            </label>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile" required>
                <label class="custom-file-label" for="chooseFile">เลือกภาพ</label>
            </div>
        </div>

        <div class="form-group">
            <label for="course_type">
                ประเภทของหลักสูตร :
            </label>
            <select name="course_type" id="opt_course_type" class="form-control Select2Class" style="width: 100%" required>
                <option selected="" disabled value=""></option>
                <option value="T">หลักสูตรเทียบโอน</option>
                <option value="R">หลักสูตรปกติ</option>
            </select>
        </div>

        <div class="form-group">
            <label for="course_type">
                ระยะเวลาเรียน :
            </label>
            <select name="LearningTime" id="ln_Time" class="form-control Select2Class" style="width: 100%" required>
                <option selected="" disabled value=""></option>
                <option value="A">ทั้งปกติและพิเศษ</option>
                <option value="S">เวลาเรียนพิเศษ (เสาร์ - อาทิตย์)</option>
                <option value="N">เวลาเรียนปกติ (จันทร์ - ศุกร์)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="course_description">
                คำอธิบายหลักสูตร (พอสังเขป) :
            </label>
            <textarea name="course_description" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="อธิบายหลักสูตร" required></textarea>
        </div>
        <div class="form-group">
            <label for="learning_list">
                รายวิชาหลักของหลักสูตร :
                <div style="color: red"><h6>ระบุเป็นข้อ เช่น - วิชาคอมพิวเตอร์เบื้องต้น</h6></div>
            </label>
            <textarea name="learning_list" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="วิชาหลักของหลักสูตร" required></textarea>
        </div>
        <div class="form-group">
            <label for="qualification_req">
                คุณสมบัติเบื้องต้นของผู้สมัคร :
                <div style="color: red"><h6>ระบุเป็นข้อ เช่น - จบการศึกษาระดับ ม.6</h6></div>
            </label>
            <textarea name="qualification_req" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="คุณสมบัติเบื้องต้นของผู้สมัคร" required></textarea>
        </div>
    @endsection
    {{-- Add Data Modal --}}

    {{-- Update Data Modal --}}
    @section('upd_GetModalHeader')
        แก้ไขข้อมูลหลักสูตร
    @endsection

    @if ($CheckUpdate == true)
            @section('upd_FormAction')
                    <form action="{{ route('course.upd') }}" method="POST">
                @endsection
                @section('upd_ModalForm')
                        <input type="hidden" name="course_code" value="{{ $returnData["COURSE_CODE"] }}">
                        <div class="form-group">
                            <label for="course_type">
                                ประธานหลักสูตร :
                            </label>
                            <select name="personOfCourse" id="psnOCourse" class="form-control Select2Class" style="width: 100%" required>
                                <option selected="" disabled value=""></option>

                                @foreach ($personOfCourse as $psCourse)
                                    @if ($returnData["COURSE_HEAD_CODE"] == $psCourse["PERSONNEL_CODE"])
                                        <option value="{{ $psCourse["PERSONNEL_CODE"] }}" selected>{{ $psCourse["NAME_TH"] }}</option>
                                    @else
                                        <option value="{{ $psCourse["PERSONNEL_CODE"] }}">{{ $psCourse["NAME_TH"] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course_th">
                                ชื่อหลักสูตร (ไทย) :
                            </label>
                            <input type="text" name="course_th" class="form-control" value="{{ $returnData["COURSE_NAME_TH"] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="course_en">
                                ชื่อหลักสูตร (อังกฤษ) :
                            </label>
                            <input type="text" class="form-control" name="course_en" value="{{ $returnData["COURSE_NAME_EN"] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Poster_det">
                                โปสเตอร์ของหลักสูตร :
                                <div style="color: red"><h6>แสดงในหน้าแนะนำหลักสูตร</h6></div>
                            </label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                <label class="custom-file-label" for="chooseFile">เลือกภาพ</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="course_type">
                                ประเภทของหลักสูตร :
                            </label>
                            <select name="course_type" id="opt_course_type" class="form-control Select2Class" style="width: 100%" required>
                                <option selected="" disabled value=""></option>
                                @if ($returnData["COURSE_TYPE"] == "R")
                                    <option value="R" selected>หลักสูตรปกติ</option>
                                    <option value="T">หลักสูตรเทียบโอน</option>
                                @elseif ($returnData["COURSE_TYPE"] == "T")
                                    <option value="R">หลักสูตรปกติ</option>
                                    <option value="T" selected>หลักสูตรเทียบโอน</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="course_type">
                                ระยะเวลาเรียน :
                            </label>
                            <select name="LearningTime" id="ln_Time" class="form-control Select2Class" style="width: 100%" required>
                                <option selected="" disabled value=""></option>
                                @if ($returnData["LEARNING_DATE_TYPE"] == "A")
                                    <option value="A" selected>ทั้งปกติและพิเศษ</option>
                                    <option value="S">เวลาเรียนพิเศษ (เสาร์ - อาทิตย์)</option>
                                    <option value="N">เวลาเรียนปกติ (จันทร์ - ศุกร์)</option>
                                @elseif ($returnData["LEARNING_DATE_TYPE"] == "S")
                                    <option value="A">ทั้งปกติและพิเศษ</option>
                                    <option value="S" selected>เวลาเรียนพิเศษ (เสาร์ - อาทิตย์)</option>
                                    <option value="N">เวลาเรียนปกติ (จันทร์ - ศุกร์)</option>
                                @elseif ($returnData["LEARNING_DATE_TYPE"] == "N")
                                    <option value="A">ทั้งปกติและพิเศษ</option>
                                    <option value="S">เวลาเรียนพิเศษ (เสาร์ - อาทิตย์)</option>
                                    <option value="N" selected>เวลาเรียนปกติ (จันทร์ - ศุกร์)</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="course_description">
                                คำอธิบายหลักสูตร (พอสังเขป) :
                            </label>
                            <textarea name="course_description" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="อธิบายหลักสูตร" required>
                                {{ str_replace("<br>" , "\n" , $returnData["DESCRIPTION_DETAIL"]) }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="learning_list">
                                รายวิชาหลักของหลักสูตร :
                                <div style="color: red"><h6>ระบุเป็นข้อ เช่น - วิชาคอมพิวเตอร์เบื้องต้น</h6></div>
                            </label>
                            <textarea name="learning_list" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="วิชาหลักของหลักสูตร" required>
                                {{ str_replace("<br>" , "\n" , $returnData["LEARNING_LIST"]) }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="qualification_req">
                                คุณสมบัติเบื้องต้นของผู้สมัคร :
                                <div style="color: red"><h6>ระบุเป็นข้อ เช่น - จบการศึกษาระดับ ม.6</h6></div>
                            </label>
                            <textarea name="qualification_req" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="คุณสมบัติเบื้องต้นของผู้สมัคร" required>
                                {{ str_replace("<br>" , "\n" , $returnData["QUALIFICATION_REQ"]) }}
                            </textarea>
                        </div>
                @endsection
                {{-- Update Data Modal --}}

        @section('GetFunction')
            <script>
                $(function() {
                    $('#Md_updData').modal({
                        backdrop: "static"
                    }, 'show');
                });

            </script>
        @endsection

    @endif

@section('ExternalJS')
    <script>
        function submit(FormID) {
            swal({
                    title: "ต้องการลบข้อมูลใช่หรือไม่?",
                    text: "การลบข้อมูลนี้จะทำให้ผู้ใช้งานนี้หายไปจากระบบทั้งหมด",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        document.getElementById(FormID).submit();
                    }
                 });
        }
    </script>
@endsection
