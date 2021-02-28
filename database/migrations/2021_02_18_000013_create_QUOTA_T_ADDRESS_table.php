<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTAddressTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_ADDRESS';

    /**
     * Run the migrations.
     * @table QUOTA_T_ADDRESS
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('APPLICATION_CODE' , 12);
            $table->string('LOCATION_CODE' , 5);
            $table->string('ADDR_NO' , 200);
            $table->string('TELEPHONE', 20);
            $table->string('EMAIL', 150);
            $table->string('UPD_USER_ID', 12);
            $table->dateTime('LAST_UPD_DATE')->default(DB::raw('CURRENT_TIMESTAMP()'));
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`APPLICATION_CODE`,`LOCATION_CODE`),
            ADD CONSTRAINT `fk_addr_application_code` FOREIGN KEY (`APPLICATION_CODE`) REFERENCES `QUOTA_T_APPLICATION` (`APPLICATION_CODE`),
            ADD CONSTRAINT `fk_addr_location_code` FOREIGN KEY (`LOCATION_CODE`) REFERENCES `QUOTA_T_LOCATION` (`LOCATION_CODE`) ; "
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
