<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyIdPengantarToUsers extends Migration
{
    public function up()
    {
        Schema::table('surat_pengantars', function (Blueprint $table) {
            // Tambahkan kolom baru id_pengantar
            $table->unsignedBigInteger('id_pengantar')->nullable()->after('id_pengajuan');

            // Jadikan foreign key ke users.id_user
            $table->foreign('id_pengantar')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('surat_pengantars', function (Blueprint $table) {
            $table->dropForeign(['id_pengantar']);
            $table->dropColumn('id_pengantar');
        });
    }
}
