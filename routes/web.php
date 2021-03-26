<?php

    use App\Http\Controllers\Auth\ChangePassword;
use App\Http\Controllers\Frontend\ctl_show_anouncements;
use App\Http\Controllers\ManageAnouncements\ctl_manage_anouncements;
use App\Http\Controllers\ManageCourse\ctl_manage_course;
    use App\Http\Controllers\ManageData\ctl_manage_college;
    use App\Http\Controllers\ManageData\ctl_manage_prefix;
    use App\Http\Controllers\ManageUser\ctl_manage_user;
use App\Models\anouncements;
use App\Models\course;
use App\Models\personnel;
use App\Models\User;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

Route::get('/', function () {
// Show course type in menu list
    $course_type = course::select('COURSE_TYPE')->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();
    $course_name = course::select(
        'COURSE_CODE' ,
        'COURSE_TYPE' ,
        'COURSE_NAME_TH'
    )->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();

    $tmp_query = DB::raw(
        "SELECT *
        FROM QUOTA_T_ANOUNCEMENT
        WHERE IMG_FLAG = 'Y'
            AND ACTIVE_FLAG = 'Y'
            AND (EXP_DATE IS NULL OR EXP_DATE >= current_timestamp());"
    );
    $promote_course = DB::select($tmp_query);

// return page
    return view('Frontend.main' , compact('course_type' , 'course_name' , 'promote_course'));
});

// Route::get('/anouncement', function () {
// // Show course type in menu list
//     $course_type = course::select('COURSE_TYPE')->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();
//     $course_name = course::select(
//         'COURSE_CODE' ,
//         'COURSE_TYPE' ,
//         'COURSE_NAME_TH'
//     )->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();

// // return page
//     return view('Frontend.anouncements.index' , compact('course_type' , 'course_name'));
// });

Route::resource('/anouncements', ctl_show_anouncements::class);

Route::get('/personnel', function () {
// Show course type in menu list
    $course_type = course::select('COURSE_TYPE')->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();
    $course_name = course::select(
        'COURSE_CODE' ,
        'COURSE_TYPE' ,
        'COURSE_NAME_TH'
    )->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();

    $personnel = DB::select(
        "SELECT *
        FROM QUOTA_T_PERSONNEL PS
            LEFT JOIN QUOTA_T_PREFIX PF
                ON PS.PREFIX_ID = PF.PREFIX_CODE
        WHERE PF.ACTIVE_FLAG = 'Y'
        ORDER BY POSITION_CODE DESC"
    );
    $anouncement = anouncements::all()->where('ACTIVE_FLAG' , 'Y')->toArray();

// return page
    return view('Frontend.personnel.index' , compact('course_type' , 'course_name' , 'anouncement' , 'personnel'));
});

Route::get('course/{id}', function ($id) {
// Show course type in menu list
    $course_type = course::select('COURSE_TYPE')->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();
    $course_name = course::select(
        'COURSE_CODE' ,
        'COURSE_TYPE' ,
        'COURSE_NAME_TH'
    )->where('ACTIVE_FLAG' , 'Y')->distinct()->get()->toArray();

    $unique_course = course::all()->where('COURSE_CODE' , $id)->toArray();

// return page
    return view('Frontend.course.Index' , compact('course_type' , 'course_name' , 'unique_course'));
});

Auth::routes();

// =============================================================================== \\
    // --------------------------- Backend Routing ---------------------------- \\
    Route::view('Back-office', 'Backend.HomeLocalPage')->name('back.office');
    Route::group(['middleware' => ['auth']], function () {
    // Route for manage user
        Route::post('/change-password', [ChangePassword::class , 'NewPasswordProcess'])->name('change.password');
        Route::get('/change-password', [ChangePassword::class , 'NewPasswordProcess']);

        Route::resource('/Manage-User', ctl_manage_user::class);
        Route::post('Manage-User/profile/update', [ctl_manage_user::class , 'ProcUpdate'])->name('ProcUpd');
        Route::get('Manage-User/profile/update', [ctl_manage_user::class , 'ProcUpdate']);

        Route::resource('/Manage-School', ctl_manage_college::class);
        Route::post('Manage-School/update', [ctl_manage_college::class , 'SchoolUpdate'])->name('school.upd');
        Route::get('Manage-School/update', [ctl_manage_college::class , 'SchoolUpdate']);

        Route::resource('/Manage-Prefix', ctl_manage_prefix::class);
        Route::post('Manage-Prefix/update', [ctl_manage_prefix::class , 'PrefixUpdate'])->name('prefix.upd');
        Route::get('Manage-Prefix/update', [ctl_manage_prefix::class , 'PrefixUpdate']);

        Route::resource('/Manage-Course', ctl_manage_course::class);
        Route::post('Manage-Course/update', [ctl_manage_course::class , 'courseUpdate'])->name('course.upd');
        Route::get('Manage-Course/update', [ctl_manage_course::class , 'courseUpdate']);

        Route::resource('/Manage-Anouncements', ctl_manage_anouncements::class);

        Route::resource('/SummaryReport', control_show_report::class);
    });
// =============================================================================== \\
