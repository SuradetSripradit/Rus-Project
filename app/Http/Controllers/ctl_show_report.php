<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class ctl_show_report extends Controller
{
    public function index()
    {
        $mpdf = new Mpdf([
            'default_font_size' => 16,
            'default_font' => 'sarabun',
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 52,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $mpdf->setFooter(
            '<div class="container">
                <div class="col-sm-12" style="text-align:center">
                    <h1>หน้าที่ {PAGENO}</h1>
                </div>
            </div>'
        );

        $GetCourse = course::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $cnt_app = application::all()->where('APPLICATION_STATUS' , 'Y')->count();

        if ($cnt_app == 0 or $cnt_app == null) {
            return redirect()->back()->with('error' , 'ไม่พบข้อมูลนักศึกษาที่ผ่านการอนุมัติโควต้าในระบบ');
        } else {
            foreach ($GetCourse as $gc) {
                $cnt_per_course = application::all()->where('APPLICATION_STATUS' , 'Y')->where('COURSE_CODE' , $gc["COURSE_CODE"])->count();

                if ($cnt_per_course != 0) {
                // Query register
                    $query_register = DB::raw(
                        "SELECT *
                        FROM QUOTA_T_APPLICATION APP
                            LEFT JOIN QUOTA_T_PREFIX PF
                                ON APP.PREFIX_CODE = PF.PREFIX_CODE
                            LEFT JOIN QUOTA_T_SCHOOL SC
                                ON APP.SCHOOL_CODE = SC.SCHOOL_CODE
                        WHERE PF.ACTIVE_FLAG = 'Y'
                            AND SC.ACTIVE_FLAG = 'Y'
                            AND APP.APPLICATION_YEAR = (SELECT MAX(APPLICATION_YEAR) FROM QUOTA_T_APPLICATION)
                            AND APP.COURSE_CODE = '" . $gc["COURSE_CODE"] . "'
                            AND APP.APPLICATION_STATUS = 'Y'"
                    );

                    $tmp_register = DB::select($query_register);
                // Query Course detail
                    $tmp_course = course::all()->where('ACTIVE_FLAG' , 'Y')->where('COURSE_CODE' , $gc["COURSE_CODE"])->toArray();
                    $tmp_count = count($tmp_register);
                // Gen html file
                    // $mpdf->SetWatermarkImage('assets/img/favicon.png');
                    // $mpdf->showWatermarkImage = true;
                    $html_header = view('Backend.genreport_header' , compact('tmp_course' , 'tmp_count'))->render();

                    $html_data = view('Backend.genreport_detail' , compact('tmp_register'))->render();
                // Gen pdf file & properties
                    $mpdf->SetHTMLHeader($html_header);
                    $mpdf->AddPage('P');
                    $mpdf->WriteHTML($html_data);
                }
            }
            // Export to PDF
                // Print PDF
                    $headers = array(
                        'Content-Type: application/pdf',
                    );
                    return response()->download($mpdf->Output(), "RegisterForm", $headers);
            }
        }
}
