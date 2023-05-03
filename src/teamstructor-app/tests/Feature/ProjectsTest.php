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

        $component = Livewire::test(Projects::class, ['team' => $user->currentTeam]);

        $component->assertStatus(200);
    }

    public function test_projects_page_contains_livewire_component(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $this->get('/teams/'.$user->currentTeam->id.'/projects')->assertSeeLivewire(Projects::class);
    }

    public function test_projects_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(Projects::class, ['team' => $user->currentTeam])
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

        Livewire::test(Projects::class, ['team' => $user->currentTeam])
            ->set([
                'name' => '',
                'description' => '',
            ])
            ->call('store')
            ->assertHasErrors(['name', 'description']);
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

        Livewire::test(Projects::class, ['team' => $user->currentTeam])
            ->call('edit', $project->id)
            ->assertSet('creatingOrEditingProject', true)
            ->set([
                'projectId' => $project->id,
                'name' => 'Updated project name',
            ])
            ->call('store')
            ->assertSet('creatingOrEditingProject', false);

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

        Livewire::test(Projects::class, ['team' => $user->currentTeam])
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

        Livewire::test(Projects::class, ['team' => $user->currentTeam])
            ->call('confirmDeletion', $project->id)
            ->assertSet('confirmingProjectDeletion', true)
            ->set([
                'projectIdBeingDeleted' => $project->id,
            ])
            ->call('delete')
            ->assertSet('confirmingProjectDeletion', false);

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

        Livewire::test(Projects::class, ['team' => $user->currentTeam])
            ->call('confirmDeletion', $project->id)
            ->assertForbidden();
    }
}
