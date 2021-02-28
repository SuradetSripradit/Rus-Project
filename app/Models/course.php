<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $table = "QUOTA_T_COURSE";
    public $timestamps = false;
    protected $fillable = [
        "COURSE_CODE" ,
        "COURSE_HEAD_CODE" ,
        "COURSE_TYPE" ,
        "LEARNING_DATE_TYPE" ,
        "COURSE_NAME_TH" ,
        "COURSE_NAME_EN" ,
        "DESCRIPTION_DETAIL" ,
        "LEARNING_LIST" ,
        "QUALIFICATION_REQ" ,
        "IMAGE_UPLOAD_DET" ,
        "ACTIVE_FLAG",
        "UPDATE_USER_ID"
    ];
}
