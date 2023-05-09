<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Program;

use App\Models\NtaLevel;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProgramControllerTest extends TestCase
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
    public function it_displays_index_view_with_programs(): void
    {
        $programs = Program::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('programs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.programs.index')
            ->assertViewHas('programs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_program(): void
    {
        $response = $this->get(route('programs.create'));

        $response->assertOk()->assertViewIs('app.programs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_program(): void
    {
        $data = Program::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('programs.store'), $data);

        $this->assertDatabaseHas('programs', $data);

        $program = Program::latest('id')->first();

        $response->assertRedirect(route('programs.edit', $program));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_program(): void
    {
        $program = Program::factory()->create();

        $response = $this->get(route('programs.show', $program));

        $response
            ->assertOk()
            ->assertViewIs('app.programs.show')
            ->assertViewHas('program');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_program(): void
    {
        $program = Program::factory()->create();

        $response = $this->get(route('programs.edit', $program));

        $response
            ->assertOk()
            ->assertViewIs('app.programs.edit')
            ->assertViewHas('program');
    }

    /**
     * @test
     */
    public function it_updates_the_program(): void
    {
        $program = Program::factory()->create();

        $department = Department::factory()->create();
        $ntaLevel = NtaLevel::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'capacity' => $this->faker->randomNumber(0),
            'nta_level_id' => $this->faker->randomNumber,
            'department_id' => $this->faker->randomNumber,
            'department_id' => $department->id,
            'nta_level_id' => $ntaLevel->id,
        ];

        $response = $this->put(route('programs.update', $program), $data);

        $data['id'] = $program->id;

        $this->assertDatabaseHas('programs', $data);

        $response->assertRedirect(route('programs.edit', $program));
    }

    /**
     * @test
     */
    public function it_deletes_the_program(): void
    {
        $program = Program::factory()->create();

        $response = $this->delete(route('programs.destroy', $program));

        $response->assertRedirect(route('programs.index'));

        $this->assertModelMissing($program);
    }
}
