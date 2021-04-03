<?php

namespace App\Http\Controllers;

use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ctl_approve_form extends Controller
{
    public function index()
    {

        $profile = $this->GetProfile();
        return view('Backend.approve' , compact('profile'));
    }

    public function show($id)
    {
        //
    }

    public function approve_form_application(Request $request)
    {
        if ($request->get('_token') == "" or $request->get('_token') != csrf_token()) {
            return redirect()->route('approve.index')->with('error' , 'Token ไม่ถูกต้องกรุณาลองใหม่อีกครั้ง !');
        } else {
            $id = $request->get('application_code');
            $status = $request->get('app_res');

            $query = DB::raw("update QUOTA_T_APPLICATION set APPLICATION_STATUS = '$status' where APPLICATION_CODE = '$id'");

            $res = DB::statement($query);

            if (!$res) {
                return redirect()->route('approve.index')->with('error' , 'ไม่สามารถอนุมัติใบสมัครรายการนี้ได้ โปรดลองใหม่อีกครั้ง');
            } else {
                return redirect()->route('approve.index')->with('success' , 'อนุมัติใบสมัครเรียบร้อยแล้ว !');
            }
        }
    }

    public function destroy($id)
    {
        //
    }

    private function GetProfile()
    {
        $query = DB::raw(
            "select course.COURSE_HEAD_CODE
                    , course.COURSE_NAME_TH
                    , course.COURSE_TYPE
                    , course.LEARNING_DATE_TYPE
                    , pf.PREFIX_NAME_TH
                    , pf.PREFIX_NAME_EN
                    , sc.SCHOOL_NAME_TH
                    , cl.CLASS_LEVEL_NAME_TH
                    , pn.PERSON_NAME
                    , app.*
            from QUOTA_T_APPLICATION app
                join QUOTA_T_PREFIX pf
                    on app.PREFIX_CODE = pf.PREFIX_CODE
                join QUOTA_T_SCHOOL sc
                    on app.SCHOOL_CODE = sc.SCHOOL_CODE
                join QUOTA_T_CLASS_LEVEL cl
                    on app.CLASS_LEVEL_CODE = cl.CLASS_LEVEL_CODE
                join (select distinct(PERSONNEL_CODE) as PERSONNEL_CODE , concat(PREFIX_NAME_TH , ' ' , NAME_TH) as PERSON_NAME from QUOTA_T_PERSONNEL mast left join QUOTA_T_PREFIX prefix on mast.PREFIX_ID = prefix.PREFIX_CODE) pn
                    on app.PERSONNEL_CODE = pn.PERSONNEL_CODE
                left join QUOTA_T_COURSE course
                    on app.COURSE_CODE = course.COURSE_CODE
            where course.ACTIVE_FLAG = 'Y'
                    and pf.ACTIVE_FLAG = 'Y'
                    and sc.ACTIVE_FLAG = 'Y'
                    and app.APPLICATION_STATUS = 'W'"
        );

        $res = DB::select($query);

        return $res;
    }
}
