@extends('Frontend.master')

@section('TitleTabName' , "ข่าวประชาสัมพันธ์")

@section('Getbody')
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="col-sm-12">
                <h3 class="text-center text-white">ข่าวประชาสัมพันธ์</h3>
            {{-- header --}}
            {{-- anouncementsHeader --}}
                {{-- <div class="card"> --}}
                    @for ($i = 0; $i < count($anouncementsHeader); $i++)
                        <div class="card-deck mx-2 mb-2" >
                            @foreach ($anouncementsHeader[$i] as $anc)
                                <div class="card" onclick="ShowAnouncements('#md_anounce_{{ $anc->ANC_CODE }}')" onmouseover="" style="cursor: pointer;">
                                    <div class="card-body text-center">
                                        {{-- <img src="{{ asset('/assets/img/PromoteCourse/00001-SEA.jpg') }}" style="width: 100%;height: 100px;"> --}}
                                        @php
                                            if ($anc->IMG_NAME == "" or $anc->IMG_NAME == null) {
                                                $img = "00000-NoImage.jpg";
                                            } else {
                                                $img = $anc->IMG_NAME;
                                            }
                                        @endphp
                                        <img src="{{ url('GetImage/' . $img) }}" style="width: 100%;height: 100px;">
                                        <p class="card-text text-left">{{ $anc->ANC_HEADER }}</p>
                                    </div>
                                    <div class="card-footer text-right">
                                        <i class="text-black-50" style="font-size:14px">โพสต์เมื่อ {{ date('d-m-Y', strtotime("+543 years", strtotime(date('d-m-Y')))) }}</i>
                                    </div>
                                </div>

                                <!-- The Modal -->
                                    <div class="modal fade" id="md_anounce_{{ $anc->ANC_CODE }}">
                                        <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $anc->ANC_HEADER }}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body text-left">
                                                <b>เนื้อหา : </b>{{ $anc->ANC_HEADER }}
                                            </div>

                                            <div class="modal-footer text-right">
                                                @if ($anc->FILE_FLAG != null or $anc->FILE_FLAG != "" )
                                                    @if ($anc->FILE_FLAG == 'A')
                                                        <a href="{{ $anc->ANC_LINK }}" target="_blank" class="btn-sm btn-warning">เข้าสู่ลิงค์</a>
                                                        <a href="#" class="btn-sm btn-success" target="_blank">ดาวน์โหลดเอกสารแนบ</a>
                                                    @elseif($anc->FILE_FLAG == 'L')
                                                        <a href="{{ $anc->ANC_LINK }}" class="btn-sm btn-warning">เข้าสู่ลิงค์</a>
                                                    @elseif ($anc->FILE_FLAG == 'F')
                                                        <a href="#" class="btn-sm btn-success">ดาวน์โหลดเอกสารแนบ</a>
                                                    @endif
                                                @else

                                                @endif

                                            </div>

                                        </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    @endfor
                {{-- </div> --}}
            </div>
        </div>
    </section>
@endsection

{{-- {{ dd($anouncementsHeader) }} --}}
@section('FncJs')
    <script>
        function ShowAnouncements(GetMdCode) {
            $(function() {
                    $(GetMdCode).modal({
                        backdrop: "static"
                    }, 'show');
                });
        }
    </script>
@endsection
