<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penerima', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->unsignedBigInteger('kecamatan_id');
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
        });

        Schema::create('nilai_penerima', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penerima_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('subkriteria_id');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('penerima_id')->references('id')->on('penerima');
            $table->foreign('kriteria_id')->references('id')->on('kriteria');
            $table->foreign('subkriteria_id')->references('id')->on('sub_kriteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima', 'nilai_penerima');
    }
};
