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
        Schema::create('surat_kematians', function (Blueprint $table) {
            $table->id('id_kematian');
            $table->unsignedBigInteger('id_warga')->nullable();
            $table->foreign('id_warga')->references('id_warga')->on('wargas')->onDelete('set null');
            $table->string('nama_warga', 225)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']);
            $table->string('alamat', 225)->nullable();
            $table->string('hari_meninggal', 20);
            $table->date('tanggal_meninggal');
            $table->time('jam_meninggal');
            $table->string('penyebab', 255)->nullable();
            $table->string('tempat_pemakaman', 255)->nullable();
            $table->unsignedBigInteger('id_pelapor')->nullable();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('file_ttd_admin', 255)->nullable();
            $table->string('kode_verifikasi', 100)->unique();
            $table->foreign('id_pelapor')->references('id_warga')->on('wargas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kematians');
    }
};
