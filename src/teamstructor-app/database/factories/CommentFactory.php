<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->withPersonalTeam()->create();
        $project = Project::factory()->create([
            'team_id' => $user->currentTeam,
            'user_id' => $user,
        ]);
        $post = Post::factory()->create([
            'project_id' => $project,
            'user_id' => $user,
        ]);

        return [
            'content' => $this->faker->sentence(10),
            'post_id' => $post,
            'user_id' => $user,
        ];
    }
}
