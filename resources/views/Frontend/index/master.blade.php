@extends('Frontend/master')
@section('TitleName' , 'หน้าแรก')

@section('Getbody')
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <div class="w3-content w3-display-container">
                <img class="mySlides" src="/assets/img/01.jpg" style="width:900px;height:400px">
                <img class="mySlides" src="/assets/img/02.jpg" style="width:900px;height:400px">
                <img class="mySlides" src="/assets/img/03.jpg" style="width:900px;height:400px">

                <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
            </div>
            <br>
            <br>
            <div class="card">
                <div class="card-body">
                    <h4>ข่าวประชาสัมพันธ์/ประกาศ</h4>
                    <div style="text-align:left;margin-top:1;margin-left:5%">
                        <h6>คู่มือการใช้งานระบบทะเบียนและประมวลผล</h6>
                    </div>
                    <div style="text-align:left;margin-top:1;margin-left:5%">
                        <h6>กำหนดการประเมินอาจารย์ผู้สอน</h6>
                    </div>
                    <div style="text-align:left;margin-top:1;margin-left:5%">
                        <h6>ปฏิทินการศึกษา</h6>
                    </div>
                    <div style="text-align:left;margin-top:1;margin-left:5%">
                        <h6>ขั้นตอนการดูตารางสอน</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@stop

  @section('AnotherLink')
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>


@endsection