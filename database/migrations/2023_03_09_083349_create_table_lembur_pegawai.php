<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLemburPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_lembur_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->on('tb_staff')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('periode')->nullable();
            $table->time('mulai_lembur');
            $table->time('selesai_lembur');
            $table->integer('jumlah_jam');
            $table->integer('total_uang_lembur');
            $table->date('tanggal_lembur');
            $table->double('jumlah_upah_lembur')->nullable()->default(0);
            $table->double('pembulatan')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_lembur_pegawai');
    }
}