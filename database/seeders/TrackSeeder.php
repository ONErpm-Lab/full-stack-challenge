<?php

namespace Database\Seeders;

use App\Services\TrackService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{

    public function __construct(private TrackService $service)
    {
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->service->searchForMissingIsrc();
    }
}
