<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DepartmentHead;

use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentHeadControllerTest extends TestCase
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
    public function it_displays_index_view_with_department_heads(): void
    {
        $departmentHeads = DepartmentHead::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('department-heads.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.department_heads.index')
            ->assertViewHas('departmentHeads');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_department_head(): void
    {
        $response = $this->get(route('department-heads.create'));

        $response->assertOk()->assertViewIs('app.department_heads.create');
    }

    /**
     * @test
     */
    public function it_stores_the_department_head(): void
    {
        $data = DepartmentHead::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('department-heads.store'), $data);

        $this->assertDatabaseHas('department_heads', $data);

        $departmentHead = DepartmentHead::latest('id')->first();

        $response->assertRedirect(
            route('department-heads.edit', $departmentHead)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_department_head(): void
    {
        $departmentHead = DepartmentHead::factory()->create();

        $response = $this->get(route('department-heads.show', $departmentHead));

        $response
            ->assertOk()
            ->assertViewIs('app.department_heads.show')
            ->assertViewHas('departmentHead');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_department_head(): void
    {
        $departmentHead = DepartmentHead::factory()->create();

        $response = $this->get(route('department-heads.edit', $departmentHead));

        $response
            ->assertOk()
            ->assertViewIs('app.department_heads.edit')
            ->assertViewHas('departmentHead');
    }

    /**
     * @test
     */
    public function it_updates_the_department_head(): void
    {
        $departmentHead = DepartmentHead::factory()->create();

        $department = Department::factory()->create();
        $user = User::factory()->create();

        $data = [
            'department_id' => $department->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('department-heads.update', $departmentHead),
            $data
        );

        $data['id'] = $departmentHead->id;

        $this->assertDatabaseHas('department_heads', $data);

        $response->assertRedirect(
            route('department-heads.edit', $departmentHead)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_department_head(): void
    {
        $departmentHead = DepartmentHead::factory()->create();

        $response = $this->delete(
            route('department-heads.destroy', $departmentHead)
        );

        $response->assertRedirect(route('department-heads.index'));

        $this->assertModelMissing($departmentHead);
    }
}
