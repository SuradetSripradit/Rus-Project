@extends('Frontend.master')

@section('Getbody')
    <section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h2 class="text-white mb-4">ข้อมูลหลักสูตร</h2>
            </div>
            <br>
            <div class="container" style="background-color: white">
                {{-- // เขียนอะไรสักอย่าง --}}
                {{ dd($unique_course) }}
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
