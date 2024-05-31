<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStaff extends Migration
{
    public function up()
    {
        Schema::create('tb_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pn')->unique();
            $table->unsignedInteger('premium_id');
            $table->unsignedInteger('jobgrade_id');
            $table->unsignedInteger('users_id')->nullable();
            $table->string('name');
            $table->double('salary_staff')->default(0);
            $table->double('jumlah')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('premium_id')->references('id')->on('tb_premium')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jobgrade_id')->references('id')->on('tb_jobgrade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_staff');
    }
}
