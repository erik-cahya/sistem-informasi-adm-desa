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
        Schema::create('detail_keluargas', function (Blueprint $table) {
            $table->unsignedBigInteger('keluarga_id'); 
            $table->unsignedBigInteger('warga_id'); 

            $table->foreign('keluarga_id')->references('id')->on('keluargas')->onDelete('cascade');
            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_keluargas');
    }
};
