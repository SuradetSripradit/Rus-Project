@extends('Frontend/master')
@section('TitleTabName' , 'Home Page')

@section('Getbody')
    <!-- Masthead [set header]-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="container">
                <br>
                <div class="col-sm-12">
                    <div id="demo" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="{{ asset('assets/img/01.jpg') }}" alt="Los Angeles" width="100%" height="600px">
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('assets/img/02.jpg') }}" alt="Chicago" width="100%" height="600px">
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('assets/img/03.jpg') }}" alt="New York" width="100%" height="600px">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

