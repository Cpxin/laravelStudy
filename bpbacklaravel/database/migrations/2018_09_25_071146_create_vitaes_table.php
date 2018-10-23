<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitaesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitae', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->string('image')->default('');
            $table->string('email')->default('');
            $table->string('experience')->default('无'); //项目经历
            $table->string('skill')->default('');
            $table->string('adress')->default('');
            $table->string('education')->default('');  //教育经历
            $table->string('hobby')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vitaes');
    }
}
