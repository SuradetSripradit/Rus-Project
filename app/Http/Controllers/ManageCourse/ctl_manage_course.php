<?php

namespace App\Http\Controllers\ManageCourse;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ctl_manage_course extends Controller
{
    public function index()
    {
        $DataCourse = course::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = false;
        $personOfCourse = personnel::all()->where('POSITION_CODE','00002')->toArray();
        return view('Backend.ManageData.v_manage_course' , compact('DataCourse' , 'CheckUpdate' , 'personOfCourse'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'file' => 'mimes:jpg,png,tiff',
        ]);

        $max_course = intval(DB::table('QUOTA_T_COURSE')->max('COURSE_CODE')) + 1;
        $course_code = DB::select("SELECT LPAD('$max_course' , 5 , '0') AS COURSE_ID FROM DUAL;");

        foreach ($course_code as $code) {
            $tmp_course_id = $code->COURSE_ID;
        }

        $new_course_code = $tmp_course_id;

        // upload file to strage
        $file_name = $new_course_code . "-" . $request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('PromoteCourse', $file_name, 'public');

        $course_res = new course([
            "COURSE_CODE" => $new_course_code ,
            "COURSE_HEAD_CODE" => $request->get('personOfCourse') ,
            "COURSE_TYPE" => $request->get('course_type') ,
            "LEARNING_DATE_TYPE" => $request->get('LearningTime') ,
            "COURSE_NAME_TH" => $request->get('course_th') ,
            "COURSE_NAME_EN" => $request->get('course_en') ,
            "DESCRIPTION_DETAIL" => str_replace("\r\n" , "<br>" , $request->get('course_description')) ,
            "LEARNING_LIST" => str_replace("\r\n" , "<br>" , $request->get('learning_list')) ,
            "QUALIFICATION_REQ" => str_replace("\r\n" , "<br>" , $request->get('qualification_req')),
            "IMAGE_UPLOAD_DET" => $file_name,
            "UPDATE_USER_ID" => DB::raw("LPAD(". Auth::user()->id . " , 5 , '0')")
        ]);
        $course_res->save();

        $chk_res = course::all()->where('COURSE_CODE' , $new_course_code)->count();

        if ($chk_res == 1) {
            return redirect()->route('Manage-Course.index')->with('success' , 'บันทึกข้อมูลเรียบร้อยแล้ว !');
        } else {
            return redirect()->route('Manage-Course.index')->with('error' , 'ไม่สามารถบันทึกข้อมูลได้ ! โปรดลองใหม่อีกครั้ง');
        }

    }

    public function show($id)
    {
        $DataCourse = course::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = true;
        $personOfCourse = personnel::all()->where('POSITION_CODE','00002')->toArray();

        foreach ($DataCourse as $dc) {
            if ($dc["COURSE_CODE"] == $id) {
                $returnData = $dc;
            }
        }
        // dd($returnData);

        return view('Backend.ManageData.v_manage_course' , compact('DataCourse' , 'CheckUpdate' , 'personOfCourse' , 'returnData'));
    }

    public function courseUpdate(Request $request)
    {
        if ($request->get('_token') == "" or $request->get('_token') != csrf_token()) {
            return redirect()->route('Manage-Course.index')->with('error' , 'token ไม่ถูกต้องกรุณาลองใหม่อีกครั้ง !');
        } else {
            if ($request->get('file') == null) {
                $file_name_tmp = DB::table('QUOTA_T_COURSE')->select('IMAGE_UPLOAD_DET')
                                    ->where('COURSE_CODE' , $request->get('course_code'))
                                    ->distinct()->get()->toArray();
                foreach ($file_name_tmp as $tmp_fname) {
                    $file_name = $tmp_fname->IMAGE_UPLOAD_DET;
                }
                // dd($file_name);
            } else {
                // upload file to strage
                $file_name = $request->get('course_code') . "-" . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('PromoteCourse', $file_name, 'public');
            }

            $COURSE_HEAD_CODE = $request->get('personOfCourse');
            $COURSE_TYPE = $request->get('course_type');
            $LEARNING_DATE_TYPE = $request->get('LearningTime');
            $COURSE_NAME_TH = $request->get('course_th');
            $COURSE_NAME_EN = $request->get('course_en');
            $DESCRIPTION_DETAIL = $request->get('course_description');
            $LEARNING_LIST = $request->get('learning_list');
            $QUALIFICATION_REQ = $request->get('qualification_req');
            $UPDATE_USER_ID = Auth::user()->id;
            $COURSE_CODE = $request->get('course_code');

            $res = DB::statement(
                "UPDATE QUOTA_T_COURSE SET
                    COURSE_HEAD_CODE = '$COURSE_HEAD_CODE' ,
                    COURSE_TYPE = '$COURSE_TYPE' ,
                    LEARNING_DATE_TYPE = '$LEARNING_DATE_TYPE' ,
                    COURSE_NAME_TH = '$COURSE_NAME_TH' ,
                    COURSE_NAME_EN = '$COURSE_NAME_EN' ,
                    DESCRIPTION_DETAIL = '$DESCRIPTION_DETAIL' ,
                    LEARNING_LIST = '$LEARNING_LIST' ,
                    QUALIFICATION_REQ  = '$QUALIFICATION_REQ' ,
                    IMAGE_UPLOAD_DET = '$file_name  ' ,
                    UPDATE_USER_ID = '$UPDATE_USER_ID' ,
                    LAST_UPD_DATE = CURRENT_TIMESTAMP()
                WHERE COURSE_CODE = '$COURSE_CODE'
                "
            );

            return redirect()->route('Manage-Course.index')->with('success' , 'แก้ไขข้อมูลเรียบร้อยแล้ว !');
        }
    }

    public function destroy($id)
    {
        $user_id_get = Auth::user()->id;
        $tmp_upd_user_id = DB::select("SELECT LPAD('$user_id_get' , 5 , '0') AS gen_key FROM DUAL;");
        foreach ($tmp_upd_user_id as $upd) {
            $user_id = $upd->gen_key;
        }
        $upd_flag = DB::statement(
            "UPDATE QUOTA_T_COURSE SET ACTIVE_FLAG = 'N' , LAST_UPD_DATE = CURRENT_TIMESTAMP() , UPDATE_USER_ID = '$user_id' WHERE COURSE_CODE = '$id'"
        );

        return redirect()->route('Manage-Course.index')->with('success' , 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}
