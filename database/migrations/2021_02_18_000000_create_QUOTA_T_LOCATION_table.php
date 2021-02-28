<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTLocationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_LOCATION';

    /**
     * Run the migrations.
     * @table QUOTA_T_LOCATION
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('LOCATION_CODE' , 5);
            $table->string('PROVINCE_CODE', 10);
            $table->string('PROVINCE', 100);
            $table->string('DISTRICT_CODE', 10);
            $table->string('DISTRICT', 100);
            $table->string('SUB_DISTRICT_CODE', 10);
            $table->string('SUB_DISTRICT', 100);
            $table->string('ZIP_CODE', 5);
            $table->string('UPDATE_USER_ID' , 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`LOCATION_CODE`); "
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
