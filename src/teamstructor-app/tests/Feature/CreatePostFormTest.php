<?php

namespace Tests\Feature;

use App\Http\Livewire\Posts\CreatePostForm;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePostFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_component_can_render(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        $component = Livewire::test(CreatePostForm::class, ['project' => $project]);

        $component->assertStatus(200);
    }

    public function test_posts_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        Livewire::test(CreatePostForm::class, ['project' => $project])
            ->set([
                'title' => 'Test post title',
                'content' => 'Test post content',
            ])
            ->call('store')
            ->assertEmitted('postAdded');

        $this->assertTrue(Post::where('title', 'Test post title')->exists());
    }

    public function test_valid_input_must_be_provided_before_post_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);

        Livewire::test(CreatePostForm::class, ['project' => $project])
            ->set([
                'title' => '',
                'content' => '',
            ])
            ->call('store')
            ->assertHasErrors(['title', 'content']);
    }
}
