<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIdWargaFromSuratKematiansTable extends Migration
{
    public function up()
    {
        Schema::table('surat_kematians', function (Blueprint $table) {
            // Drop foreign key terlebih dahulu
            $table->dropForeign(['id_warga']);

            // Lalu drop kolomnya
            $table->dropColumn('id_warga');
        });
    }

    public function down()
    {
        Schema::table('surat_kematians', function (Blueprint $table) {
            $table->unsignedBigInteger('id_warga')->nullable();

            $table->foreign('id_warga')
                ->references('id_warga')
                ->on('wargas')
                ->onDelete('set null');
        });
    }
}
