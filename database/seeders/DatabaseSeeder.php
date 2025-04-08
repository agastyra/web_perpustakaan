<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            "user_name" => "Admin",
            "user_alamat" => "-",
            "user_username" => "admin",
            "user_email" => "admin@mail.com",
            "user_notelp" => "xxx",
            "user_password" => Hash::make("admin123"),
            "user_level" => "admin"
        ]);

        \App\Models\User::create([
            "user_name" => "Rangga Agastya",
            "user_alamat" => "Karangploso",
            "user_username" => "rangga",
            "user_email" => "rangga@example.com",
            "user_notelp" => "085607799274",
            "user_password" => Hash::make("agastya"),
            "user_level" => "anggota"
        ]);

        $this->call(RakSeeder::class);
    }
}
