<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position')->default('');  //职位
            $table->integer('basic')->default(0);    //基本工资
            $table->string('weekday')->default('');   //工作日 周一~周五
            $table->string('time',256)->default('');  //一天工作时间
            $table->integer('reward')->default(0);    //奖惩倍数
            $table->string('other')->default('');    //其他
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
        Schema::dropIfExists('wages');
    }
}
