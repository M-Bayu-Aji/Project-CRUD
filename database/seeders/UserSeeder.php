<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin2',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        User::create([
            'name' => 'Muhammad Bayu Aji',
            'username' => 'Bayu Aji',
            'email' => 'bayuaji@gmail.com',
            'role' => 'user',
            'password' => Hash::make('bayu123')
        ]);

        $names = [
            'Bayu Aji', 'Rizky Fauzi', 'Andi Saputra', 'Siti Aisyah', 'Ahmad Fauzan',
            'Dewi Sartika', 'Agus Pratama', 'Lisa Permata', 'Hendra Gunawan', 'Putri Maharani'
        ];

        foreach ($names as $key => $name) {
            $username = strtolower(str_replace(' ', '_', $name));
            $email = $username . '@gmail.com';

            User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'role' => 'user',
                'password' => Hash::make('password' . ($key + 1)),
            ]);
        }
    }
}
