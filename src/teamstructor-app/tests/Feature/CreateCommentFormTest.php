<?php

namespace Tests\Feature;

use App\Http\Livewire\Comments\CreateCommentForm;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateCommentFormTest extends TestCase
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

        $component = Livewire::test(CreateCommentForm::class, ['post' => $post]);

        $component->assertStatus(200);
    }

    public function test_comments_can_be_created(): void
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

        Livewire::test(CreateCommentForm::class, ['post' => $post])
            ->set([
                'content' => 'Test comment content',
            ])
            ->call('store')
            ->assertEmitted('commentAdded');

        $this->assertTrue(Comment::where('content', 'Test comment content')->exists());
    }

    public function test_valid_input_must_be_provided_before_comment_can_be_created(): void
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

        Livewire::test(CreateCommentForm::class, ['post' => $post])
            ->set([
                'content' => '',
            ])
            ->call('store')
            ->assertHasErrors('content');
    }
}
