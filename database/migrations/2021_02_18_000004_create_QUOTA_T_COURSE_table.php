<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTCourseTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_COURSE';

    /**
     * Run the migrations.
     * @table QUOTA_T_COURSE
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('COURSE_CODE' , 10);
            $table->string('COURSE_NAME_TH', 200);
            $table->string('COURSE_NAME_EN', 200)->nullable()->default(null);
            $table->string('COURSE_TYPE', 100);
            $table->string('ACTIVE_FLAG', 1)->default('Y');
            $table->string('UPDATE_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`COURSE_CODE`); "
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
