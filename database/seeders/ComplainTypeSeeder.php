<?php

namespace Database\Seeders;

use App\Models\ComplainType;
use Illuminate\Database\Seeder;

class ComplainTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComplainType::factory()
            ->count(0)
            ->create();
    }
}
