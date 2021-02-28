@extends('Frontend/test/master')
@section('TitleTab', 'คณวิทยศาสตร์และเทคโนโลยี')
@section('Getbody')
    <section class="about-section" id="about">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5> <i class="far fa-file-alt"></i> แบบฟอร์มสมัครเรียน </h5>
                        </div>
                        <div class="modal-body"> <br>
                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-2">
                                    <label for="email2" class="mb-2 mr-sm-4">คำนำหน้าชื่อ :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label for="email2" class="mb-2 mr-sm-2">ชื่อ :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="email2" placeholder=" "
                                        name="email">
                                </div>

                                <div class="col-sm-4 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">นามสกุล:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-2">
                                    <label for="email2" class="mb-2 mr-sm-4">Prefix :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label for="email2" class="mb-2 mr-sm-2">First Name :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="email2" placeholder=" "
                                        name="email">
                                </div>

                                <div class="col-sm-4 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">Last Name :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-6">
                                    <label for="email2" class="mb-2 mr-sm-4">เลขบัตรประชาชน :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="email2" placeholder=" "
                                        name="email">
                                </div>

                                <div class="col-sm-2">
                                    <label for="email2" class="mb-2 mr-sm-2">อายุ :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="email2" placeholder=" "
                                        name="email">
                                </div>

                                <div class="col-sm-2 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">เพศ :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL">  </option>
                                       
                                        <option value="WY"> </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-10 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">ที่อยู่ :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-3 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">จังหวัด :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-3 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">อำเภอ :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-2 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">ตำบล :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-2 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">รหัสไปรษณีย์ :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-6 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">สถานที่ศึกษา :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-4 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">ระดับชั้น :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-6 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">วิชาเอก :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-4 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">เกรดเฉลี่ยสะสม :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-6 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">หลักสูตร :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>

                                <div class="col-sm-4 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">แผนการเรียน :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-10 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">อาจารย์ที่แนะนำ :</label>
                                    <select class="js-example-basic-multiple form-control mb-2 mr-sm-4" name="states[]"
                                        multiple="multiple">
                                        <option value="AL"> </option>

                                        <option value="WY"> </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-3 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">เบอร์โทร :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>

                                <div class="col-sm-3 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">ไอดีไลน์ :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>

                                <div class="col-sm-4 ">
                                    <label for="pwd2" class="mb-2 mr-sm-2">E-mail :</label>
                                    <input type="text" class="form-control mb-2 mr-sm-4" id="pwd2" placeholder=" "
                                        name="pswd">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-1">

                                </div>

                                <div class="col-sm-10 ">
                                    <div class="form-group form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember">
                                            ข้าพเจ้าของรับรองว่า ข้อความทั้งหมดข้างต้นเป็นความจริงทุกประการ
                                            หากมหาวิทยาลัยเทคโนโลยีราชมงคลสุวรรณภูมิตรวจสอบพบว่า
                                            คุณวุฒิและคุณสมบัติของข้าพเจ้าไม่ตรงตามที่มหาวิทยาลัยกำหนด หรือตรวจพบว่า
                                            มีการปลอมแปลงเอกสารข้าพเจ้ายินยอมให้ทางมหาวิทยาลัยเพิกถอนสิทธิ์หรือคัดชื่อออกโดยไม่มีสิทธิ์เรียกร้องใดๆ
                                            ในการสมัครสอบคัดเลือก <p> ทุกประการ ทั้งนี้
                                                ข้าพเจ้ายินยอมให้มหาวิทยาลัยนำข้อมูลในใบสมัครของข้าพเจ้าไปใช้ประโยชน์
                                                ตามที่มหาวิทยาลัยพิจารณาเห็นสมควร
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">

                                </div>

                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-light btn-md mr-sm-4"> ยกเลิก </button>
                                    <button type="button" class="btn btn-success btn-md mr-sm-2"> บันทึก </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

    </script>

@endsection



{{-- <div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div style="text-align:right">คำนามหน้า :</div>
        </div>
        <div class="col-sm-6">
            <input class="form-control" style="width: 100%" name="pwd">
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-4">
            <div style="text-align:right">ชื่อ :</div>
        </div>
        <div class="col-sm-6">
            <input class="form-control" style="width: 100%" name="pwd">
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-4">
            <div style="text-align:right">นามสกุล :</div>
        </div>
        <div class="col-sm-6">
            <input class="form-control" style="width: 100%" name="pwd">
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-4">
            <div style="text-align:right"> ชื่อผู้ใช้งาน :</div>
        </div>
        <div class="col-sm-6">
            <input class="form-control" style="width: 100%" name="pwd">
        </div>
        <div class="col-sm-2">
            <div style="text-align:center">
                <H5> Holle </H5>
            </div>
        </div>
    </div> --}}

    {{-- <div class="form-group" style="width: 40%">
        <label>คำนามหน้า :</label>
        <div class="col-sm-4">
            <input class="form-control" name="pwd">
        </div>
    </div>

    {{-- <div class="form-group" style="width: 30%">
                                    <label>ชื่อ :</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" name="pwd">
                                    </div>
                                </div> 

                                <div class="form-group" style="width: 30%">
                                    <label>นามสกุล :</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" name="pwd">
                                    </div>
                                </div>
                                <br> --}} 
