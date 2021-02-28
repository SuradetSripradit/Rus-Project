<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTAnouncementTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_ANOUNCEMENT';

    /**
     * Run the migrations.
     * @table QUOTA_T_ANOUNCEMENT
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('TRANSECTION_CODE' , 5);
            $table->string('ANC_TYPE', 2);
            $table->string('ANC_NAME_TH');
            $table->string('ANC_NAME_EN')->nullable()->default(null);
            $table->string('ANC_DETAIL');
            $table->string('ACTIVE_FLAG', 1)->default('Y');
            $table->string('UPDATE_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });
        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`TRANSECTION_CODE`),
            ADD CONSTRAINT `fk_anouncements_anc_type` FOREIGN KEY (`ANC_TYPE`) REFERENCES `QUOTA_T_ANOUNCEMENT_TYPE` (`ANC_TYPE`); "
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
