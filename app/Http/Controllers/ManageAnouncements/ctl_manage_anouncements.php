<?php

namespace App\Http\Controllers\ManageAnouncements;

use App\Http\Controllers\Controller;
use App\Models\anouncements;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ctl_manage_anouncements extends Controller
{
    public function index()
    {
        $Data_anouncements = anouncements::all()->where('ACTIVE_FLAG' , 'Y')->toArray();
        $Hashtag = anouncements::select('ANC_TAG')->distinct()->get()->toArray();
        $CheckUpdate = false;

        return view('Backend.ManageData.v_manage_anouncements' , compact('Data_anouncements' , 'CheckUpdate' , 'Hashtag'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /* Declare variable */
        $valid_file_flag = $request->get('anc_file_type_list');
        $valid_image = $request->get('anc_promote_image');
        $valid_exp_date = $request->get('exp_type_date');

        // gen ANC_CODE
        $CountANCID = anouncements::max('ANC_CODE');
        $CompareCount = intval($CountANCID + 1);
        $query = DB::raw("LPAD($CompareCount , 5 , '0')");
        $gen = DB::select("select $query as new_id from dual");
            foreach ($gen as $item) {
                $new_id = $item->new_id;
            }

        if ($valid_file_flag == "A" or $valid_file_flag == "F") {
            $get_link = $request->get('anc_link');
            // get link
            $chk_file_size = $request->file('anc_file')->getSize();
            if (($chk_file_size / 1000000) > 5) {
                return redirect()->route('Manage-Anouncements.index')->with('error' , 'ขนาดไฟล์สูงสุดที่รับได้คือ 5MB');
            } else {
                $file_name = $new_id . "-" . $request->anc_file->getClientOriginalName();
                $filePath = $request->file('anc_file')->storeAs('anouncements_path', $file_name, 'public');
            }
        } elseif ($valid_file_flag == "L") {
            $get_link = $request->get('anc_link');
            $file_name = null;
        } else {
            $get_link = null;
            $file_name = null;
        }

        if ($valid_image == "Y") {
            $chk_img_size = $request->file('PromoteImage')->getSize();
            if (($chk_img_size / 1000000) > 5) {
                return redirect()->route('Manage-Anouncements.index')->with('error' , 'ขนาดรูปสูงสุดที่รับได้คือ 5MB');
            } else {
                $img_name = $new_id . "-" . $request->PromoteImage->getClientOriginalName();
                $imgPath = $request->file('PromoteImage')->storeAs('PromoteImage_path', $img_name, 'public');
            }
        } else {
            $img_name = null;
        }

        $anouncments_res = new anouncements([
            "ANC_CODE" => strval($new_id) ,
            "EFFT_DATE" => $request->get('efft_date') ,
            "EXP_DATE" => $request->get('exp_date') ,
            "ANC_HEADER" => $request->get('anc_header') ,
            "ANC_DETAIL" => $request->get('anc_detail') ,
            "FILE_FLAG" => $request->get('anc_file_type_list') ,
            "FILE_NAME" => $file_name ,
            "ANC_LINK" => $get_link ,
            "IMG_FLAG" => $request->get('anc_promote_image') ,
            "IMG_NAME" => $img_name ,
            "ANC_TAG" => "ทดสอบ" ,
            "UPDATE_USER_ID" => DB::raw("LPAD(". Auth::user()->id . " , 5 , '0')")
        ]);

        $anouncments_res->save();

        // chk data
        $rechk = anouncements::all()->where('ANC_CODE' , $new_id)->count();
        if ($rechk > 0) {
            return redirect()->route('Manage-Anouncements.index')->with('success' , 'บันทึกข้อมูลเรียบร้อยแล้ว !');
        } else {
            return redirect()->route('Manage-Anouncements.index')->with('error' , 'ไม่สามารถบันทึกข้อมูลได้โปรดลองใหม่อีกครั้ง !');
        }

    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $update_query = DB::raw(
            "UPDATE QUOTA_T_ANOUNCEMENT SET ACTIVE_FLAG = 'N' ,
                LAST_UPD_DATE = CURRENT_TIMESTAMP() ,
                UPDATE_USER_ID = LPAD(" . Auth::user()->id . " , 5 , '0')
            WHERE ANC_CODE = '$id'"
        );

        $unique_res = DB::statement($update_query);
        if ($unique_res) {
            return redirect()->route('Manage-Anouncements.index')->with('success' , 'ลบข้อมูลเรียบร้อยแล้ว !');
        } else {
            return redirect()->route('Manage-Anouncements.index')->with('error' , 'ไม่สามารถลบข้อมูลได้โปรดลองใหม่อีกครั้ง !');
        }
    }
}
