@if (Auth::user()->first_create_flag == "Y")
    <script>
        window.location.href = "/Back-office";
    </script>
@else
@extends('Backend.master')
@section('TitleName')
    [Backend] @yield('TitleMenu')
@endsection

@section('GetBody')
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="text-white mb-4">
                        @yield('Title_Name')
                        <a id="AddDataBtn" href="#" data-toggle="modal" data-target="#Md_AddData">
                            <i class="fas fa-plus-circle" style="color: white"></i>
                        </a>
                    </h2>
                    @error('file')
                        <script>
                            swal("Failed!", "{{ $message }}", "error");
                        </script>
                    @enderror

                    @if (!$chk_permission)
                        <script>
                            swal("Access Denied!" , "คุณไม่มีสิทธิ์ในระบบงานนี้" , "error")
                                .then((value) => {
                                    window.location.href = "/Back-office";
                            });
                        </script>
                    @endif
                    {{-- Check success return --}}
                    {{-- Accordian Data in page --}}
                    <div id="ac_title">
                        <div class="card">
                            <div id="cl_title2" class="collapse show" data-parent="#ac_title">
                                <div class="card-body">
                                    {{-- Show Data In page --}}
                                        <table id="TabData" class="display nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    @yield('TableHeader')
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @yield('TableData')
                                            </tbody>
                                        </table>
                                    {{-- Show Data In page --}}
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- Accordian Data in page --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('AddDataModal')
    <!-- Modal -->
    <div class="modal fade " id="Md_AddData" role="dialog">
        <div class="modal-dialog {{ $md_size }}">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มข้อมูล [@yield('Add_GetModalHeader')]</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                {{-- <form action="{{ url('Manage-Title') }}" method="POST">
                    --}}
                    @yield('Add_FormAction')
                    {{ csrf_field() }}
                    <div class="modal-body">
                        @yield('Add_ModalForm')
                    </div>
                    <div class="modal-footer">
                        @if ($btn_add_submit == "")
                            <button type="submit" class="btn-lg btn-success">บันทึก</button>
                            <button type="button" class="btn-lg btn-danger" data-dismiss="modal">ปิด</button>
                        @elseif ($btn_add_submit == "manual")
                            @yield('manual_add_btn')
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- Add Data Model --}}
@endsection

    @section('UpdateDataModel')
        <!-- Modal -->
        <div class="modal fade" id="Md_updData" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูล [@yield('upd_GetModalHeader')]</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    {{-- <form action="{{ url('Manage-Title') }}" method="POST">
                        --}}
                        @yield('upd_FormAction')
                        @csrf
                        <div class="modal-body">
                            @yield('upd_ModalForm')
                        </div>
                        <div class="modal-footer">
                            @if ($btn_upd_submit == "")
                                <button type="submit" class="btn-lg btn-warning">แก้ไข</button>
                            @elseif ($btn_upd_submit == "manual")
                                @yield('manual_upd_btn')
                            @endif
                            <button type="button" class="btn-lg btn-danger" onclick="CloseModal('{{ $crrRoute }}')">ปิด</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- Update Data Model --}}
    @endsection


@section('AnotherLinkUse')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('FunctionJs')
        <script>
            $(document).ready(function() {
                $('#TabData').DataTable({
                    "scrollX": true,
                    "scrolly": true,
                    "sorting": false,
                    "searching": false,
                });
                $("#AddDataBtn").click(function() {
                    $("#Md_AddData").modal({
                        backdrop: "static"
                    }, 'show');
                });
                $('.Select2Class').select2();

            });

            $("#ReverseBtn").click(function() {
                $("#Md_Reverse").modal({
                    backdrop: "static"
                }, 'show');
            });

            function CloseModal(Path) {
                window.location.href = Path;
            }
        </script>
        @yield('GetFunction')

    @yield('ExternalJS')
@endsection

@endif
