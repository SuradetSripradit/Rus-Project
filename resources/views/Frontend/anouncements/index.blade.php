@extends('Frontend.master')

@section('TitleTabName' , "ข่าวประชาสัมพันธ์")

@section('Getbody')
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="col-sm-12">
                <h3 class="text-center text-white">ข่าวประชาสัมพันธ์</h3>
            {{-- header --}}
                <div class="card-deck">
                    <div class="card bg-primary">
                        <div class="card-body text-center">
                        <p class="card-text">
                            Some text inside the first card
                            Some text inside the first card
                            Some text inside the first card
                            Some text inside the first card
                        </p>
                        </div>
                    </div>
                    <div class="card bg-warning">
                        <div class="card-body text-center">
                        <p class="card-text">Some text inside the second card</p>
                        </div>
                    </div>
                    <div class="card bg-success">
                        <div class="card-body text-center">
                        <p class="card-text">Some text inside the third card</p>
                        </div>
                    </div>
                </div>
            {{-- data (card) --}}
            </div>
        </div>
    </section>
@endsection

