<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuotaTPersonLoginTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'QUOTA_T_PERSON_LOGIN';

    /**
     * Run the migrations.
     * @table QUOTA_T_PERSON_LOGIN
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id' , 5);
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('password');
            $table->string('user_type' , 1)->comment('0 คือผู้ดูแลระบบ 1 คือผู้ใช้งาน')->default('1');
            $table->string('first_create_flag' , 1)->comment('บัญชีพึ่งสร้างใช่หรือไม่')->default('Y');
            $table->rememberToken();
            $table->nullableTimestamps();
        });

        DB::statement(
            " ALTER TABLE " . $this->tableName . "
            ADD PRIMARY KEY (`id`),
            ADD CONSTRAINT `FK_person_login_personnel` FOREIGN KEY (`id`) REFERENCES `QUOTA_T_PERSONNEL` (`PERSONNEL_CODE`) ; "
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
