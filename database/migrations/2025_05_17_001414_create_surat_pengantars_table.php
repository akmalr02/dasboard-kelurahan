<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_pengantars', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->string('nama', 225);
            $table->unsignedBigInteger('NIK')->unique();
            $table->unsignedBigInteger('NKK');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']);
            $table->string('pekerjaan', 100)->nullable();
            $table->string('alamat', 225)->nullable();
            $table->text('keperluan');
            $table->string('email', 225);
            $table->enum('status', ['diproses', 'disetujui', 'ditolak'])->default('diproses');
            $table->date('tanggal_pengajuan');
            $table->unsignedBigInteger('id_rt')->nullable();
            $table->unsignedBigInteger('id_rw')->nullable();
            $table->date('tanggal_disetujui_rt')->nullable();
            $table->date('tanggal_disetujui_rw')->nullable();
            $table->string('file_ttd_rt', 255)->nullable();
            $table->string('file_ttd_rw', 255)->nullable();
            $table->string('kode_verifikasi', 100)->unique();
            $table->foreign('id_rt')->references('id_RT')->on('rts');
            $table->foreign('id_rw')->references('id_RW')->on('rws');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantars');
    }
};
