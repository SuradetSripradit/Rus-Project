<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTPositionTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_POSITION';

    /**
     * Run the migrations.
     * @table QUOTA_T_POSITION
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('POSITION_CODE' , 5);
            $table->string('POSITION_DESC_TH', 100);
            $table->string('POSITION_DESC_EN', 100)->nullable()->default(null);
            $table->string('UPDATE_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw("CURRENT_TIMESTAMP()"));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`POSITION_CODE`) ; "
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
