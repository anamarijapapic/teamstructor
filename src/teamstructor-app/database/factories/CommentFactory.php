<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
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
        return [
            'content' => $this->faker->paragraph(),
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the comment belongs to specific post.
     */
    public function belongsToPost(Post $post): static
    {
        return $this->state(function (array $attributes) use ($post) {
            return [
                'post_id' => $post,
            ];
        });
    }

    /**
     * Indicate that user is comment author.
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
