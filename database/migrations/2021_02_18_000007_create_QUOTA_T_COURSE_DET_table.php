<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTCourseDetTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_COURSE_DET';

    /**
     * Run the migrations.
     * @table QUOTA_T_COURSE_DET
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('COURSE_CODE' , 10);
            $table->string('ANC_TYPE', 2);
            $table->string('DESCRIPTION_DETAIL' , 2000);
            $table->string('LEARNING_LIST' , 2000);
            $table->string('QUALIFICATION_REQ' . 2000);
            $table->string('IMAGE_UPLOAD_DET' , 500);
            $table->string('UPDATE_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`COURSE_CODE` , `ANC_TYPE`),
            ADD CONSTRAINT `fk_course_det_anc_type` FOREIGN KEY (`ANC_TYPE`) REFERENCES `QUOTA_T_ANOUNCEMENT_TYPE` (`ANC_TYPE`),
            ADD CONSTRAINT `fk_course_det_course_code` FOREIGN KEY (`COURSE_CODE`) REFERENCES `QUOTA_T_COURSE` (`COURSE_CODE`) ; "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
