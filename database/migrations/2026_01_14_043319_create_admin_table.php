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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('nama_lengkap');
            $table->string('nomor_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
