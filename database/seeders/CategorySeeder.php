<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $kategori = [
            ['nama_kategori' => 'Karbohidrat'],
            ['nama_kategori' => 'Protein Hewani'],
            ['nama_kategori' => 'Protein Nabati'],
            ['nama_kategori' => 'Buah-buahan'],
            ['nama_kategori' => 'Sayur'],
            ['nama_kategori' => 'Minyak'],
            ['nama_kategori' => 'Susu dan Gula'],
            // Tambahkan kategori lain sesuai kebutuhan Anda
        ];

        // Masukkan data ke dalam tabel kategori
        DB::table('categories')->insert($kategori);
    }
}
