@php
    $md_size = "";
    $btn_add_submit = "";
    $btn_upd_submit = "";
@endphp
@extends('Backend.ManageData.master')

@section('TitleMenu')
    การจัดการข้อมูลสถานศึกษา
@endsection

@section('Title_Name')
    ข้อมูลสถานศึกษา
@endsection

@section('TableHeader')
    <th>ลำดับที่</th>
    <th>สถานศึกษา (ไทย)</th>
    <th>สถานศึกษา (อังกฤษ)</th>
    <th>การกระทำ</th>
@endsection

    @php
        $chk_permission = true;
        $crrRoute = "/Manage-School";
    @endphp

@section('TableData')
    @php
    $CNT_ROW = 0;
    @endphp
    @foreach ($Data_school as $school)
        @php
        $CNT_ROW ++;
        @endphp
        <tr>
            <td>{{ $CNT_ROW }}</td>
            <td>{{ $school["SCHOOL_NAME_TH"] }}</td>
            <td>{{ $school["SCHOOL_NAME_EN"] }}</td>
            <td>
                <div class="row row-cols-2">
                    <div class="col">
                        <a href="{{ route('Manage-School.show' , strval($school['SCHOOL_CODE'])) }}">
                            <button class="btn-sm btn-warning">
                                <i class="fas fa-edit fa-2x" style="color: white"></i>
                            </button>
                        </a>
                        {{-- <i class="fas fa-edit fa-3x" style="color: white"></i> --}}
                    </div>
                    <div class="col">
                        <form action="{{ route('Manage-School.destroy' , strval($school['SCHOOL_CODE'])) }}"
                            id="frm_{{ $school['SCHOOL_CODE'] }}" method="post" class="delete_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" />
                            <i class="fas fa-trash-alt fa-3x" style="cursor: pointer;color: red" onclick="submit('frm_{{ $school['SCHOOL_CODE'] }}');"></i>
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
    ข้อมูลสถานศึกษา
@endsection

@section('Add_FormAction')
    <form action="{{ url('Manage-School') }}" method="POST">
    @endsection

    @section('Add_ModalForm')
        <div class="form-group">
            <label for="school_th">
                สถานศึกษา (ไทย) :
            </label>
            <input type="text" name="school_th" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="school_en">
                สถานศึกษา (อังกฤษ) :
            </label>
            <input type="text" class="form-control" name="school_en" required>
        </div>
    @endsection
    {{-- Add Data Modal --}}

    {{-- Update Data Modal --}}
    @section('upd_GetModalHeader')
        แก้ไขข้อมูลสถานศึกษา
    @endsection

    @if ($CheckUpdate == true)
            @section('upd_FormAction')
                    <form action="{{ route('school.upd') }}" method="POST">
                @endsection
                @section('upd_ModalForm')
                    <div class="hidden">
                        <input type="hidden" name="school_id" value="{{ $returnData["SCHOOL_CODE"] }}">
                    </div>
                    <div class="form-group">
                        <label for="school_th">
                            สถานศึกษา (ไทย) :
                        </label>
                        <input type="text" name="school_th" class="form-control" value="{{ $returnData["SCHOOL_NAME_TH"] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="school_en">
                            คำนำหน้าชื่อ (อังกฤษ) :
                        </label>
                        <input type="text" class="form-control" name="school_en" value="{{ $returnData["SCHOOL_NAME_EN"] }}" required>
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
                    text: "การลบข้อมูลนี้จะทำให้สถานศึกษานี้หายไปจากระบบทั้งหมด",
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
