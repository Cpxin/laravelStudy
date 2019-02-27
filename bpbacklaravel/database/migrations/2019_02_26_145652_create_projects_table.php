<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');  //项目名
            $table->string('content',10240)->default('');  //项目内容
            $table->string('pdfUrl',512)->default('');   //项目pdf路径
            $table->string('personnel')->default(''); //人员需求
            $table->string('staffId')->default(''); //参与员工
            $table->integer('cost')->default(0);  //预期成本
            $table->integer('profit')->default(0); //预期利润
            $table->integer('term')->default(100); //项目期限
            $table->integer('rank')->default(0); //项目等级 0<1<2<3...
            $table->integer('state')->default(0); //项目状态 0：未启动 1：启动 2：..
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
        Schema::dropIfExists('projects');
    }
}
