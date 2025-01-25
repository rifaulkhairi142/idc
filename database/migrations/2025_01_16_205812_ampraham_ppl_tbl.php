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
        Schema::create('ampraham_ppl_tbl', function (Blueprint $table) {
            $table->id();
            $table->text('link_document');
            $table->string('no_rekening');
            $table->string('no_npwp');
            $table->string('name');
            $table->string('nip');
            $table->string('nama_bank');
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();


            $table->string('pangkat_dan_golongan');
            $table->unsignedBigInteger('id_sekolah');
            $table->timestamps();

            $table->string('jabatan');
            $table->foreign('id_sekolah')->references('id')->on('sekolah_tbl')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ampraham_ppl_tbl');
    }
};
