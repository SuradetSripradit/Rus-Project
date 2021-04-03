<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    use HasFactory;

    protected $table = "QUOTA_T_PERSONNEL";
    public $timestamps = false;
    protected $fillable = [
        "PERSONNEL_CODE" ,
        "POSITION_CODE" ,
        "PREFIX_ID" ,
        "NAME_TH" ,
        "NAME_EN" ,
        "FILE_NAME" ,
        "UPDATE_USER_ID"
    ];

}
