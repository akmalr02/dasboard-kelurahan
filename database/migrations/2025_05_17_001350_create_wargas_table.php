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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id('id_warga');
            $table->unsignedBigInteger('NIK')->unique();
            $table->unsignedBigInteger('NKK');
            $table->string('name', 225);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']);
            $table->string('pekerjaan')->nullable();
            $table->string('alamat', 225)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', 'tidak tahu'])->default('tidak tahu');
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->enum('status_keluarga', ['kepala_keluarga', 'istri', 'anak', 'lainnya'])->default('lainnya');
            $table->unsignedBigInteger('id_RT')->nullable();
            $table->unsignedBigInteger('id_RW')->nullable();
            $table->enum('jabatan', ['admin', 'warga', 'ketua_RT', 'ketua_RW'])->default('warga');
            $table->unsignedBigInteger('id_user')->nullable()->unique();
            $table->foreign('id_RT')->references('id_RT')->on('rts');
            $table->foreign('id_RW')->references('id_RW')->on('rws');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
