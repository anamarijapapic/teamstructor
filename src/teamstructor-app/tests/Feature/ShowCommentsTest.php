<?php

namespace Tests\Feature;

use App\Http\Livewire\Comments\ShowComment;
use App\Http\Livewire\Comments\ShowComments;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowCommentsTest extends TestCase
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

        $component = Livewire::test(ShowComments::class, ['post' => $post]);

        $component->assertStatus(200);
    }

    public function test_show_there_is_no_comments(): void
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

        $component = Livewire::test(ShowComments::class, ['post' => $post]);

        $component->assertStatus(200);

        $this->assertCount(0, $post->comments);

        $component->assertSee('There are no comments on this post yet.');

        $component->assertDontSeeLivewire(ShowComment::class);
    }

    public function test_comments_can_be_seen(): void
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

        $component = Livewire::test(ShowComments::class, ['post' => $post]);

        $component->assertStatus(200);

        $this->assertCount(1, $post->comments);

        $component->assertSeeLivewire(ShowComment::class);
    }
}
