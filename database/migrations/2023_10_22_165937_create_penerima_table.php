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
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->unsignedBigInteger('subkriteria_id')->nullable();
            $table->unsignedBigInteger('nilai');
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
            $table->foreign('kriteria_id')->references('id')->on('kriteria');
            $table->foreign('subkriteria_id')->references('id')->on('sub_kriteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima');
    }
};
