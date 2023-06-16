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
        Schema::create('konseling_bks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('layanan_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('walas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->dateTime('waktu');
            $table->string('tempat');
            $table->string('status');
            $table->string('karier')->nullable();
            $table->text('hasil_konseling')->nullable();
            $table->timestamps();


            $table->foreign('layanan_id')->references('id')->on('layanan_bks')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
            $table->foreign('walas_id')->references('id')->on('wali_kelas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konseling_bks');
    }
};
