<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationForm extends Controller
{
    public function SubmitForm(Request $req)
    {
        // Verify token
        $tk = $req->get('_token');
        if ($tk != csrf_token() or $tk == "" or $tk == null) {
            return redirect()->route('MainPage')->with('error' , 'Token ไม่ถูกต้อง');
        } else {
            // Declare Data
            $course_code = $req->get('course_code');

            // Gen code
            $CountAPPID = application::max('APPLICATION_CODE');
            $CompareCount = intval($CountAPPID + 1);
            $query = DB::raw("LPAD($CompareCount , 5 , '0')");
            $gen = DB::select("select $query as new_id from dual");
                foreach ($gen as $item) {
                    $new_id = $item->new_id;
                }

            // Insert data
            $ins_res = new application([
                "APPLICATION_CODE" => strval($new_id),
                "APPLICATION_YEAR" => date('Y'),
                "COURSE_CODE" => $course_code,
                "ID_CARD_NUMBER" => $req->get('id_card'),
                "PERSONNEL_CODE" => $req->get('selectPersonnel'),
                "PREFIX_CODE" => $req->get('prefix'),
                "FIRST_NAME_TH" => $req->get('f_name_t'),
                "LAST_NAME_TH" => $req->get('l_name_t'),
                "FIRST_NAME_EN" => $req->get('f_name_e'),
                "LAST_NAME_EN" => $req->get('l_name_e'),
                "GENDER" => $req->get('gender'),
                "SCHOOL_CODE" => $req->get('school'),
                "CLASS_LEVEL_CODE" => $req->get('learning_level'),
                "GPA" => $req->get('gpa'),
                "LINE_ID" => $req->get('LineID'),
                "TELEPHONE" => $req->get('telephone'),
                "EMAIL" => $req->get('Email'),
                "CREATE_USER_ID" => strval($new_id),
            ]);

            $ins_res->save();

            // chk result
            $cnt = application::all()->where('APPLICATION_CODE' , strval($new_id))->count();

            if ($cnt == 0 or $cnt == null) {
                return redirect()->route('course' , $course_code)->with('error' , 'ไม่สามารถบันทึกใบสมัครได้โปรดลองใหม่อีกครั้ง !');
            } else {
                return redirect()->route('course' , $course_code)->with('success' , 'บันทึกใบสมัครเรียบร้อยแล้ว !');
            }
        }
    }
}
