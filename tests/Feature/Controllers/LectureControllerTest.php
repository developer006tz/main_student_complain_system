<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Lecture;

use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LectureControllerTest extends TestCase
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
    public function it_displays_index_view_with_lectures(): void
    {
        $lectures = Lecture::factory()
            ->count(2)
            ->create();

        $response = $this->get(route('lectures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lectures.index')
            ->assertViewHas('lectures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lecture(): void
    {
        $response = $this->get(route('lectures.create'));

        $response->assertOk()->assertViewIs('app.lectures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lecture(): void
    {
        $data = Lecture::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lectures.store'), $data);

        $this->assertDatabaseHas('lectures', $data);

        $lecture = Lecture::latest('id')->first();

        $response->assertRedirect(route('lectures.edit', $lecture));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lecture(): void
    {
        $lecture = Lecture::factory()->create();

        $response = $this->get(route('lectures.show', $lecture));

        $response
            ->assertOk()
            ->assertViewIs('app.lectures.show')
            ->assertViewHas('lecture');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lecture(): void
    {
        $lecture = Lecture::factory()->create();

        $response = $this->get(route('lectures.edit', $lecture));

        $response
            ->assertOk()
            ->assertViewIs('app.lectures.edit')
            ->assertViewHas('lecture');
    }

    /**
     * @test
     */
    public function it_updates_the_lecture(): void
    {
        $lecture = Lecture::factory()->create();

        $department = Department::factory()->create();
        $user = User::factory()->create();

        $data = [
            'department_id' => $this->faker->randomNumber,
            'status' => '1',
            'department_id' => $department->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('lectures.update', $lecture), $data);

        $data['id'] = $lecture->id;

        $this->assertDatabaseHas('lectures', $data);

        $response->assertRedirect(route('lectures.edit', $lecture));
    }

    /**
     * @test
     */
    public function it_deletes_the_lecture(): void
    {
        $lecture = Lecture::factory()->create();

        $response = $this->delete(route('lectures.destroy', $lecture));

        $response->assertRedirect(route('lectures.index'));

        $this->assertModelMissing($lecture);
    }
}
