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
        Schema::create('surat_kelahirans', function (Blueprint $table) {
            $table->id('id_kelahiran');
            $table->string('nama_anak', 225);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('hari_lahir', 20);
            $table->unsignedBigInteger('id_ibu');
            $table->unsignedBigInteger('id_ayah');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('file_ttd_admin', 255)->nullable();
            $table->string('kode_verifikasi', 100)->unique();
            $table->foreign('id_ibu')->references('id_warga')->on('wargas');
            $table->foreign('id_ayah')->references('id_warga')->on('wargas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kelahirans');
    }
};
