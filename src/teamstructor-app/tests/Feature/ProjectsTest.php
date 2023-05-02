<?php

namespace Tests\Feature;

use App\Http\Livewire\Projects\Projects;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_component_can_render(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $component = Livewire::test(Projects::class, ['team' => $user->fresh()->personalTeam()]);

        $component->assertStatus(200);
    }

    public function test_projects_page_contains_livewire_component(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $this->get('/teams/'.$user->fresh()->personalTeam()->id.'/projects')->assertSeeLivewire(Projects::class);
    }

    public function test_projects_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(Projects::class, ['team' => $user->fresh()->personalTeam()])
            ->set([
                'name' => 'Test project name',
                'description' => 'Test project description',
            ])
            ->call('store');

        $this->assertTrue(Project::where('name', 'Test project name')->exists());
    }

    public function test_valid_input_must_be_provided_before_project_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(Projects::class, ['team' => $user->fresh()->personalTeam()])
            ->set([
                'name' => '',
                'description' => '',
            ])
            ->call('store')
            ->assertHasErrors(['name', 'description']);
    }
}
