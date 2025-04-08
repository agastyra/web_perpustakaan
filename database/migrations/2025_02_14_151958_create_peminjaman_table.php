<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_user_id');
            $table->date('peminjaman_tglpinjam')->nullable();
            $table->date('peminjaman_tglkembali')->nullable();
            $table->boolean('peminjaman_statuskembali')->default(false);
            $table->string('peminjaman_note', 100)->nullable();
            $table->integer('peminjaman_denda')->nullable();

            $table->foreign('peminjaman_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
