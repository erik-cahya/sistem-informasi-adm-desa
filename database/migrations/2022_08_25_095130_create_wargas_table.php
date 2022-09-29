<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp')->unique();
            $table->string('nama_lengkap');
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('alamat');
            $table->string('dusun');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->enum('baca_tulis',['iya','tidak'])->nullable();
            $table->string('golongan_darah');
            $table->string('warga_negara');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('status_nikah');
            $table->enum('status_warga',['1','0']);
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
        Schema::dropIfExists('wargas');
    }
};
