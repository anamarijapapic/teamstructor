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
        return [
            'title' => $this->faker->unique()->sentence(),
            'content' => $this->faker->paragraphs(5, true),
            'project_id' => Project::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the post belongs to specific project.
     */
    public function belongsToProject(Project $project): static
    {
        return $this->state(function (array $attributes) use ($project) {
            return [
                'project_id' => $project,
            ];
        });
    }

    /**
     * Indicate that user is post author.
     */
    public function belongsToUser(User $user): static
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user,
            ];
        });
    }
}
