<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Semester;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SemesterControllerTest extends TestCase
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
    public function it_displays_index_view_with_semesters(): void
    {
        $semesters = Semester::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('semesters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.semesters.index')
            ->assertViewHas('semesters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_semester(): void
    {
        $response = $this->get(route('semesters.create'));

        $response->assertOk()->assertViewIs('app.semesters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_semester(): void
    {
        $data = Semester::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('semesters.store'), $data);

        $this->assertDatabaseHas('semesters', $data);

        $semester = Semester::latest('id')->first();

        $response->assertRedirect(route('semesters.edit', $semester));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_semester(): void
    {
        $semester = Semester::factory()->create();

        $response = $this->get(route('semesters.show', $semester));

        $response
            ->assertOk()
            ->assertViewIs('app.semesters.show')
            ->assertViewHas('semester');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_semester(): void
    {
        $semester = Semester::factory()->create();

        $response = $this->get(route('semesters.edit', $semester));

        $response
            ->assertOk()
            ->assertViewIs('app.semesters.edit')
            ->assertViewHas('semester');
    }

    /**
     * @test
     */
    public function it_updates_the_semester(): void
    {
        $semester = Semester::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];

        $response = $this->put(route('semesters.update', $semester), $data);

        $data['id'] = $semester->id;

        $this->assertDatabaseHas('semesters', $data);

        $response->assertRedirect(route('semesters.edit', $semester));
    }

    /**
     * @test
     */
    public function it_deletes_the_semester(): void
    {
        $semester = Semester::factory()->create();

        $response = $this->delete(route('semesters.destroy', $semester));

        $response->assertRedirect(route('semesters.index'));

        $this->assertModelMissing($semester);
    }
}
