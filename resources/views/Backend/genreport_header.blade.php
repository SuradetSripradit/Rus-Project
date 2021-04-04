@foreach ($tmp_course as $data)
        <div class="container">
            <div class="col-sm-12" style="text-align: center;font-weight: bold;">
                รายนามนักศึกษาที่ได้รับอนุมัติในการสมัครรอบโควต้า
                <br>
                คณะวิทยาศาสตร์และเทคโนโลยี
                <br>
                สาขาวิชา{{ $data["COURSE_NAME_TH"] }}
                @if ($data["COURSE_TYPE"] == "T")
                    (หลักสูตร 2 ปี)
                @else
                    (หลักสูตร 4 ปี)
                @endif
                <br>
                จำนวน {{ $tmp_count }} คน
            </div>
        </div>
    @endforeach
