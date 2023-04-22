<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Student;

use App\Models\Program;
use App\Models\Country;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentControllerTest extends TestCase
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
    public function it_displays_index_view_with_students(): void
    {
        $students = Student::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('students.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.students.index')
            ->assertViewHas('students');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_student(): void
    {
        $response = $this->get(route('students.create'));

        $response->assertOk()->assertViewIs('app.students.create');
    }

    /**
     * @test
     */
    public function it_stores_the_student(): void
    {
        $data = Student::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('students.store'), $data);

        $this->assertDatabaseHas('students', $data);

        $student = Student::latest('id')->first();

        $response->assertRedirect(route('students.edit', $student));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_student(): void
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.show', $student));

        $response
            ->assertOk()
            ->assertViewIs('app.students.show')
            ->assertViewHas('student');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_student(): void
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.edit', $student));

        $response
            ->assertOk()
            ->assertViewIs('app.students.edit')
            ->assertViewHas('student');
    }

    /**
     * @test
     */
    public function it_updates_the_student(): void
    {
        $student = Student::factory()->create();

        $department = Department::factory()->create();
        $program = Program::factory()->create();
        $user = User::factory()->create();
        $country = Country::factory()->create();

        $data = [
            'program_id' => $this->faker->randomNumber,
            'gender' => 'male',
            'date_of_birth' => $this->faker->date,
            'admission_id' => $this->faker->text(255),
            'maritial_status' => 'single',
            'status' => '1',
            'department_id' => $department->id,
            'program_id' => $program->id,
            'user_id' => $user->id,
            'country_id' => $country->id,
        ];

        $response = $this->put(route('students.update', $student), $data);

        $data['id'] = $student->id;

        $this->assertDatabaseHas('students', $data);

        $response->assertRedirect(route('students.edit', $student));
    }

    /**
     * @test
     */
    public function it_deletes_the_student(): void
    {
        $student = Student::factory()->create();

        $response = $this->delete(route('students.destroy', $student));

        $response->assertRedirect(route('students.index'));

        $this->assertModelMissing($student);
    }
}
