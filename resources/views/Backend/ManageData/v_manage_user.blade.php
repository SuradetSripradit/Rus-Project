@php
    $md_size = "";
    $btn_add_submit = "";
    $btn_upd_submit = "";
@endphp
@php
    $crrRoute  = "/Manage-User";
@endphp
@extends('Backend.ManageData.master')

@section('TitleMenu')
    การจัดการบัญชีผู้ใช้งาน
@endsection

@section('Title_Name')
    ข้อมูลบัญชีผู้ใช้งาน
@endsection

@section('TableHeader')
    <th>ลำดับที่</th>
    <th>ชื่อ - สกุล (ไทย)</th>
    <th>ชื่อ - สกุล (อังกฤษ)</th>
    <th>ตำแหน่ง</th>
    <th>ระดับผู้ใช้งาน</th>
    <th>การกระทำ</th>
@endsection

@if (Auth::user()->userType != 0 )
    @php
        $chk_permission = false;
    @endphp
@else
    @php
        $chk_permission = true;
    @endphp

@section('TableData')
    @php
    $CNT_ROW = 0;
    @endphp
    @foreach ($Personnel as $person)
        @php
        $CNT_ROW ++;
        @endphp
        <tr>
            <td>{{ $CNT_ROW }}</td>
            <td>{{ $person->NAME_TH }}</td>
            <td>{{ $person->NAME_EN }}</td>
            <td>
                @foreach ($position as $positionDet)
                    @if ($person->POSITION_CODE == $positionDet["POSITION_CODE"])
                        {{ $positionDet["POSITION_DESC_TH"] }}
                    @endif
                @endforeach
            </td>
            <td>
                @if ($person->user_type == 0)
                    ผู้ดูแลระบบ
                @elseif ($person->user_type == 1)
                    ผู้ใช้งานทั่วไป
                @else
                    ไม่สามารถระบบประเภทผู้ใช้งาน
                @endif
            </td>
            <td>
                <div class="row row-cols-2">
                    <div class="col">
                        <a href="{{ route('Manage-User.show' , strval($person->PERSONNEL_CODE)) }}">
                            <button class="btn-sm btn-warning">
                                <i class="fas fa-edit fa-2x" style="color: white"></i>
                            </button>
                        </a>
                        {{-- <i class="fas fa-edit fa-3x" style="color: white"></i> --}}
                    </div>
                    <div class="col">
                        <form action="{{ route('Manage-User.destroy' , strval($person->PERSONNEL_CODE)) }}"
                            id="frm_{{ $person->PERSONNEL_CODE }}" method="post" class="delete_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" />
                            <i class="fas fa-trash-alt fa-3x" style="cursor: pointer;color: red" onclick="submit('frm_{{ $person->PERSONNEL_CODE }}');"></i>
                        </form>

                    </div>
                </div>
            </td>
        </tr>
    @endforeach
@endsection

@endif


{{-- Setting Modal --}}

{{-- Add Data Modal --}}
@section('Add_GetModalHeader')
    ข้อมูลบัญชีผู้ใช้งาน
@endsection

@section('Add_FormAction')
    <form action="{{ url('Manage-User') }}" method="POST">
    @endsection

    @section('Add_ModalForm')
        <div class="form-group">
            <label for="PrefixName">
                คำนำหน้าชื่อ :
            </label>
            <select name="PrefixName" class="form-control Select2Class" style="width: 100%" required>
                <option value="" selected="" disabled></option>
                @foreach ($prefix as $pf)
                    <option value="{{ $pf["PREFIX_CODE"] }}">{{ $pf["PREFIX_NAME_TH"] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="UserPosition">
                ตำแหน่งของผู้ใช้งาน :
            </label>
            <select name="UserPosition" class="form-control Select2Class" style="width: 100%" required>
                <option value="" selected="" disabled></option>
                @foreach ($position as $ps)
                    <option value="{{ $ps["POSITION_CODE"] }}">{{ $ps["POSITION_DESC_TH"] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="UserType">
                ระดับผู้ใช้งาน :
            </label>
            <select name="UserType" class="form-control Select2Class" style="width: 100%" required>
                <option value="" selected="" disabled></option>
                <option value="0">ผู้ดูแลระบบ</option>
                <option value="1">ผู้ใช้งานทั่วไป</option>
            </select>
        </div>
        <div class="form-group">
            <label for="personnel_name_th">
                ชื่อ - สกุลผู้ใช้งาน (ไทย) : <br> <div style="color: red">เช่น (ทดสอบ ผู้ใช้งาน)</div>
            </label>
            <input type="text" class="form-control" name="personnel_name_th" required>
        </div>
        <div class="form-group">
            <label for="personnel_name_en">
                ชื่อ - สกุลผู้ใช้งาน (อังกฤษ) : <br> <div style="color: red">เช่น (ทดสอบ ผู้ใช้งาน)</div>
            </label>
            <input type="text" class="form-control" name="personnel_name_en" required>
        </div>
        <div class="form-group">
            <label for="personnel_email">
                อีเมล์ :
            </label>
            <input type="email" class="form-control" name="personnel_email" required>
        </div>
    @endsection
    {{-- Add Data Modal --}}

    {{-- Update Data Modal --}}
    @section('upd_GetModalHeader')
        แก้ไขข้อมูลคำนำหน้า
    @endsection


    @if ($CheckUpdate == true)
            @section('upd_FormAction')
                    <form action="{{ route('ProcUpd') }}" method="POST">
                        {{-- <form action="{{ action('App\Http\Controllers\ManageUser\ctl_manage_user@update' , strval($returnData->PERSONNEL_CODE)) }}" method="POST"> --}}
                @endsection

                @section('upd_ModalForm')
                    <div class="hidden">
                        <input type="hidden" name="personnel_id" value="{{ $returnData->PERSONNEL_CODE }}">
                    </div>
                    <div class="form-group">
                        <label for="PrefixName">
                            คำนำหน้าชื่อ :
                        </label>
                        <select name="PrefixName" class="form-control Select2Class" style="width: 100%" required>
                            <option value="" selected="" disabled></option>
                            @foreach ($prefix as $pf)
                                @if ($pf["PREFIX_CODE"] == $returnData->PREFIX_ID)
                                    <option value="{{ $pf["PREFIX_CODE"] }}" selected>{{ $pf["PREFIX_NAME_TH"] }}</option>
                                @else
                                    <option value="{{ $pf["PREFIX_CODE"] }}">{{ $pf["PREFIX_NAME_TH"] }}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="UserPosition">
                            ตำแหน่งของผู้ใช้งาน :
                        </label>
                        <select name="UserPosition" class="form-control Select2Class" style="width: 100%" required>
                            <option value="" selected="" disabled></option>
                            @foreach ($position as $ps)
                                @if ($ps["POSITION_CODE"] == $returnData->POSITION_CODE)
                                    <option value="{{ $ps["POSITION_CODE"] }}" selected>{{ $ps["POSITION_DESC_TH"] }}</option>
                                @else
                                    <option value="{{ $ps["POSITION_CODE"] }}">{{ $ps["POSITION_DESC_TH"] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="UserType">
                            ระดับผู้ใช้งาน :
                        </label>
                        <select name="UserType" class="form-control Select2Class" style="width: 100%" required>
                            @if ($returnData->user_type == "0")
                                <option value="0" selected>ผู้ดูแลระบบ</option>
                                <option value="1">ผู้ใช้งานทั่วไป</option>
                            @else
                                <option value="0">ผู้ดูแลระบบ</option>
                                <option value="1" selected>ผู้ใช้งานทั่วไป</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="personnel_name_th">
                            ชื่อ - สกุลผู้ใช้งาน (ไทย) : <br> <div style="color: red">เช่น (ทดสอบ ผู้ใช้งาน)</div>
                        </label>
                        <input type="text" class="form-control" name="personnel_name_th" value="{{ $returnData->NAME_TH }}" required>
                    </div>
                    <div class="form-group">
                        <label for="personnel_name_en">
                            ชื่อ - สกุลผู้ใช้งาน (อังกฤษ) : <br> <div style="color: red">เช่น (ทดสอบ ผู้ใช้งาน)</div>
                        </label>
                        <input type="text" class="form-control" name="personnel_name_en" value="{{ $returnData->NAME_EN }}" required>
                    </div>
                    <div class="form-group">
                        <label for="personnel_email">
                            อีเมล์ :
                        </label>
                        <input type="email" class="form-control" name="personnel_email" value="{{ $returnData->email }}" required>
                    </div>
                @endsection
                {{-- Update Data Modal --}}
        {{-- @endforeach --}}

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
