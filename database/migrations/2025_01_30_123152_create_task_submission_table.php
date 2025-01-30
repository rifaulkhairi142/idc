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
        Schema::create('task_submission', function (Blueprint $table) {
            $table->id();
            $table->string('username_mahasiswa');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_tugas');
            $table->text('link'); 
            $table->string('status');
            $table->float('score')->nullable();
            $table->timestamps();

            $table->foreign('username_mahasiswa')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('tempat_kpm_tbl')->onDelete('cascade');
            $table->foreign('id_tugas')->references('id')->on('task')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_submission');
    }
};
