<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Course;

use App\Models\Program;
use App\Models\NtaLevel;
use App\Models\Semester;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'developer@ludovickonyo.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_courses(): void
    {
        $courses = Course::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('courses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.courses.index')
            ->assertViewHas('courses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_course(): void
    {
        $response = $this->get(route('courses.create'));

        $response->assertOk()->assertViewIs('app.courses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_course(): void
    {
        $data = Course::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('courses.store'), $data);

        $this->assertDatabaseHas('courses', $data);

        $course = Course::latest('id')->first();

        $response->assertRedirect(route('courses.edit', $course));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->get(route('courses.show', $course));

        $response
            ->assertOk()
            ->assertViewIs('app.courses.show')
            ->assertViewHas('course');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->get(route('courses.edit', $course));

        $response
            ->assertOk()
            ->assertViewIs('app.courses.edit')
            ->assertViewHas('course');
    }

    /**
     * @test
     */
    public function it_updates_the_course(): void
    {
        $course = Course::factory()->create();

        $department = Department::factory()->create();
        $ntaLevel = NtaLevel::factory()->create();
        $program = Program::factory()->create();
        $semester = Semester::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'credit' => $this->faker->randomNumber(1),
            'elective' => '1',
            'semester_id' => $this->faker->randomNumber,
            'department_id' => $this->faker->randomNumber,
            'nta_level_id' => $this->faker->randomNumber,
            'department_id' => $department->id,
            'nta_level_id' => $ntaLevel->id,
            'program_id' => $program->id,
            'semester_id' => $semester->id,
        ];

        $response = $this->put(route('courses.update', $course), $data);

        $data['id'] = $course->id;

        $this->assertDatabaseHas('courses', $data);

        $response->assertRedirect(route('courses.edit', $course));
    }

    /**
     * @test
     */
    public function it_deletes_the_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->delete(route('courses.destroy', $course));

        $response->assertRedirect(route('courses.index'));

        $this->assertModelMissing($course);
    }
}
