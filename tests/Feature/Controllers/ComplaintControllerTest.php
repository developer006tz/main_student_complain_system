<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Complaint;

use App\Models\Course;
use App\Models\Student;
use App\Models\Program;
use App\Models\Lecture;
use App\Models\Semester;
use App\Models\Department;
use App\Models\ComplainType;
use App\Models\AcademicYear;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplaintControllerTest extends TestCase
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
    public function it_displays_index_view_with_complaints(): void
    {
        $complaints = Complaint::factory()
            ->count(2)
            ->create();

        $response = $this->get(route('complaints.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.complaints.index')
            ->assertViewHas('complaints');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_complaint(): void
    {
        $response = $this->get(route('complaints.create'));

        $response->assertOk()->assertViewIs('app.complaints.create');
    }

    /**
     * @test
     */
    public function it_stores_the_complaint(): void
    {
        $data = Complaint::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('complaints.store'), $data);

        $this->assertDatabaseHas('complaints', $data);

        $complaint = Complaint::latest('id')->first();

        $response->assertRedirect(route('complaints.edit', $complaint));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_complaint(): void
    {
        $complaint = Complaint::factory()->create();

        $response = $this->get(route('complaints.show', $complaint));

        $response
            ->assertOk()
            ->assertViewIs('app.complaints.show')
            ->assertViewHas('complaint');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_complaint(): void
    {
        $complaint = Complaint::factory()->create();

        $response = $this->get(route('complaints.edit', $complaint));

        $response
            ->assertOk()
            ->assertViewIs('app.complaints.edit')
            ->assertViewHas('complaint');
    }

    /**
     * @test
     */
    public function it_updates_the_complaint(): void
    {
        $complaint = Complaint::factory()->create();

        $complainType = ComplainType::factory()->create();
        $student = Student::factory()->create();
        $department = Department::factory()->create();
        $program = Program::factory()->create();
        $course = Course::factory()->create();
        $lecture = Lecture::factory()->create();
        $semester = Semester::factory()->create();
        $academicYear = AcademicYear::factory()->create();

        $data = [
            'complain_type_id' => $this->faker->randomNumber,
            'student_id' => $this->faker->randomNumber,
            'department_id' => $this->faker->randomNumber,
            'program_id' => $this->faker->randomNumber,
            'course_id' => $this->faker->randomNumber,
            'lecture_id' => $this->faker->randomNumber,
            'semester_id' => $this->faker->randomNumber,
            'academic_year_id' => $this->faker->randomNumber,
            'description' => $this->faker->sentence(15),
            'solution' => $this->faker->text,
            'date' => $this->faker->date,
            'status' => '0',
            'complain_type_id' => $complainType->id,
            'student_id' => $student->id,
            'department_id' => $department->id,
            'program_id' => $program->id,
            'course_id' => $course->id,
            'lecture_id' => $lecture->id,
            'semester_id' => $semester->id,
            'academic_year_id' => $academicYear->id,
        ];

        $response = $this->put(route('complaints.update', $complaint), $data);

        $data['id'] = $complaint->id;

        $this->assertDatabaseHas('complaints', $data);

        $response->assertRedirect(route('complaints.edit', $complaint));
    }

    /**
     * @test
     */
    public function it_deletes_the_complaint(): void
    {
        $complaint = Complaint::factory()->create();

        $response = $this->delete(route('complaints.destroy', $complaint));

        $response->assertRedirect(route('complaints.index'));

        $this->assertModelMissing($complaint);
    }
}
