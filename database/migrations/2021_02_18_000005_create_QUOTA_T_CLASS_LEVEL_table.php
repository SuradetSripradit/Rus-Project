<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTClassLevelTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_CLASS_LEVEL';

    /**
     * Run the migrations.
     * @table QUOTA_T_CLASS_LEVEL
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('CLASS_LEVEL_CODE' , 2);
            $table->string('CLASS_LEVEL_NAME_TH', 100);
            $table->string('CLASS_LEVEL_NAME_EN', 100)->nullable()->default(null);
            $table->string('CLASS_ABBR_NAME', 25);
            $table->string('UPD_USER_ID', 5);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`CLASS_LEVEL_CODE`) ; "
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
