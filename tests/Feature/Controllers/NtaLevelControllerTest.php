<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\NtaLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NtaLevelControllerTest extends TestCase
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
    public function it_displays_index_view_with_nta_levels(): void
    {
        $ntaLevels = NtaLevel::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('nta-levels.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.nta_levels.index')
            ->assertViewHas('ntaLevels');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_nta_level(): void
    {
        $response = $this->get(route('nta-levels.create'));

        $response->assertOk()->assertViewIs('app.nta_levels.create');
    }

    /**
     * @test
     */
    public function it_stores_the_nta_level(): void
    {
        $data = NtaLevel::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('nta-levels.store'), $data);

        $this->assertDatabaseHas('nta_levels', $data);

        $ntaLevel = NtaLevel::latest('id')->first();

        $response->assertRedirect(route('nta-levels.edit', $ntaLevel));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_nta_level(): void
    {
        $ntaLevel = NtaLevel::factory()->create();

        $response = $this->get(route('nta-levels.show', $ntaLevel));

        $response
            ->assertOk()
            ->assertViewIs('app.nta_levels.show')
            ->assertViewHas('ntaLevel');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_nta_level(): void
    {
        $ntaLevel = NtaLevel::factory()->create();

        $response = $this->get(route('nta-levels.edit', $ntaLevel));

        $response
            ->assertOk()
            ->assertViewIs('app.nta_levels.edit')
            ->assertViewHas('ntaLevel');
    }

    /**
     * @test
     */
    public function it_updates_the_nta_level(): void
    {
        $ntaLevel = NtaLevel::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(7),
        ];

        $response = $this->put(route('nta-levels.update', $ntaLevel), $data);

        $data['id'] = $ntaLevel->id;

        $this->assertDatabaseHas('nta_levels', $data);

        $response->assertRedirect(route('nta-levels.edit', $ntaLevel));
    }

    /**
     * @test
     */
    public function it_deletes_the_nta_level(): void
    {
        $ntaLevel = NtaLevel::factory()->create();

        $response = $this->delete(route('nta-levels.destroy', $ntaLevel));

        $response->assertRedirect(route('nta-levels.index'));

        $this->assertModelMissing($ntaLevel);
    }
}
