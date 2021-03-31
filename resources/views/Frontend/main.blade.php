@extends('Frontend/master')
@section('TitleTabName' , 'Home Page')

@section('Getbody')
    <!-- Masthead [set header]-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="container">
                <br>
                <div class="col-sm-12">
                    <div id="PromoteCourse" class="carousel slide" data-ride="carousel">
                        @php
                            $cnt = 0;
                        @endphp
                        @foreach ($promote_course as $pc)
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                @if ($cnt == 0)
                                    <li data-target="#PromoteCourse" data-slide-to="{{ $cnt }}" class="active"></li>
                                @else
                                    <li data-target="#PromoteCourse" data-slide-to="{{ $cnt }}"></li>
                                @endif
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                @php
                                    if ($pc->IMG_NAME == "" or $pc->IMG_NAME == null) {
                                        $img = "00000-NoImage.jpg";
                                    } else {
                                        $img = $pc->IMG_NAME;
                                    }
                                @endphp
                                @if ($cnt == 0)
                                    <div class="carousel-item active">
                                        {{ $img }}
                                        <img src="{{ url('GetImage/' . $img) }}" alt="{{ $pc->ANC_HEADER }}" style="width: 100%;height: 60%;">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img src="{{ url('GetImage/' . $img) }}" alt="{{ $pc->ANC_HEADER }}" style="width: 100%;height: 60%;">
                                    </div>
                                @endif
                            </div>

                            @php
                                $cnt ++;
                            @endphp
                            <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#PromoteCourse" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#PromoteCourse" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

