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
        Schema::create('rts', function (Blueprint $table) {
            $table->id('id_RT');
            $table->string('name_RT', 225);
            $table->integer('no_RT')->nullable();
            $table->unsignedBigInteger('id_RW');
            $table->unsignedBigInteger('id_user')->unique();
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
        Schema::dropIfExists('rts');
    }
};
