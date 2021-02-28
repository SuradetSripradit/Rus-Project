{{-- {{ dd(Auth::user()->first_create_flag) }} --}}
@extends('backend/master')
@section('TitleName', 'Back-Office [Home]')

@section('GetBody')
    <!-- Masthead [set header]-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0" style="color: black">
                    อยากใส่ไรก็ใส่
                </h1>
                {{-- <h3 class="text-white-50 mx-auto mt-2 mb-5">
                    คณะศึกษาศาสตร์ มหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตบางเขน
                </h3> --}}
                <h4 class="text-black-50 mx-auto mt-2 mb-5">
                    โตแล้ว จะทำไรก็ทำ
                    <br>
                    เรื่องของมึง
                </h4>
            </div>
        </div>
    </header>
@stop
