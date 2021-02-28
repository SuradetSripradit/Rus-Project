<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class QUOTATSCHOOL extends Migration
{
    public $tableName = 'QUOTA_T_SCHOOL';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('SCHOOL_CODE' , 5);
            $table->string('SCHOOL_NAME_TH', 255);
            $table->string('SCHOOL_NAME_EN', 255);
            $table->string('ACTIVE_FLAG' , 1);
            $table->string('UPD_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`SCHOOL_CODE`) ; "
        );
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
