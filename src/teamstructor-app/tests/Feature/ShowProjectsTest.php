<?php

namespace Tests\Feature;

use App\Http\Livewire\Projects\ShowProject;
use App\Http\Livewire\Projects\ShowProjects;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_component_can_render(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $component = Livewire::test(ShowProjects::class, ['team' => $user->currentTeam]);

        $component->assertStatus(200);
    }

    public function test_show_there_is_no_projects(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $component = Livewire::test(ShowProjects::class, ['team' => $user->currentTeam]);

        $component->assertStatus(200);

        $this->assertCount(0, $user->currentTeam->projects);

        $component->assertSee('There are no projects in this team yet.');

        $component->assertDontSeeLivewire(ShowProject::class);
    }

    public function test_projects_can_be_seen(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'name' => 'Test project name',
            'description' => 'Test project description',
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowProjects::class, ['team' => $user->currentTeam]);

        $component->assertStatus(200);

        $this->assertCount(1, $user->currentTeam->projects);

        $component->assertSeeLivewire(ShowProject::class);
    }

    public function test_projects_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(ShowProjects::class, ['team' => $user->currentTeam])
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

        Livewire::test(ShowProjects::class, ['team' => $user->currentTeam])
            ->set([
                'name' => '',
                'description' => '',
            ])
            ->call('store')
            ->assertHasErrors(['name', 'description']);
    }
}
