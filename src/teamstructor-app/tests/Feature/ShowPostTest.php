<?php

namespace Tests\Feature;

use App\Http\Livewire\Posts\ShowPost;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_component_can_render(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $post = Post::factory()->create([
            'project_id' => $project,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowPost::class, ['post' => $post]);

        $component->assertStatus(200);
    }

    public function test_posts_can_be_updated(): void
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

        $this->assertTrue(Post::where('title', 'Test post title')->exists());

        Livewire::test(ShowPost::class, ['post' => $post])
            ->call('edit', $post->id)
            ->assertSet('postId', $post->id)
            ->assertSet('openEditModal', true)
            ->set([
                'title' => 'Updated post title',
            ])
            ->call('update')
            ->assertEmitted('postUpdated')
            ->assertSet('openEditModal', false);

        $this->assertTrue(Post::where('title', 'Test post title')->doesntExist());
        $this->assertTrue(Post::where('title', 'Updated post title')->exists());
    }

    public function test_posts_cant_be_updated_if_action_is_unauthorized(): void
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

        $this->assertTrue(Post::where('title', 'Test post title')->exists());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        Livewire::test(ShowPost::class, ['post' => $post])
            ->call('edit', $post->id)
            ->assertForbidden();
    }

    public function test_posts_can_be_deleted(): void
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

        $this->assertTrue(Post::where('title', 'Test post title')->exists());

        Livewire::test(ShowPost::class, ['post' => $post])
            ->call('delete', $post->id)
            ->assertSet('postId', $post->id)
            ->assertSet('openDeleteModal', true)
            ->call('destroy')
            ->assertEmitted('postDeleted')
            ->assertSet('openDeleteModal', false);

        $this->assertTrue(Post::where('title', 'Test post title')->doesntExist());
    }

    public function test_posts_cant_be_deleted_if_action_is_unauthorized(): void
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

        $this->assertTrue(Post::where('title', 'Test post title')->exists());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        Livewire::test(ShowPost::class, ['post' => $post])
            ->call('delete', $post->id)
            ->assertForbidden();
    }
}
