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
            <td>{{ $anc["EFFT_DATE"] }}</td>
            <td>{{ $anc["EXP_DATE"] }}</td>
            <td>
                <div class="row row-cols-2">
                    <div class="col">
                        <a href="{{ route('Manage-Anouncements.show' , strval($anc['ANC_CODE'])) }}">
                            <button class="btn-sm btn-warning">
                                <i class="fas fa-edit fa-2x" style="color: white"></i>
                            </button>
                        </a>
                    </div>
                    <div class="col">
                        <form action="{{ route('Manage-Anouncements.destroy' , strval($anc['ANC_CODE'])) }}"
                            id="frm_{{ $anc['ANC_CODE'] }}" method="post" class="delete_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" />
                            <i class="fas fa-trash-alt fa-3x" style="cursor: pointer;color: red" onclick="submit('frm_{{ $anc['ANC_CODE'] }}');"></i>
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
    ข้อมูลข่าวประชาสัมพันธ์
@endsection

@section('Add_FormAction')
    <form action="{{ url('Manage-Anouncements') }}" method="POST">
    @endsection

    @section('Add_ModalForm')
        <div class="form-group">
            <label for="prefix_th">
                คำนำหน้าชื่อ (ไทย) :
            </label>
            <input type="text" name="prefix_th" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prefix_en">
                คำนำหน้าชื่อ (อังกฤษ) :
            </label>
            <input type="text" class="form-control" name="prefix_en" required>
        </div>
    @endsection
    {{-- Add Data Modal --}}

    {{-- Update Data Modal --}}
    @section('upd_GetModalHeader')
        แก้ไขข้อมูลคำนำหน้า
    @endsection

    @if ($CheckUpdate == true)
            @section('upd_FormAction')
                    <form action="{{ route('prefix.upd') }}" method="POST">
                @endsection
                @section('upd_ModalForm')
                    <div class="hidden">
                        <input type="hidden" name="prefix_id" value="{{ $returnData["PREFIX_CODE"] }}">
                    </div>
                    <div class="form-group">
                        <label for="prefix_th">
                            คำนำหน้าชื่อ (ไทย) :
                        </label>
                        <input type="text" name="prefix_th" class="form-control" value="{{ $returnData["PREFIX_NAME_TH"] }}" required>
                    </div>
                    <div class="form-group">
                        <label for="prefix_en">
                            คำนำหน้าชื่อ (อังกฤษ) :
                        </label>
                        <input type="text" class="form-control" name="prefix_en" value="{{ $returnData["PREFIX_NAME_EN"] }}" required>
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
