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
        Schema::create('petakerawanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('walas_id');
            $table->string('kolom1')->nullable();
            $table->string('kolom2')->nullable();
            $table->string('kolom3')->nullable();
            $table->string('kolom4')->nullable();
            $table->string('kolom5')->nullable();
            $table->string('kolom6')->nullable();
            $table->string('kolom7')->nullable();
            $table->string('kolom8')->nullable();
            $table->string('kolom9')->nullable();
            $table->string('kolom10')->nullable();
            $table->string('kolom11')->nullable();
            $table->string('kolom12')->nullable();
            $table->string('kolom13')->nullable();
            $table->string('kolom14')->nullable();
            $table->string('kolom15')->nullable();
            $table->string('kolom16')->nullable();
            $table->string('kolom17')->nullable();
            $table->string('kolom18')->nullable();
            $table->string('kolom19')->nullable();
            $table->string('kolom20')->nullable();
            $table->timestamps();
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('walas_id')->references('id')->on('wali_kelas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petakerawanan');
    }
};
