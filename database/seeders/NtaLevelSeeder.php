<?php

namespace Database\Seeders;

use App\Models\NtaLevel;
use Illuminate\Database\Seeder;

class NtaLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NtaLevel::factory()
            ->count(0)
            ->create();
    }
}
