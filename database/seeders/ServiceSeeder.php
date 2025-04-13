<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['name' => 'Prewedding', 'description' => 'Foto prewedding indoor/outdoor', 'price' => 1500000],
            ['name' => 'Wedding', 'description' => 'Paket dokumentasi pernikahan', 'price' => 3000000],
            ['name' => 'Product Shoot', 'description' => 'Foto produk untuk UMKM', 'price' => 500000],
        ]);
    }
}
