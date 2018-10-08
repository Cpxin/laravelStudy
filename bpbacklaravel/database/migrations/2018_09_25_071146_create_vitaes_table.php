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
            $table->string('image');
            $table->string('email');
            $table->string('experience');
            $table->string('skill');
            $table->string('adress');
            $table->string('education');
            $table->string('hobby');
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
