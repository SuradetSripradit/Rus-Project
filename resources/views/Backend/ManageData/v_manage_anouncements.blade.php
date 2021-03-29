@php
    $md_size = "";
    $btn_add_submit = "manual";
    $btn_upd_submit = "manual";
@endphp
@extends('Backend.ManageData.master')

@section('TitleMenu')
    การจัดการข้อมูลข่าวประชาสัมพันธ์
@endsection

@section('Title_Name')
    ข้อมูลข่าวประชาสัมพันธ์
@endsection

@section('TableHeader')
    <th>ลำดับที่</th>
    <th>ข่าวประชาสัมพันธ์</th>
    <th>วันที่เผยแพร่</th>
    <th>สถานะการเผยแพร่</th>
    <th>การดำเนินการ</th>
@endsection

    @php
        $chk_permission = true;
        $crrRoute = "/Manage-Anouncements";
    @endphp

@section('TableData')
    @php
    $CNT_ROW = 0;
    @endphp
    @foreach ($Data_anouncements as $anc)
        @php
        $CNT_ROW ++;
        @endphp
        <tr>
            <td>{{ $CNT_ROW }}</td>
            <td>{{ $anc["ANC_HEADER"] }}</td>
            <td>{{ date('d-m-Y', strtotime("+543 years", strtotime($anc['EFFT_DATE']))) }}</td>
            <td>{{ date('d-m-Y', strtotime("+543 years", strtotime($anc["EXP_DATE"]))) }}</td>
            <td>
                <div class="col">
                    <form action="{{ route('Manage-Anouncements.destroy' , strval($anc['ANC_CODE'])) }}"
                        id="frm_{{ $anc['ANC_CODE'] }}" method="post" class="delete_form">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE" />
                        <i class="fas fa-trash-alt fa-3x" style="cursor: pointer;color: red" onclick="submit('frm_{{ $anc['ANC_CODE'] }}');"></i>
                    </form>

                </div>
            </td>
        </tr>
    @endforeach
@endsection


{{-- Setting Modal --}}

{{-- Add Data Modal --}}
@section('Add_GetModalHeader')
    ข้อมูลข่าวประชาสัมพันธ์
@endsection

@section('Add_FormAction')
    <form id="add_form_data" action="{{ url('Manage-Anouncements') }}" method="POST" enctype="multipart/form-data">
    @endsection

    @section('Add_ModalForm')
        <div class="form-group">
            <label for="anc_header">
                หัวข้อข่าวประชาสัมพันธ์ :
            </label>
            <input type="text" name="anc_header" class="form-control" maxlength="500" placeholder="ระบุหัวข้อข่าว" required>
        </div>
        <div class="form-group">
            <label for="anc_detail">
                เนื้อหาข่าวประชาสัมพันธ์ :
            </label>
            <textarea name="anc_detail" class="form-control" cols="30" rows="5" maxlength="2000" placeholder="เนื้อหาข่าวประชาสัมพันธ์" required></textarea>
        </div>
        <div class="form-group">
            <label for="anc_link">
                โปสเตอร์ข่าว : <div style="color: red">* เฉพาะไฟล์รูปเท่านั้น</div>
            </label>
            <div class="custom-file">
                <input type="file" name="PromoteImage" class="custom-file-input" id="promote_image" onchange="SetImageFlag()">
                <label class="custom-file-label" for="anc_file_id">เพิ่มรูปโปสเตอร์</label>
            </div>
        </div>
        <div class="form-group">
            <label for="anc_promote_image">
                แสดงภาพโปรโมทในหน้าหลัก :
            </label>
            <select id="anc_promote_image_id" name="anc_promote_image" class="custom-select" disabled>
                <option disabled selected="">--- เลือกประเภทการแสดงผลภาพ ---</option>
                <option value="Y">แสดงภาพในหน้าหลัก</option>
                <option value="N">ไม่แสดงภาพในหน้าหลัก</option>
            </select>
        </div>
        <div class="form-group">
            <label for="anc_tag">
                หมวดหมู่ข่าวประชาสัมพันธ์ :
            </label>
            <select id="anc_tag_id" name="anc_tag" class="custom-select" required>
                <option selected disabled="" value="">-- เลือกหมวดหมู่ข่าวประชาสัมพันธ์ --</option>
                @foreach ($Hashtag as $tag)
                    <option value="{{ $tag["ANC_TAG"] }}">{{ $tag["ANC_TAG"] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="anc_file_type">
                ประเภทเอกสารแนบ :
            </label>
            <select id="anc_file_type" name="anc_file_type_list" class="custom-select" onchange="ShowANCFileList()" required>
                <option selected disabled="" value="">-- เลือกประเภทเอกสารแนบ --</option>
                <option value="A">ทั้งไฟล์ และ ลิงค์</option>
                <option value="F">เฉพาะไฟล์</option>
                <option value="L">เฉพาะลิงค์</option>
                <option value="N">ไม่มีเอกสารแนบ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="anc_link">
                เอกสารแนบ :
            </label>
            <input type="text" id="anc_link_id" name="anc_link" class="form-control" maxlength="500" placeholder="ลิงค์เอกสารแนบ" disabled>
            <br>
            <div class="custom-file">
                <input type="file" name="anc_file" class="custom-file-input" id="anc_file_id" disabled>
                <label class="custom-file-label" for="anc_file_id">เพิ่มเอกสาร</label>
            </div>
        </div>
        <div class="form-group">
            <label for="anc_promote_image">
                วันที่แสดงข่าวประชาสัมพันธ์ :
            </label>
            <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime("+543 years", strtotime(date('Y-m-d')))) }}" id="efft_date_id" name="efft_date">
        </div>
        <div class="form-group">
            <label for="anc_promote_image">
                วันที่สิ้นสุดข่าวประชาสัมพันธ์ :
            </label>
            <select id="exp_type_date_id" name="exp_type_date" class="custom-select" onchange="checkExpDate()" required>
                <option value="Y" selected>ระบุวันที่สิ้นสุด</option>
                <option value="N">ไม่ระบุวันที่สิ้นสุด</option>
            </select>
            <br>
            <br>
            <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime("+543 years", strtotime(date('Y-m-d')))) }}" id="exp_date_id" name="exp_date">
        </div>
    @endsection

@section('manual_add_btn')
    <button type="button" class="btn-lg btn-success" onclick="validate_add_form('add_form_data')">บันทึก</button>
    <button type="button" class="btn-lg btn-danger" data-dismiss="modal">ปิด</button>
@endsection
{{-- Add Data Modal --}}

{{-- Update Data Modal --}}
@section('upd_GetModalHeader')
    ข่าวประชาสัมพันธ์
@endsection

@section('ExternalJS')
    <script>


        function ShowANCFileList() {
            var option_val = document.getElementById("anc_file_type").value;
            if (option_val == "N") {
                document.getElementById("anc_link_id").disabled = true;
                document.getElementById("anc_file_id").disabled = true;
            } else if(option_val == "F"){
                document.getElementById("anc_link_id").disabled = true;
                document.getElementById("anc_file_id").disabled = false;
            } else if(option_val == "L") {
                document.getElementById("anc_link_id").disabled = false;
                document.getElementById("anc_file_id").disabled = true;
            } else if(option_val == "A"){
                document.getElementById("anc_link_id").disabled = false;
                document.getElementById("anc_file_id").disabled = false;
            }
        }

        function SetImageFlag() {
            var ElementsName = document.getElementById("promote_image").value;
            var tmp_file_name = ElementsName.split("\\");
            var length = tmp_file_name.length -1;
            var chk_name = tmp_file_name[length];
            if (chk_name != "") {
                document.getElementById("anc_promote_image_id").disabled = false;
            }
        }

        // function showenableImage() {
        //     var promote_image = document.getElementById("anc_promote_image_id").value;

        //     if (promote_image == "N") {
        //         document.getElementById("promote_image").disabled = true;
        //     } else if (promote_image == "Y") {
        //         document.getElementById("promote_image").disabled = false;
        //     }
        // }

        function checkExpDate() {
            var exp_date_list = document.getElementById("exp_type_date_id").value;

            if (exp_date_list == "N") {
                document.getElementById("exp_date_id").disabled = true;
            } else if (exp_date_list == "Y") {
                document.getElementById("exp_date_id").disabled = false;
            }
        }

        function validate_add_form(GetFormID) {
            var formData = document.getElementById(GetFormID);
            var crr_date = "{{ date('Y-m-d') }}";
        // set form element
            // validate file type
            var file_type_list = formData.elements.namedItem("anc_file_type_list").value;
            var file_type_desc = formData.elements.namedItem("anc_file").value;
            var link_type_desc = formData.elements.namedItem("anc_link").value;

            // validate image promote
            var image_promote_list = formData.elements.namedItem("anc_promote_image").value;
            var image_promote_desc = formData.elements.namedItem("PromoteImage").value;

            // validate efft_date and exp_date
            var efft_date = formData.elements.namedItem("efft_date").value;
            var exp_flag = formData.elements.namedItem("exp_type_date").value;
            var exp_date = formData.elements.namedItem("exp_date").value;
        // set result form
            var valid_file = false , valid_image = false , valid_date = false;
            console.log(formData.elements.namedItem("anc_tag").value);

            if (
                formData.elements.namedItem("anc_header").value == "" ||
                formData.elements.namedItem("anc_detail").value == ""
            ) {
                swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเพิ่มข้อมูลหัวข้อและเนื้อหาของข่าวประชาสัมพันธ์ !" , "error");
            } else if(formData.elements.namedItem("anc_tag").value == ""){
                swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเลือกหมวดหมู่ข่าวประชาสัมพันธ์ !" , "error");
            } else if (formData.elements.namedItem("anc_file_type_list").value == "") {
                swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเลือกประเภทเอกสารแนบ !" , "error");
            } else {
                // validate file
                if (file_type_list == "A" && (file_type_desc =="" || link_type_desc == "")) {
                    swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเพิ่มข้อมูลไฟล์แนบและลิงค์แนบให้ครบถ้วน !" , "error");
                } else if (file_type_list == "F" && file_type_desc == "") {
                    swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเพิ่มข้อมูลไฟล์แนบให้ครบถ้วน !" , "error");
                } else if (file_type_list == "L" && link_type_desc == "") {
                    swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเพิ่มข้อมูลลิงค์แนบให้ครบถ้วน !" , "error");
                } else{
                    valid_file = true;
                }

                // validate image
                if (image_promote_desc != "" && image_promote_list == "") {
                    swal("ไม่สามารถเพิ่มข้อมูลได้" , "โปรดเลือกประเภทการแสดงภาพโปรโมทให้ครบถ้วน !" , "error");
                } else {
                    valid_image = true;
                }



                // validate date
                if (exp_flag == "Y") {
                    if (efft_date == exp_date) {
                            swal("ไม่สามารถเพิ่มข้อมูลได้" , "วันที่แสดงข่าว และ วันที่สิ้นสุด ไม่สามารถเป็นค่าเดียวกันได้ !" , "error");
                    } else {
                        valid_date = true;
                    }
                } else {
                    valid_date = true;
                }
            // set attribute form
                if (valid_file == true && valid_image == true && valid_date == true) {
                    formData.submit();
                }
            }
        }

        function submit(FormID) {
            swal({
                    title: "ต้องการลบข้อมูลใช่หรือไม่?",
                    text: "การลบข้อมูลนี้จะทำให้ข้อมูลนี้หายไปจากระบบทั้งหมด",
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
