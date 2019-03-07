<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->integer('age')->default(0);
            $table->integer('sex')->default(10);
            $table->string('position')->default('实习');
            $table->integer('state')->default(0);  //状态 0：空闲 1：忙碌 2：...
            $table->timestamps();
//            $table->dateTime('created_at');
//            $table->dateTime('updated_at');
        });
        DB::statement("ALTER TABLE staff AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
