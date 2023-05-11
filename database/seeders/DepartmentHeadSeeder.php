<?php

namespace Database\Seeders;

use App\Models\DepartmentHead;
use Illuminate\Database\Seeder;

class DepartmentHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepartmentHead::factory()
            ->count(1)
            ->create();
    }
}
