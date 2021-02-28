<?php

namespace App\Http\Controllers\ManageUser;

use App\Http\Controllers\Controller;
use App\Models\personnel;
use App\Models\position;
use App\Models\prefix;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ctl_manage_user extends Controller
{
    public function index()
    {
        $Personnel = DB::table('QUOTA_T_PERSONNEL AS MAST')
                        ->select(
                            'MAST.PERSONNEL_CODE' ,
                            'MAST.POSITION_CODE' ,
                            'MAST.PREFIX_ID' ,
                            'MAST.NAME_TH' ,
                            'MAST.NAME_EN' ,
                            'DET.user_type'
                        )
                        ->leftJoin('QUOTA_T_PERSON_LOGIN AS DET', 'MAST.PERSONNEL_CODE', '=', 'DET.id')
                        ->orderByRaw('DET.user_type')
                        ->orderBy('MAST.PERSONNEL_CODE')
                        ->get()->toArray();
        $CheckUpdate = false;
        $prefix = prefix::all()->toArray();
        $position = position::all()->whereIn('POSITION_CODE' , ['00001' , '00002' , '00004'])->toArray();

        return view('Backend.ManageData.v_manage_user', compact(
            'Personnel',
            'CheckUpdate',
            'prefix' ,
            'position' ,
        ));
    }

    public function show($id)
    {
        $Personnel = DB::table('QUOTA_T_PERSONNEL AS MAST')
                        ->select(
                            'MAST.PERSONNEL_CODE' ,
                            'MAST.PREFIX_ID' ,
                            'MAST.POSITION_CODE' ,
                            'MAST.NAME_TH' ,
                            'MAST.NAME_EN' ,
                            'DET.user_type' ,
                            'DET.email'
                        )
                        ->leftJoin('QUOTA_T_PERSON_LOGIN AS DET', 'MAST.PERSONNEL_CODE', '=', 'DET.id')
                        ->orderByRaw('DET.user_type')
                        ->orderBy('MAST.PERSONNEL_CODE')
                        ->get()->toArray();
        foreach ($Personnel as $ps) {
            if ($ps->PERSONNEL_CODE == $id) {
                $returnData = $ps;
            }
        }
        $CheckUpdate = true;
        $prefix = prefix::all()->toArray();
        $position = position::all()->whereIn('POSITION_CODE' , ['00001' , '00002' , '00004'])->toArray();

        return view('Backend.ManageData.v_manage_user', compact(
            'Personnel',
            'CheckUpdate',
            'prefix' ,
            'position' ,
            'returnData'
        ));
    }

    public function store(Request $request)
    {
        // check duplicate email
        $chk_duplicate_name = personnel::select("PERSONNEL_CODE")
            ->where('NAME_TH', $request->get('personnel_name_th'))
            ->orWhere('NAME_EN', $request->get('personnel_name_en'))
            ->count();
        $chk_duplicate_email = User::select("ID")
            ->where('email', $request->get('personnel_email'))
            ->count();
        if (($chk_duplicate_name > 0) or ($chk_duplicate_email > 0)) {
            return redirect()->route('Manage-User.index')->with('error', 'บัญชีผู้ใช้งานดังกล่าวมีอยู่ในระบบอยู่แล้ว !');
        } else {
            // Gen New ID
            $tmpID = DB::select('SELECT LPAD((MAX(PERSONNEL_CODE)+1), 5, "0") AS PERSONNEL_CODE FROM QUOTA_T_PERSONNEL;');

            foreach ($tmpID as $ID) {
                $NewPersonnelID = $ID->PERSONNEL_CODE;
            }

            $personnel_res = new personnel([
                "PERSONNEL_CODE" => $NewPersonnelID,
                "POSITION_CODE" => $request->get('UserPosition'),
                "PREFIX_ID" => $request->get('PrefixName'),
                "NAME_TH" => $request->get('personnel_name_th'),
                "NAME_EN" => $request->get('personnel_name_en'),
                "UPDATE_USER_ID" => strval(Auth::user()->id)
            ]);
            $personnel_res->save();

            $personnel_login_res = new User([
                'id' => $NewPersonnelID,
                'name' => $request->get('personnel_name_th'),
                'email' => $request->get('personnel_email'),
                'password' => Hash::make($request->get('personnel_email')),
                'user_type' => $request->get('UserType')
            ]);
            $personnel_login_res->save();

            // Check result after create user
            $chk_person = personnel::all()->where('PERSONNEL_CODE', $NewPersonnelID)->count();
            $chk_login = User::all()->where('id', $NewPersonnelID)->count();

            if ($chk_person == 0 || $chk_login == 0) {
                DB::statement("DELETE FROM QUOTA_T_PERSONNEL WHERE PERSONNEL_CODE = ?", $NewPersonnelID);
                DB::statement("DELETE FROM QUOTA_T_PERSON_LOGIN WHERE PERSONNEL_CODE = ?", $NewPersonnelID);
                return redirect()->route('Manage-User.index')->with('error', 'ไม่สามารถสร้างบัญชีผู้ใช้นี้ได้โปรดลองใหม่อีกครั้ง !');
            } else {
                return redirect()->route('Manage-User.index')->with('success', 'สร้างบัญชีผู้ใช้งานเรียบร้อยแล้ว');
            }
        }
    }

    public function ProcUpdate(Request $request){
        if ($request->get('_token') != csrf_token()) {
            return redirect()->route('Manage-User.index')->with('error' , 'Token ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง !');
        } else{
            $update_res = DB::statement(
                "UPDATE QUOTA_T_PERSONNEL SET PREFIX_ID = ? , POSITION_CODE = ? , NAME_TH = ? , NAME_EN = ? , UPDATE_USER_ID = " . Auth::user()->id . " WHERE PERSONNEL_CODE = ? " ,
                [
                    $request->get('PrefixName') ,
                    $request->get('UserPosition'),
                    $request->get('personnel_name_th') ,
                    $request->get('personnel_name_en') ,
                    $request->get('personnel_id')
                ]
            );

            $update_res2 = DB::statement(
                "UPDATE QUOTA_T_PERSON_LOGIN SET name = ? , email = ? , user_type = ? , updated_at = CURRENT_TIMESTAMP() where id = ?" ,
                [
                    $request->get('personnel_name_th') ,
                    $request->get('personnel_email'),
                    $request->get('UserType'),
                    $request->get('personnel_id')

                ]
                );
                return redirect() ->route('Manage-User.index')->with('success' , 'แก้ไขข้อมูลเรียบร้อยแล้ว !');
        }
    }

    public function destroy($id)
    {
        // clear child table
        $map_info = DB::statement("DELETE FROM QUOTA_T_MAP_INFO WHERE PERSONNEL_CODE = $id");
        $person_login = DB::statement("DELETE FROM QUOTA_T_PERSON_LOGIN WHERE id = $id");

        if (!$map_info or !$person_login) {
            return redirect()->route('Manage-User.index')->with('error' , 'ไม่สามารถลบบัญชีผู้ใช้งานนี้ได้ โปรดลองใหม่อีกครั้ง !');
        } else {
            $del_res = DB::statement("DELETE FROM QUOTA_T_PERSONNEL WHERE PERSONNEL_CODE = $id");
            if ($del_res) {
                return redirect()->route('Manage-User.index')->with('success' , 'ลบบัญชีผู้ใช้งานเรียบร้อยแล้ว!');
            } else {
                return redirect()->route('Manage-User.index')->with('error' , 'ไม่สามารถลบบัญชีผู้ใช้งานนี้ได้ โปรดลองใหม่อีกครั้ง !');
            }

        }

    }
}
