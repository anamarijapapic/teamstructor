<?php

namespace Tests\Feature;

use App\Http\Livewire\Projects\ShowProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_component_can_render(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowProject::class, ['project' => $project]);

        $component->assertStatus(200);
    }

    public function test_projects_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'name' => 'Test project name',
            'description' => 'Test project description',
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $this->assertTrue(Project::where('name', 'Test project name')->exists());

        Livewire::test(ShowProject::class, ['project' => $project])
            ->call('edit', $project->id)
            ->assertSet('projectId', $project->id)
            ->assertSet('openEditModal', true)
            ->set([
                'name' => 'Updated project name',
            ])
            ->call('update')
            ->assertEmitted('projectUpdated')
            ->assertSet('openEditModal', false);

        $this->assertTrue(Project::where('name', 'Test project name')->doesntExist());
        $this->assertTrue(Project::where('name', 'Updated project name')->exists());
    }

    public function test_projects_cant_be_updated_if_action_is_unauthorized(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'name' => 'Test project name',
            'description' => 'Test project description',
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $this->assertTrue(Project::where('name', 'Test project name')->exists());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        Livewire::test(ShowProject::class, ['project' => $project])
            ->call('edit', $project->id)
            ->assertForbidden();
    }

    public function test_projects_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'name' => 'Test project name',
            'description' => 'Test project description',
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $this->assertTrue(Project::where('name', 'Test project name')->exists());

        Livewire::test(ShowProject::class, ['project' => $project])
            ->call('delete', $project->id)
            ->assertSet('projectId', $project->id)
            ->assertSet('openDeleteModal', true)
            ->call('destroy')
            ->assertEmitted('projectDeleted')
            ->assertSet('openDeleteModal', false);

        $this->assertTrue(Project::where('name', 'Test project name')->doesntExist());
    }

    public function test_projects_cant_be_deleted_if_action_is_unauthorized(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'name' => 'Test project name',
            'description' => 'Test project description',
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $this->assertTrue(Project::where('name', 'Test project name')->exists());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        Livewire::test(ShowProject::class, ['project' => $project])
            ->call('delete', $project->id)
            ->assertForbidden();
    }
}
