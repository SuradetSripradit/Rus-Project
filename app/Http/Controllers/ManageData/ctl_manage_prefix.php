<?php

namespace App\Http\Controllers\ManageData;

use App\Http\Controllers\Controller;
use App\Models\prefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ctl_manage_prefix extends Controller
{

    public function index()
    {
        $Data_prefix = prefix::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = false;

        return view('Backend.ManageData.v_manage_prefix' , compact('Data_prefix' , 'CheckUpdate'));


    }

    public function store(Request $request)
    {
        // "PREFIX_CODE" ,
        $max_id = intval(DB::table('QUOTA_T_PREFIX')->max('PREFIX_CODE')) + 1;

        $prefix_res = new prefix([
            'PREFIX_CODE' => DB::raw("LPAD($max_id , 5 , '0')") ,
            'PREFIX_NAME_TH' => $request->get('prefix_th') ,
            'PREFIX_NAME_EN' => $request->get('prefix_en'),
            'UPD_USER_ID' => DB::raw("LPAD(". Auth::user()->id . " , 5 , '0')")
        ]);
        $prefix_res->save();

        return redirect()->route('Manage-Prefix.index')->with('success' , 'บันทึกข้อมูลเรียบร้อยแล้ว !');
    }

    public function show($id)
    {
        $Data_prefix = prefix::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $CheckUpdate = true;

        foreach ($Data_prefix as $dp) {
            if ($dp["PREFIX_CODE"] == $id) {
                $returnData = $dp;
            }
        }

        return view('Backend.ManageData.v_manage_prefix' , compact('Data_prefix' , 'CheckUpdate' , 'returnData'));
    }

    public function PrefixUpdate(Request $request)
    {
        if ($request->get('_token') == "" or $request->get('_token') != csrf_token()) {
            return redirect()->route('Manage-Prefix.index')->with('error' , 'Token ไม่ถูกต้อง รบกวนลองใหม่อีกครั้ง');
        } else {
            $prefix_th = $request->get('prefix_th');
            $prefix_en = $request->get('prefix_en');
            $prefix_id = $request->get('prefix_id');
            $update_id = Auth::user()->id;
            $prefix_res = DB::statement(
                "UPDATE QUOTA_T_PREFIX SET PREFIX_NAME_TH = '$prefix_th'
                        , PREFIX_NAME_EN = '$prefix_en'
                        , UPD_USER_ID = LPAD('$update_id' , 5 , '0')
                        , LAST_UPD_DATE = CURRENT_TIMESTAMP()
                WHERE PREFIX_CODE = '$prefix_id'"
            );

            if ($prefix_res) {
                return redirect()->route('Manage-Prefix.index')->with('success' , 'แก้ไขข้อมูลเรียบร้อยแล้ว !');
            } else {
                return redirect()->route('Manage-Prefix.index')->with('error' , 'ไม่สามารถแก้ไขข้อมูลได้ โปรดลองใหม่อีกครั้ง !');
            }
        }
    }

    public function destroy($id)
    {
        $upd_flag = DB::statement(
            "UPDATE QUOTA_T_PREFIX SET ACTIVE_FLAG = 'N' , LAST_UPD_DATE = CURRENT_TIMESTAMP() WHERE PREFIX_CODE = '$id'"
        );

        return redirect()->route('Manage-Prefix.index')->with('success' , 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}
