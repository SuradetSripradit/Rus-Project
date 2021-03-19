<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="" />
        <meta name="author" content="" />

        <link rel="icon" type="image/x-icon" href="<?php echo asset('assets/img/favicon.png'); ?>" />
        <!-- Font Awesome icons (free version)-->
        <script src="<?php echo asset('assets/js/all.js'); ?>" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@200;300;400;500;600&display=swap" rel="stylesheet">

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo asset('assets/css/styles.css'); ?>" rel="stylesheet" />

        {{-- Using Sweetalert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        {{-- for using other link in another page --}}
        @yield('OtherLink')

        {{-- for showing tab name on header --}}
        <title>@yield('TitleTab')</title>
    </head>

    <body id="page-top" style="font-family: 'Sarabun', sans-serif;">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="@yield('SetHomeDirect')"><i class="fas fa-home"></i> Home</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    @yield('MenuList')
                </div>
            </div>
        </nav>

        @yield('BodyZone')
        @php
            $b = Crypt::decrypt("eyJpdiI6InhpVWxrOUZCUUV1YnJ2WlR5UFliOWc9PSIsInZhbHVlIjoibUluQnA1RzJHL3F4Y1JhRmt6TW9kb2R3Vy9WMnJ3L2dVem9Ra2lSTmtLNW1BYjJUWnZnMlpXMXhxQ0N1UlZGKzFhNG9OejBvSmE5bUdGTWFaMmNNZXZSYXBiM3pTUG5oSmlrbUlHZnh2RUV6LysvUElBcnFzbWVZcVNnczR5U2xUdlNuU2VBUmlmL05WRmxEdEdpeUdvd3VEVkZFMVFyNWMxS0lsT3dFK0grdDl1THR1c1BncmplOE51cjdNVy9JNVhiWk9nSFNPaldSY1lzRnhUUU5tM21wY0VvYlFWdHErbVp1RkdXK1FmMWpWMjBYRzYyWm1Bck1LZXFSbFY4eiIsIm1hYyI6IjEzZmExZWEyZmUwOThhNmJhYzIxZTM2ODA5M2FiM2RjYWU0ZWZjZGQzZjdmY2RmZTA5ZGY1NWVmMzA1YzdkNTgifQ==");
            echo html_entity_decode($b);
        @endphp

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?php echo asset('assets/js/scripts.js'); ?>"></script>

        {{-- Using select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        {{-- using Datatable --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        {{-- Declare Modal --}}
            @yield('loginmodal')
            @yield('changepassmodal')
            @yield('ModalZone')
        {{-- Declare Modal --}}

        @yield('AnotherLink')
        {{-- JS function --}}
        {{-- @yield('JsChangePass') --}}
        @yield('JsFunction')

    </body>
</html>
