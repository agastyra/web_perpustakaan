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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 50)->nullable(false);
            $table->string('user_alamat', 50)->nullable();
            $table->string('user_username', 50)->unique()->nullable(false);
            $table->string('user_email', 50)->nullable(false);
            $table->char('user_notelp', 13)->nullable();
            $table->string('user_password', 60)->nullable(false);
            $table->enum('user_level', ['admin', 'anggota'])->nullable(false)->default('anggota');
            $table->string('user_pict_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
