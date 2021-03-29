<?php

namespace App\Http\Controllers\Frontend;

// use controller
use App\Http\Controllers\Controller;
use App\Models\anouncements;
use Illuminate\Http\Request;

// use Model
use App\Models\course;
use Illuminate\Support\Facades\DB;

class ctl_show_anouncements extends Controller
{
    public function index()
    {
        // Show course type in menu list
        $course_type = course::select('COURSE_TYPE')->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();
        $course_name = course::select(
            'COURSE_CODE' ,
            'COURSE_TYPE' ,
            'COURSE_NAME_TH'
        )->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();

        // Show Data In page
        $anouncementsHeader_tmp = DB::select($this->CallAnounce('',''));

        $anouncementsHeader = array_chunk($anouncementsHeader_tmp , 3);

        // dd($anouncementsHeader);

    // return page
        return view('Frontend.anouncements.index' , compact(
            'course_type' , 'course_name' , /* retuen for create tab menu */
            'anouncementsHeader'
        ));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    private function CallAnounce($efft_date , $exp_date)
    {
        if ($efft_date == "" or $efft_date == null) {
            $efft_date = date("Y-m-d");
            $condition1 = "";
        } else {
            $condition1 = "EFFT_DATE >= DATE_FORMAT('$efft_date' , '%Y-%m-%d') AND ";
        }

        if ($exp_date == "" or $exp_date == null) {
            $exp_date = date("Y-m-d");
        }

        // Prepare variable

        $query = DB::raw(
            "SELECT *
            FROM QUOTA_T_ANOUNCEMENT
            WHERE $condition1 (EXP_DATE >= DATE_FORMAT('$exp_date' , '%Y-%m-%d') OR EXP_DATE IS NULL) AND ACTIVE_FLAG = 'Y'"
        );

        return $query;
    }

}
