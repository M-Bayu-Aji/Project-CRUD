<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// Removed unused import

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
            'name' => 'Cashier',
            'username' => 'cashier1',
            'email' => 'cashier@gmail.com',
            'role' => 'kasir',
            'password' => Hash::make('cashier123')
        ]);

        User::create([
            'name' => 'Muhammad Bayu Aji',
            'username' => 'Bayu Aji',
            'email' => 'bayuaji@gmail.com',
            'role' => 'user',
            'password' => Hash::make('bayu123')
        ]);
    }
}
