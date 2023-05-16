<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->unique()->sentence(),
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the project belongs to specific team.
     */
    public function belongsToTeam(Team $team): static
    {
        return $this->state(function (array $attributes) use ($team) {
            return [
                'team_id' => $team,
            ];
        });
    }

    /**
     * Indicate that user is project creator.
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
