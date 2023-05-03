<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

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

        return [
            'title' => $this->faker->unique()->sentence(),
            'content' => $this->faker->paragraphs(5, true),
            'project_id' => $project,
            'user_id' => $user,
        ];
    }
}
