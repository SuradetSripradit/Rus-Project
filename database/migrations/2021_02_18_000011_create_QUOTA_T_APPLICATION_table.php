<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTApplicationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_APPLICATION';

    /**
     * Run the migrations.
     * @table QUOTA_T_APPLICATION
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('APPLICATION_CODE',12);
            $table->string('APPLICATION_YEAR', 4);
            $table->string('COURSE_CODE', 10);
            $table->string('ID_CARD_NUMBER', 13);
            $table->string('PERSONNEL_CODE', 5);
            $table->string('PREFIX_CODE', 5);
            $table->string('FIRST_NAME_TH', 45);
            $table->string('LAST_NAME_TH', 45);
            $table->string('FIRST_NAME_EN', 45);
            $table->string('LAST_NAME_EN', 45);
            $table->string('GENDER', 1);
            $table->string('SCHOOL_CODE', 5);
            $table->string('CLASS_LEVEL_CODE', 2);
            $table->string('GPA', 5);
            $table->dateTime('CREATION_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->string('CREATE_USER_ID', 12);
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`APPLICATION_CODE`,`APPLICATION_YEAR`,`COURSE_CODE` , `ID_CARD_NUMBER`),
            ADD CONSTRAINT `fk_apk_course_code` FOREIGN KEY (`COURSE_CODE`) REFERENCES `QUOTA_T_COURSE` (`COURSE_CODE`),
            ADD CONSTRAINT `fk_apk_prefix_code` FOREIGN KEY (`PREFIX_CODE`) REFERENCES `QUOTA_T_PREFIX` (`PREFIX_CODE`),
            ADD CONSTRAINT `fk_apk_class_level_code` FOREIGN KEY (`CLASS_LEVEL_CODE`) REFERENCES `QUOTA_T_CLASS_LEVEL` (`CLASS_LEVEL_CODE`) ; "
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
