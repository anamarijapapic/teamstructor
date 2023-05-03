<?php

namespace Tests\Feature;

use App\Http\Livewire\Comments\ShowComment;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowCommentTest extends TestCase
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

        $comment = Comment::factory()->create([
            'content' => 'Test comment content',
            'post_id' => $post,
            'user_id' => $user,
        ]);

        $component = Livewire::test(ShowComment::class, ['comment' => $comment]);

        $component->assertStatus(200);
    }

    public function test_comments_can_be_updated(): void
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

        $comment = Comment::factory()->create([
            'content' => 'Test comment content',
            'post_id' => $post,
            'user_id' => $user,
        ]);

        $this->assertTrue(Comment::where('content', 'Test comment content')->exists());

        Livewire::test(ShowComment::class, ['comment' => $comment])
            ->call('edit', $comment->id)
            ->assertSet('commentId', $comment->id)
            ->assertSet('openEditModal', true)
            ->set([
                'content' => 'Updated comment content',
            ])
            ->call('update')
            ->assertEmitted('commentUpdated')
            ->assertSet('openEditModal', false);

        $this->assertTrue(Comment::where('content', 'Test comment content')->doesntExist());
        $this->assertTrue(Comment::where('content', 'Updated comment content')->exists());
    }

    public function test_comments_cant_be_updated_if_action_is_unauthorized(): void
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

        $comment = Comment::factory()->create([
            'content' => 'Test comment content',
            'post_id' => $post,
            'user_id' => $user,
        ]);

        $this->assertTrue(Comment::where('content', 'Test comment content')->exists());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        Livewire::test(ShowComment::class, ['comment' => $comment])
            ->call('edit', $comment->id)
            ->assertForbidden();
    }

    public function test_comments_can_be_deleted(): void
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

        $comment = Comment::factory()->create([
            'content' => 'Test comment content',
            'post_id' => $post,
            'user_id' => $user,
        ]);

        $this->assertTrue(Comment::where('content', 'Test comment content')->exists());

        Livewire::test(ShowComment::class, ['comment' => $comment])
            ->call('delete', $comment->id)
            ->assertSet('commentId', $comment->id)
            ->assertSet('openDeleteModal', true)
            ->call('destroy')
            ->assertEmitted('commentDeleted')
            ->assertSet('openDeleteModal', false);

        $this->assertTrue(Comment::where('content', 'Test comment content')->doesntExist());
    }

    public function test_comments_cant_be_deleted_if_action_is_unauthorized(): void
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

        $comment = Comment::factory()->create([
            'content' => 'Test comment content',
            'post_id' => $post,
            'user_id' => $user,
        ]);

        $this->assertTrue(Comment::where('content', 'Test comment content')->exists());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        Livewire::test(ShowComment::class, ['comment' => $comment])
            ->call('delete', $comment->id)
            ->assertForbidden();
    }
}
