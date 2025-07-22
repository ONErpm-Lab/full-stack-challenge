<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PendingIsrc;

class PendingIsrcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PendingIsrc::truncate();
        PendingIsrc::insert([
            ['isrc' => 'US7VG1846811', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'US7QQ1846811', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'BRC310600002', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'BR1SP1200071', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'BR1SP1200070', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'BR1SP1500002', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'BXKZM1900338', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'BXKZM1900345', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'QZNJX2081700', 'created_at' => now(), 'updated_at' => now()],
            ['isrc' => 'QZNJX2078148', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
