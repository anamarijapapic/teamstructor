<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $projects = Project::all();

        foreach ($projects as $project) {
            $users = $project->team->allUsers()->random(2);

            foreach ($users as $user) {
                $project
                    ->addMediaFromUrl($faker->unique()->imageUrl())
                    ->withCustomProperties(['user_id' => $user->id])
                    ->toMediaCollection('default', 's3');
            }
        }
    }
}
