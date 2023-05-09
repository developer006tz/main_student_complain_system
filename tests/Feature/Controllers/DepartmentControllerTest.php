<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentControllerTest extends TestCase
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
    public function it_displays_index_view_with_departments(): void
    {
        $departments = Department::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('departments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.departments.index')
            ->assertViewHas('departments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_department(): void
    {
        $response = $this->get(route('departments.create'));

        $response->assertOk()->assertViewIs('app.departments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_department(): void
    {
        $data = Department::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('departments.store'), $data);

        $this->assertDatabaseHas('departments', $data);

        $department = Department::latest('id')->first();

        $response->assertRedirect(route('departments.edit', $department));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_department(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(route('departments.show', $department));

        $response
            ->assertOk()
            ->assertViewIs('app.departments.show')
            ->assertViewHas('department');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_department(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(route('departments.edit', $department));

        $response
            ->assertOk()
            ->assertViewIs('app.departments.edit')
            ->assertViewHas('department');
    }

    /**
     * @test
     */
    public function it_updates_the_department(): void
    {
        $department = Department::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'code' => $this->faker->text(255),
        ];

        $response = $this->put(route('departments.update', $department), $data);

        $data['id'] = $department->id;

        $this->assertDatabaseHas('departments', $data);

        $response->assertRedirect(route('departments.edit', $department));
    }

    /**
     * @test
     */
    public function it_deletes_the_department(): void
    {
        $department = Department::factory()->create();

        $response = $this->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));

        $this->assertModelMissing($department);
    }
}
