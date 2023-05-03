<?php

namespace Tests\Feature;

use App\Http\Livewire\Posts\ShowPost;
use App\Http\Livewire\Posts\ShowPosts;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowPostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_component_can_render(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowPosts::class, ['team' => $user->currentTeam, 'project' => $project]);

        $component->assertStatus(200);
    }

    public function test_show_there_is_no_posts(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowPosts::class, ['team' => $user->currentTeam, 'project' => $project]);

        $component->assertStatus(200);

        $this->assertCount(0, $project->posts);

        $component->assertSee('There are no posts in this project yet.');

        $component->assertDontSeeLivewire(ShowPost::class);
    }

    public function test_posts_can_be_seen(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $post = Post::factory()->create([
            'title' => 'Test post title',
            'content' => 'Test post content',
            'project_id' => $project,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowPosts::class, ['team' => $user->currentTeam, 'project' => $project]);

        $component->assertStatus(200);

        $this->assertCount(1, $project->posts);

        $component->assertSeeLivewire(ShowPost::class);
    }
}
