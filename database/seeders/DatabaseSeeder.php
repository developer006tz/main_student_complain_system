<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AcademicYearSeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(ComplainTypeSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DepartmentHeadSeeder::class);
        $this->call(EnrollmentSeeder::class);
        $this->call(LectureSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(NtaLevelSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(UserSeeder::class);
    }
}
