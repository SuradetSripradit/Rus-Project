<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prefix extends Model
{
    use HasFactory;
    protected $table = "QUOTA_T_PREFIX";
    public $timestamps = false;
    protected $fillable = [
        "PREFIX_CODE" ,
        "PREFIX_NAME_TH" ,
        "PREFIX_NAME_EN" ,
        "ACTIVE_FLAG",
        "UPD_USER_ID"
    ];
}
