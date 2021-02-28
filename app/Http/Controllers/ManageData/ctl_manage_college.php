<?php

namespace App\Http\Controllers\ManageData;

use App\Http\Controllers\Controller;
use App\Models\school;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ctl_manage_college extends Controller
{
    public function index()
    {
        $Data_school = school::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = false;

        return view('Backend.ManageData.v_manage_school' , compact('Data_school' , 'CheckUpdate'));
    }

    public function store(Request $request)
    {
        $max_id = intval(DB::table('QUOTA_T_SCHOOL')->max('SCHOOL_CODE')) + 1;

        $school_res = new school([
            'SCHOOL_CODE' => DB::raw("LPAD($max_id , 5 , '0')") ,
            'SCHOOL_NAME_TH' => $request->get('school_th') ,
            'SCHOOL_NAME_EN' => $request->get('school_en'),
            'UPDATE_USER_ID' => DB::raw("LPAD(". Auth::user()->id . " , 5 , '0')")
        ]);
        $school_res->save();

        return redirect()->route('Manage-School.index')->with('success' , 'บันทึกข้อมูลเรียบร้อยแล้ว !');
    }

    public function show($id)
    {
        $Data_school = school::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = true;

        foreach ($Data_school as $dp) {
            if ($dp["SCHOOL_CODE"] == $id) {
                $returnData = $dp;
            }
        }

        return view('Backend.ManageData.v_manage_school' , compact('Data_school' , 'CheckUpdate' , 'returnData'));
    }

    public function SchoolUpdate(Request $request)
    {
        if ($request->get('_token') == "" or $request->get('_token') != csrf_token()) {
            return redirect()->route('Manage-School.index')->with('error' , 'Token ไม่ถูกต้อง รบกวนลองใหม่อีกครั้ง');
        } else {
            $school_th = $request->get('school_th');
            $school_en = $request->get('school_en');
            $school_id = $request->get('school_id');
            $update_id = Auth::user()->id;
            $school_res = DB::statement(
                "UPDATE QUOTA_T_SCHOOL SET SCHOOL_NAME_TH = '$school_th'
                        , SCHOOL_NAME_EN = '$school_en'
                        , UPDATE_USER_ID = LPAD('$update_id' , 5 , '0')
                        , LAST_UPD_DATE = CURRENT_TIMESTAMP()
                WHERE SCHOOL_CODE = '$school_id'"
            );

            if ($school_res) {
                return redirect()->route('Manage-School.index')->with('success' , 'แก้ไขข้อมูลเรียบร้อยแล้ว !');
            } else {
                return redirect()->route('Manage-School.index')->with('error' , 'ไม่สามารถแก้ไขข้อมูลได้ โปรดลองใหม่อีกครั้ง !');
            }
        }
    }

    public function destroy($id)
    {
        $upd_flag = DB::statement(
            "UPDATE QUOTA_T_SCHOOL SET ACTIVE_FLAG = 'N' , LAST_UPD_DATE = CURRENT_TIMESTAMP() WHERE SCHOOL_CODE = '$id'"
        );

        return redirect()->route('Manage-School.index')->with('success' , 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}
