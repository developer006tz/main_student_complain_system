<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ComplainType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplainTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_complain_types(): void
    {
        $complainTypes = ComplainType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('complain-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.complain_types.index')
            ->assertViewHas('complainTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_complain_type(): void
    {
        $response = $this->get(route('complain-types.create'));

        $response->assertOk()->assertViewIs('app.complain_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_complain_type(): void
    {
        $data = ComplainType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('complain-types.store'), $data);

        $this->assertDatabaseHas('complain_types', $data);

        $complainType = ComplainType::latest('id')->first();

        $response->assertRedirect(route('complain-types.edit', $complainType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_complain_type(): void
    {
        $complainType = ComplainType::factory()->create();

        $response = $this->get(route('complain-types.show', $complainType));

        $response
            ->assertOk()
            ->assertViewIs('app.complain_types.show')
            ->assertViewHas('complainType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_complain_type(): void
    {
        $complainType = ComplainType::factory()->create();

        $response = $this->get(route('complain-types.edit', $complainType));

        $response
            ->assertOk()
            ->assertViewIs('app.complain_types.edit')
            ->assertViewHas('complainType');
    }

    /**
     * @test
     */
    public function it_updates_the_complain_type(): void
    {
        $complainType = ComplainType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(
            route('complain-types.update', $complainType),
            $data
        );

        $data['id'] = $complainType->id;

        $this->assertDatabaseHas('complain_types', $data);

        $response->assertRedirect(route('complain-types.edit', $complainType));
    }

    /**
     * @test
     */
    public function it_deletes_the_complain_type(): void
    {
        $complainType = ComplainType::factory()->create();

        $response = $this->delete(
            route('complain-types.destroy', $complainType)
        );

        $response->assertRedirect(route('complain-types.index'));

        $this->assertModelMissing($complainType);
    }
}
