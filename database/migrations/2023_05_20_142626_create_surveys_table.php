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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string("porsi_minum",50)->nullable();
            $table->string("jam_tidur",50)->nullable();
            $table->enum('olahraga', ['Ya', 'Tidak'])->nullable();
            $table->enum('sinar_matahari', ['Ya', 'Tidak'])->nullable();
            $table->string('kondisi_kulit1', 30)->nullable();
            $table->string('kondisi_kulit2', 30)->nullable();
            $table->string('kondisi_kulit3', 30)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
