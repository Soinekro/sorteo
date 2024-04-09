<?php

namespace Database\Seeders;

use App\Models\Premio;
use App\Models\Ticket;
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
        // User::factory(100)->create();

        $premios = [
            'Laptop',
            'Teclado',
            'Parlantes',
            'Mouse',
            'Audífonos',
            'Cámara',
        ];

        foreach ($premios as $premio) {
            Premio::create([
                'name' => $premio,
                'slug' => Str::slug($premio),
                'description' => 'Descripción del premio ' . $premio,
            ]);
        }

        // for($i = 1; $i <= 500; $i++) {
        //     Ticket::create([
        //         'user_id' => User::all()->random()->id,
        //         'ticket' => str_pad($i, 8, '0', STR_PAD_LEFT)
        //     ]);
        // }
    }
}
