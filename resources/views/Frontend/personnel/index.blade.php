@extends('Frontend.master')

@section('TitleTabName')
ข้อมูลบุคลากร
@endsection

@section('Getbody')
    <section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h2 class="text-white mb-4">รายชื่อบุคลากร</h2>
            </div>
            <br>
            <div class="container" >
                @for ($i = 0; $i < count($personnel); $i++)
                    <div class="card-deck mx-2 mb-2" >
                        @foreach ($personnel[$i] as $psn)
                            <div class="card" onmouseover="" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    @php
                                        if ($psn->FILE_NAME == NULL or $psn->FILE_NAME == "") {
                                            $genFileName = "00000-NoImage.jpg";
                                        } else {
                                            $genFileName = $psn->FILE_NAME;
                                        }

                                    @endphp
                                    <img src="{{ url('personnel/' . $genFileName) }}" style="width: 50%;height: 150px;">
                                    <p class="card-text text-left">
                                        <b>ชื่อ : </b>{{ $psn->PREFIX_NAME_TH }} {{ $psn->NAME_TH }}
                                        {{-- <br>
                                        <b>ชื่อ (อังกฤษ) :</b> {{ $psn->PREFIX_NAME_EN }} {{ $psn->NAME_EN }} --}}
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <i class="text-black-50" style="font-size:14px">{{ $psn->POSITION_DESC_TH }}</i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor
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
