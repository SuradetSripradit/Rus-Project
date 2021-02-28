<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    use HasFactory;
    protected $table = "QUOTA_T_SCHOOL";
    public $timestamps = false;
    protected $fillable = [
        "SCHOOL_CODE" ,
        "SCHOOL_NAME_TH" ,
        "SCHOOL_NAME_EN" ,
        "ACTIVE_FLAG",
        "UPDATE_USER_ID"
    ];
}
