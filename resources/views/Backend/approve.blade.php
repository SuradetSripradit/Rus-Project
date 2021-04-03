@extends('Backend.master')

@section('TitleName')
    ระบบอนุมัติใบสมัคร
@endsection

@section('GetBody')
<section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h2 class="text-white mb-4">
                    ระบบอนุมัติใบสมัครของผู้สมัคร
                </h2>
                {{-- Accordian Data in page --}}
                <div id="ac_title">
                    <div class="card">
                        <div id="cl_title2" class="collapse show" data-parent="#ac_title">
                            <div class="card-body">
                                {{-- Show Data In page --}}
                                    <table id="TabData" class="display nowrap text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อ - นามสกุล ผู้สมัคร</th>
                                                <th>สาขาที่สมัคร</th>
                                                <th>หลักสูตร</th>
                                                <th>การดำเนินการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $cnt = 0;
                                            @endphp
                                            @foreach ($profile as $pf)

                                            @php
                                                $cnt ++;
                                            @endphp
                                                <tr>
                                                    <td>{{ $cnt }}</td>
                                                    <td class="text-left">{{ $pf->PREFIX_NAME_TH }} {{ $pf->FIRST_NAME_TH }} {{ $pf->LAST_NAME_TH }}</td>
                                                    <td class="text-left">{{ $pf->COURSE_NAME_TH }}</td>
                                                    <td>
                                                        @if ($pf->COURSE_TYPE == "T")
                                                            หลักสูตรเทียบโอน
                                                        @elseif ($pf->COURSE_TYPE == "R")
                                                            หลักสูตรปกติ
                                                        @else
                                                            ไม่พบข้อมูล
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-user-edit fa-2x"
                                                            onmouseover=""
                                                            style="cursor: pointer;"
                                                            data-toggle="modal"
                                                            data-target="#md_appr_{{ $pf->APPLICATION_CODE }}">
                                                        </i>
                                                    </td>
                                                </tr>
                                                <!-- The Modal -->
                                                <div class="modal fade" id="md_appr_{{ $pf->APPLICATION_CODE }}">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">อนุมัติใบสมัคร</h4>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body text-left">
                                                        {{-- ข้อมูลผู้แนะนำ --}}
                                                        <div class="col-sm-12 mx-auto text-left"><b>ข้อมูลเจ้าหน้าที่ที่แนะนำ : </b></div>
                                                        <br>
                                                        <div class="container">
                                                            <div class="col-sm-12">
                                                                <label for="selectPersonnelID">
                                                                    อาจารย์ / เจ้าหน้าที่ ที่แนะนำ :
                                                                </label>
                                                                <input type="text" disabled class="form-control" value="{{ $pf->PERSON_NAME }}">
                                                            </div>
                                                        </div>

                                                    {{-- ข้อมูลผู้สมัคร --}}
                                                        <br>
                                                        <div class="col-sm-12 mx-auto text-left"><b>ข้อมูลทั่วไปของผู้สมัคร : </b></div>
                                                        <br>
                                                        <div class="container">
                                                            <div class="col-sm-12">
                                                                <label for="regist_name_thai">ชื่อ - นามสกุลผู้สมัคร : (ไทย) </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled value="{{ $pf->PREFIX_NAME_TH }} {{ $pf->FIRST_NAME_TH }} {{ $pf->LAST_NAME_TH }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="regist_name_eng">ชื่อ - นามสกุลผู้สมัคร :  (อังกฤษ)</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="{{ $pf->PREFIX_NAME_EN }} {{ $pf->FIRST_NAME_EN }} {{ $pf->LAST_NAME_EN }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="id_card">บัตรประจำตัวประชาชน : </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled value="{{ $pf->ID_CARD_NUMBER }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="prefixID">
                                                                    เพศ :
                                                                </label>
                                                                @if ($pf->GENDER == "M")
                                                                    <input type="text" class="form-control" disabled value="เพศชาย">
                                                                @else
                                                                    <input type="text" class="form-control" disabled value="เพศหญิง">
                                                                @endif

                                                            </div>
                                                        </div>
                                                    {{-- ข้อมูลการศึกษา --}}
                                                        <br>
                                                        <div class="col-sm-12 mx-auto text-left"><b>ข้อมูลการศึกษา : </b></div>
                                                        <br>
                                                        <div class="container">
                                                            <div class="col-sm-12">
                                                                <label for="learning_level">
                                                                    ระดับการศึกษา :
                                                                </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled value="{{ $pf->CLASS_LEVEL_NAME_TH }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="school">
                                                                    สถานศึกษา :
                                                                </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled value="{{ $pf->SCHOOL_NAME_TH }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="gpa">
                                                                    คะแนนเฉลี่ย :
                                                                </label>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" disabled value="{{ $pf->GPA }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{-- ข้อมูลการติดต่อ --}}
                                                    <br>
                                                    <div class="col-sm-12 mx-auto text-left"><b>ข้อมูลการติดต่อ : </b></div>
                                                    <br>
                                                    <div class="container">
                                                        <div class="col-sm-12">
                                                            <label for="LineID">
                                                                ไอดีไลน์ :
                                                            </label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" disabled value="{{ $pf->LINE_ID }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="telephone">
                                                                เบอร์โทรศัพท์ :
                                                            </label>
                                                            <div class="form-group">
                                                                <input type="tel" class="form-control" disabled value="{{ $pf->TELEPHONE }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="email">
                                                                อีเมล์ :
                                                            </label>
                                                            <div class="form-group">
                                                                <input type="email" class="form-control" disabled value="{{ $pf->EMAIL }}">
                                                            </div>
                                                        </div>

                                                    {{-- อนุมัติการสมัคร --}}
                                                    <br>
                                                    <div class="col-sm-12 text-left"><b>อนุมัติการสมัคร : </b></div>
                                                    <br>
                                                        <form action="{{ route('approve.submit') }}" id="frm_appr_{{ $pf->APPLICATION_CODE }}" method="POST">
                                                                {{ csrf_field() }}
                                                            <input type="hidden" name="application_code" value="{{ $pf->APPLICATION_CODE }}">
                                                            <select name="app_res" id="app_res_{{ $pf->APPLICATION_CODE }}" class="form-control">
                                                                <option value="" disabled="" selected="">-- เลือกผลการสมัคร --</option>
                                                                <option value="Y">อนุมัติการสมัคร</option>
                                                                <option value="N">ไม่อนุมัติการสมัคร</option>
                                                            </select>
                                                        </form>
                                                    </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" onclick="ValidateStatus('frm_appr_{{ $pf->APPLICATION_CODE }}')">บันทึกข้อมูล</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                {{-- Show Data In page --}}
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Accordian Data in page --}}
            </div>
        </div>
    </div>
</section>
@endsection

@section('WizardDataModel')

@endsection

@section('AnotherLinkUse')

@endsection

@section('FunctionJs')
<script>
    $(document).ready(function() {
        $('#TabData').DataTable({
            "scrollX": true,
            "scrolly": true,
            "sorting": false,
            "searching": false,
        });
    });

    function CloseModal(Path) {
        window.location.href = Path;
    }

    function ValidateStatus(formID) {
        var form_code = document.getElementById(formID);

        var selectBox = form_code.elements.namedItem("app_res").value;

        if (selectBox == "" || selectBox == null) {
            swal("ไม่สามารถอนุมัติได้ !" , "โปรดเลือกผลการสมัครของผู้สมัคร" , "error");
        } else {
            document.getElementById(formID).submit();
        }
    }
</script>
@endsection
