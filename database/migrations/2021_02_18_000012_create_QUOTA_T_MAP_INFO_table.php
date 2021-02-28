<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTMapInfoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_MAP_INFO';

    /**
     * Run the migrations.
     * @table QUOTA_T_MAP_INFO
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('PERSONNEL_CODE' , 5);
            $table->string('COURSE_CODE', 10);
            $table->string('POSITION_CODE', 5);
            $table->string('UPDATE_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`PERSONNEL_CODE`,`COURSE_CODE`,`POSITION_CODE`),
            ADD CONSTRAINT `fk_map_personnel_code` FOREIGN KEY (`PERSONNEL_CODE`) REFERENCES `QUOTA_T_PERSONNEL` (`PERSONNEL_CODE`),
            ADD CONSTRAINT `fk_map_course_code` FOREIGN KEY (`COURSE_CODE`) REFERENCES `QUOTA_T_COURSE` (`COURSE_CODE`),
            ADD CONSTRAINT `fk_map_position_code` FOREIGN KEY (`POSITION_CODE`) REFERENCES `QUOTA_T_POSITION` (`POSITION_CODE`) ; "
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
