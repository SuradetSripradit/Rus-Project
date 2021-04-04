{{-- Set Css Style --}}
<style>
    @page {
        header: html_firstpage;
        margin-top: 2.54cm;
    }
    table, th, td {
        border: 0.5px solid black;
        border-collapse: collapse;
    }
    .center {
        margin-left: auto;
        margin-right: auto;
    }
</style>

{{-- <htmlpageheader name="firstpage">
    <div class="container">
        <div class="col-sm-12" style="text-align: center">
            แบบแจ้งขอรหัสประจำตัวนิสิต
            <br>
            ระดับปริญญาโท
            <br>
            สาขาวิชาการสอนคณิตศาสตร์ (รหัสสาขา XF60) (รอบแรก)
            <br>
            วิทยาเขตบางเขน
            <br>
            จำนวน 1 คน (แผน ข จำนวน 1 คน)
        </div>
    </div>
</htmlpageheader> --}}
{{-- Set Data and layout --}}
<div class="container" style="display:auto">
    <div class="col col-sm-12" style="text-align: center">
        <table class="center" width="100%">
            <thead>
                <tr>
                    <th width="5%">ลำดับที่</th>
                    <th width="35%">ชื่อ-สกุล (ไทย)</th>
                    <th width="20%">เกรดเฉลี่ย</th>
                    <th width="40%">สถานศึกษาเดิม</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cnt = 0;
                @endphp
                @foreach ($tmp_register as $profile)
                @php
                    $cnt++;
                @endphp
                    <tr>
                        <td style="text-align: center">{{ $cnt }}</td>
                        <td>{{ $profile->PREFIX_NAME_TH }} {{ $profile->FIRST_NAME_TH }} {{ $profile->LAST_NAME_TH }}</td>
                        <td style="text-align: center">{{ $profile->GPA }}</td>
                        <td style="text-align: left">{{ $profile->SCHOOL_NAME_TH }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
