<?php

namespace Database\Seeders;

use App\Models\Premio;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'dni' => '12345678',
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);

        $premios = [
            'Laptop',
            'Smartphone',
            'Tablet',
            'Smartwatch',
            'Audífonos',
            'Cámara',
        ];

        foreach ($premios as $premio) {
            Premio::create([
                'name' => $premio,
                'slug' => Str::slug($premio),
                'description' => 'Descripción del premio ' . $premio,
                'image' => 'https://via.placeholder.com/150',
            ]);
        }
    }
}
