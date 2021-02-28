@extends('layout/master')
@section('menulist')
    <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" style="color :black" href=" ">
                หน้าหลัก 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" style="color :black" href=" ">
                ประกาศ
            </a>
        </li>
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" style="color :black">หลักสูตร</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href=" "> หลักสูตรวิทยาการคอมพิวเตอร์ </a>
                <a class="dropdown-item" href=" "> หลักสูตรเทคโนโลยีสารสนเทศ </a>
                <a class="dropdown-item" href=" "> หลักสูตรเทคโนโลยีมัติมีเดีย </a>
            </div>
        </div>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" style="color :black" href=" "> 
                เข้าสู่ระบบ 
            </a>
        </li>
    </ul>
@endsection

@section('BodyZone')

    @yield('Getbody')

@endsection

@section('JsFunction')
@yield('js')

@endsection