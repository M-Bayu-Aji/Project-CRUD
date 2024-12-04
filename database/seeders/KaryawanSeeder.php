<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karyawan::create([
            'image' => 'img/bayyy.jpg',
            'name' => 'Bayu',
            'jenis_kelamin' => 'Pria',
            'jabatan' => 'Admin'
        ]);
        Karyawan::create([
            'image' => 'img/aji.jpg',
            'name' => 'Aji',
            'jenis_kelamin' => 'Pria',
            'jabatan' => 'Kasir'
        ]);
    }
}
