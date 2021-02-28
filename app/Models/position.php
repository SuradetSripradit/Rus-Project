<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    use HasFactory;
    protected $table = "QUOTA_T_POSITION";
    public $timestamps = false;
    protected $fillable = [
        "POSITION_CODE" ,
        "POSITION_DESC_TH" ,
        "POSITION_DESC_EN" ,
        "UPD_USER_ID"
    ];
}
