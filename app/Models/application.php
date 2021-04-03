<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    use HasFactory;
    protected $table = "QUOTA_T_APPLICATION";
    public $timestamps = false;
    protected $fillable = [
        "APPLICATION_CODE",
        "APPLICATION_YEAR",
        "COURSE_CODE",
        "ID_CARD_NUMBER",
        "PERSONNEL_CODE",
        "PREFIX_CODE",
        "FIRST_NAME_TH",
        "LAST_NAME_TH",
        "FIRST_NAME_EN",
        "LAST_NAME_EN",
        "GENDER",
        "SCHOOL_CODE",
        "CLASS_LEVEL_CODE",
        "GPA",
        "LINE_ID",
        "TELEPHONE",
        "EMAIL" ,
        "CREATE_USER_ID"
    ];
}
