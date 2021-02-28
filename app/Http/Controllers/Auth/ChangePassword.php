<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function NewPasswordProcess(Request $request)
    {
        $chk_token = $request->get('_token');
        if ($chk_token == "" or $chk_token != csrf_token()) {
            return redirect()->route('back.office')->with('error' , 'Token ไม่ถูกต้อง ลองใหม่อีกครั้ง!');
        } else {
            $old_pass = $request->get('old_password');
            $new_pass = $request->get('new_password');
            $tmp_user = DB::table('QUOTA_T_PERSON_LOGIN')->select('password')->where('id' , Auth::user()->id)->distinct()->get();

            foreach ($tmp_user as $db_pass) {
                $chk_pass = $db_pass->password;
            }
            if (!Hash::check($old_pass, $chk_pass)) {
                return redirect()->route('back.office')->with('error' , 'รหัสผ่านเก่าไม่สอดคล้องกันกับข้อมูลของระบบ!');
            } else {
                if (Hash::check($new_pass, $chk_pass)) {
                    return redirect()->route('back.office')->with('error' , 'ไม่สามารถใช้รหัสผ่านเดิมได้!');
                } else {
                    $script = "UPDATE QUOTA_T_PERSON_LOGIN SET password = '" . Hash::make($new_pass) . "', first_create_flag = 'N' , updated_at = CURRENT_TIMESTAMP() WHERE id = LPAD(" . strval(Auth::user()->id) . ", 5, '0');";
                    $upd_pass = DB::statement($script);
                    return redirect()->route('back.office')->with('success' , 'Password has been change');
                }

            }
            // Hash::check($password, $profile["GENARATE_KEY"]);
        }
    }
}
