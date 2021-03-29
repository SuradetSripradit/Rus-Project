@extends('Frontend.master')
@foreach ($unique_course as $course)

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
                            <button class="btn-lg btn-success mx-auto">สมัครเรียน</button>
                        </div>
                    </div>
                    <br>
                </div>
            <br>
        </div>
    </div>
    </section>
@endsection

@section('NewLink')

@endsection

@section('FncJs')

@endsection
@endforeach
