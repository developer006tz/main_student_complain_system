<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AcademicYear;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicYearControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_academic_years(): void
    {
        $academicYears = AcademicYear::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('academic-years.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_years.index')
            ->assertViewHas('academicYears');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_academic_year(): void
    {
        $response = $this->get(route('academic-years.create'));

        $response->assertOk()->assertViewIs('app.academic_years.create');
    }

    /**
     * @test
     */
    public function it_stores_the_academic_year(): void
    {
        $data = AcademicYear::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('academic-years.store'), $data);

        $this->assertDatabaseHas('academic_years', $data);

        $academicYear = AcademicYear::latest('id')->first();

        $response->assertRedirect(route('academic-years.edit', $academicYear));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_academic_year(): void
    {
        $academicYear = AcademicYear::factory()->create();

        $response = $this->get(route('academic-years.show', $academicYear));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_years.show')
            ->assertViewHas('academicYear');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_academic_year(): void
    {
        $academicYear = AcademicYear::factory()->create();

        $response = $this->get(route('academic-years.edit', $academicYear));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_years.edit')
            ->assertViewHas('academicYear');
    }

    /**
     * @test
     */
    public function it_updates_the_academic_year(): void
    {
        $academicYear = AcademicYear::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];

        $response = $this->put(
            route('academic-years.update', $academicYear),
            $data
        );

        $data['id'] = $academicYear->id;

        $this->assertDatabaseHas('academic_years', $data);

        $response->assertRedirect(route('academic-years.edit', $academicYear));
    }

    /**
     * @test
     */
    public function it_deletes_the_academic_year(): void
    {
        $academicYear = AcademicYear::factory()->create();

        $response = $this->delete(
            route('academic-years.destroy', $academicYear)
        );

        $response->assertRedirect(route('academic-years.index'));

        $this->assertModelMissing($academicYear);
    }
}
