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
        Schema::create('operator_kecamatan_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('id_kecamatan');
            $table->timestamps();

            $table->foreign('email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator_kecamatan_tbl');
    }
};
