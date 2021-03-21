<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anouncements extends Model
{
    use HasFactory;
    protected $table = "QUOTA_T_ANOUNCEMENT";
    public $timestamps = false;
    protected $fillable = [
        "ANC_CODE" ,
        "EFFT_DATE" ,
        "EXP_DATE" ,
        "ANC_HEADER" ,
        "ANC_DETAIL" ,
        "FILE_FLAG" ,
        "FILE_NAME" ,
        "ANC_LINK" ,
        "IMG_FLAG" ,
        "IMG_NAME" ,
        "ANC_TAG" ,
        "UPDATE_USER_ID"
    ];
}
