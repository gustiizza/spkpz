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
        Schema::create('bobot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id');
            $table->integer('nilai_bk');
            $table->timestamps();

            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot');
    }
};
