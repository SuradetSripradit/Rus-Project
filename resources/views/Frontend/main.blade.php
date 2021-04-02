@extends('Frontend/master')
@section('TitleTabName' , 'Home Page')

@section('Getbody')
    <!-- Masthead [set header]-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="container">
                <br>
                <div class="col-sm-12">
                    {{-- image slide --}}
                    <div id="PromoteCourse" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            @for ($i = 0; $i < count($promote_course); $i++)
                                @if ($i == 0)
                                    <li data-target="#PromoteCourse" data-slide-to="{{ $i }}" class="active"></li>
                                @else
                                    <li data-target="#PromoteCourse" data-slide-to="{{ $i }}"></li>
                                @endif
                            @endfor
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                          @php
                              $cnt = 0;
                          @endphp
                          @foreach ($promote_course as $course)
                            @if ($cnt == 0)
                                <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                            @endif

                            @php
                                if ($course->IMG_NAME == "" or $course->IMG_NAME == null) {
                                    $img = "00000-NoImage.jpg";
                                } else {
                                    $img = $course->IMG_NAME;
                                }
                            @endphp
                                <img src="{{ url('GetImage/' . $img) }}" alt="{{ $course->ANC_HEADER }}" style="width: 100%;height: 500px;">
                                </div>
                            @php
                                $cnt ++;
                            @endphp
                          @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#PromoteCourse" data-slide="prev">
                          <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#PromoteCourse" data-slide="next">
                          <span class="carousel-control-next-icon"></span>
                        </a>

                    </div>
                    {{-- image slide --}}
                </div>
            </div>
        </div>
    </header>
@stop

